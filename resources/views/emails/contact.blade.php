@component('mail::message')
# رسالة جديدة من {{ $name }}

**البريد:** {{ $email }}

**الموضوع:** {{ $subject }}

**الرسالة:**
{{ $message }}

@endcomponent
