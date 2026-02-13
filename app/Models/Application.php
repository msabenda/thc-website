<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'phone', 'email', 'fee_paid', 'receipt_path',
        'status', 'membership_id', 'rejection_reason', 'application_ref'
    ];
}