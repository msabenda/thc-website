@component('mail::message')
# Update on Your THC Membership Application

Dear {{ $application->full_name }},

Thank you for your interest in joining the Tanzania Houston Community.

After careful review, we regret to inform you that your application could not be approved at this time.

Possible reasons include:
- Unclear or invalid payment receipt
- Duplicate membership
- Other verification issues

You are welcome to re-apply in the future with updated information.

We truly appreciate your enthusiasm and wish you the best.

Warm regards,<br>
**Tanzania Houston Community Admin Team**
@endcomponent