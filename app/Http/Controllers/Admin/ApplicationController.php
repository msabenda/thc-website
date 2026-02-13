<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipRejected;
use App\Mail\MembershipApproved;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::latest()->paginate(15); // Pagination added
        return view('admin.applications.index', compact('applications'));
    }

    public function approve(Application $application)
    {
        if ($application->status !== 'pending') {
            return back();
        }

        // Sequential membership ID
        $year = now()->year;

        $last = Application::where('status', 'approved')
            ->whereYear('created_at', $year)
            ->latest('id')
            ->first();

        if ($last && $last->membership_id) {
            $lastNumber = (int) substr($last->membership_id, -4);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        $membershipId = "THC-{$year}-{$nextNumber}";

        $application->update([
            'status' => 'approved',
            'membership_id' => $membershipId,
        ]);

        // Send email to applicant
        Mail::to($application->email)
            ->queue(new MembershipApproved($application, $membershipId));

        return back()->with('success', 'Member approved successfully.');
    }

    public function reject(Application $application)
{
    if ($application->status !== 'pending') {
        return back();
    }

    $application->update([
        'status' => 'rejected',
    ]);

    // Notify applicant
    Mail::to($application->email)
        ->queue(new MembershipRejected($application));

    return back()->with('success', 'Application rejected and applicant notified.');
}
}
