@component('mail::message')
<img src="{{ asset('img/logo.png') }}" alt="THC Logo" style="max-width:150px;margin-bottom:15px">

# Update on Your THC Membership Application

Dear {{ $application->full_name }},

Thank you for your interest in joining the Tanzania Houston Community.

After careful review, we are sorry to inform you that your application could not be approved at this time.

Possible reasons include:
- Unclear or invalid payment receipt
- Duplicate membership
- Other verification issues

You are welcome to re-apply in the future with updated information.

We truly appreciate your enthusiasm and wish you the best.

**Reference:** {{ $application->application_ref }}  
**Submitted on:** {{ $application->created_at->format('M j, Y g:i A') }}

@component('mail::button', ['url' => 'http://localhost:8000'])
Visit THC Website
@endcomponent

Warm regards,<br>
**Tanzania Houston Community Team**
@endcomponent
