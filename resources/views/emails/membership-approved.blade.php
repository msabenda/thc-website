@component('mail::message')
# Welcome to Tanzania Houston Community! 🎉

Dear {{ $application->full_name }},

We are thrilled to inform you that your membership application has been **approved**.

**Membership ID:** {{ $membershipId }}  
**Start Date:** {{ now()->format('F j, Y') }}  
**Expiration Date:** December 31, {{ now()->year + 1 }}

You are now officially part of our warm and vibrant community!

Join our WhatsApp group to connect with fellow members:

@component('mail::button', ['url' => 'https://chat.whatsapp.com/YOUR_GROUP_INVITE_LINK_HERE', 'color' => 'success'])
Join WhatsApp Group →
@endcomponent

We look forward to seeing you at our next event!

Warm regards,<br>
**Tanzania Houston Community Admin Team**
@endcomponent