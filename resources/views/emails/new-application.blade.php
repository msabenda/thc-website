@component('mail::message')
# New Membership Application Received! 🎉

**Reference:** {{ $application->application_ref }}  
**Name:** {{ $application->full_name }}  
**Email:** {{ $application->email }}  
**Phone:** {{ $application->phone }}  
**Fee Paid:** {{ ucfirst($application->fee_paid) }}  
**Submitted:** {{ $application->created_at->format('M j, Y g:i A') }}

Please review it in the admin panel as soon as possible.

@component('mail::button', ['url' => url('/admin/applications'), 'color' => 'primary'])
Go to Admin Panel →
@endcomponent

Regards,<br>
**THC System**
@endcomponent