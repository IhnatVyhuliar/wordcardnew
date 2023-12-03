@component('mail::message')
    # Sign in here 

    <h1>{{ $mailData['title'] }}</h1>
    <h2>{{ $mailData['body'] }}</h2>
    
    @component('mail::button', ['url' => $mailData['url']])
        Click here
    @endcomponent

    If you’re having trouble clicking the button, click [here]({{ $mailData['url'] }}).

@endcomponent