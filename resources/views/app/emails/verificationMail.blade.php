@component('mail::message')
    # Sign in here

    #{{ $mailData['title'] }}

    {{ $mailData['body'] }}

    @component('mail::button', ['url' => $mailData['url']])
        Click here
    @endcomponent

    If you’re having trouble clicking the button, click [here]({{ $mailData['url'] }}).
@endcomponent