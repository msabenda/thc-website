<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewApplicationSubmitted;
use App\Mail\MembershipApproved;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        // === HIGHLY SECURE VALIDATION (Laravel 12 built-in) ===
        $request->validate([
    'full_name'     => 'required|string|min:3|max:255',
    'phone'         => 'required|string',  // visible one – no strict validation needed anymore
    'phone_international' => 'required|string|regex:/^\+1[2-9]\d{9}$/',  // clean +1xxxxxxxxxx
    'email'         => 'required|email|unique:applications,email',
    'fee_paid'      => 'required|in:yes,no',
    'receipt'       => 'required_if:fee_paid,yes|file|mimes:jpg,jpeg,png,pdf|max:5120',
    'terms_accepted'=> 'required|accepted',
    'g-recaptcha-response' => env('APP_ENV') === 'local' ? 'nullable' : 'required|captcha',
    'website'       => 'prohibited',  // honeypot
]);

        // === FILE SECURITY (Laravel auto-handles most OWASP risks) ===
        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');

            // Store in public disk with random name + year folder
            $receiptPath = $file->store('applications/' . date('Y'), 'public');
            // Laravel automatically:
            // - sanitizes name
            // - uses random hash
            // - only allows validated mime types
            // - stores outside direct execution path
        }

        // Generate reference
        $ref = 'APP-' . Str::upper(Str::random(6));

        // === SAFE INSERT (Eloquent = no SQL injection) ===
        $application = Application::create([
            'full_name'     => $request->full_name,
            'phone'         => $request->phone_international,  // ← clean +16142642074
            'email'         => $request->email,
            'fee_paid'      => $request->fee_paid,
            'receipt_path'  => $receiptPath,
            'application_ref' => $ref,
            'status'        => 'pending',
        ]);

        // === NOTIFY ALL ADMINS ===
// Notify all admins after storing application
// Notify all admins asynchronously
$adminEmails = array_filter(explode(',', env('ADMIN_EMAILS', '')));
foreach ($adminEmails as $email) {
    Mail::to(trim($email))->queue(new NewApplicationSubmitted($application));
}


        // === SUCCESS FEEDBACK ON SAME PAGE ===
        return back()->with('success', "Application received! Ref: {$ref}. We'll review within 48 hours. Check your email (including spam).");
    }
}