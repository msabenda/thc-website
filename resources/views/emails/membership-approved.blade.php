@component('mail::message')
<img src="{{ asset('img/logo.png') }}" alt="THC Logo" style="max-width:150px;margin-bottom:15px">

# Your THC Membership Has Been Approved! 🎉

Hello {{ $application->full_name }},

We are pleased to inform you that your membership application has been **approved**.

**Membership ID:** {{ $membershipId }}  
**Reference:** {{ $application->application_ref }}  
**Approved on:** {{ now()->format('M j, Y g:i A') }}

@component('mail::button', ['url' => 'http://localhost:8000'])
Visit THC Community
@endcomponent

Thank you for joining the **THC Community**!

Warm regards,<br>
**Tanzania Houston Community Team**
@endcomponent
