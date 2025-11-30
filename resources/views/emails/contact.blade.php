@component('mail::message')
# New Message from {{ $name }}

**Email:** {{ $email }}

**Subject:** {{ $subject }}

**Message:**
{{ $message }}

@endcomponent
