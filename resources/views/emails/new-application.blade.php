@component('mail::message')
<img src="{{ asset('img/logo.png') }}" alt="THC Logo" style="max-width:150px;margin-bottom:15px">

# New Membership Application Received

**Reference:** {{ $application->application_ref }}  
**Name:** {{ $application->full_name }}  
**Email:** {{ $application->email }}  
**Phone:** {{ $application->phone }}  
**Fee Paid:** {{ ucfirst($application->fee_paid) }}  
**Submitted:** {{ $application->created_at->format('M j, Y g:i A') }}

Please review this application in the admin panel.

@component('mail::button', ['url' => url('/admin/applications'), 'color' => 'primary'])
Go to Admin Panel
@endcomponent

Regards,<br>
**THC Community**
@endcomponent
