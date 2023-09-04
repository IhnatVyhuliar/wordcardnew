@component('mail::message')
    Sign in here 
    <h1>{{$mailData['title']}}</h1>
    <h2>{{$mailData['body']}}</h2>
    
        @component('mail::a',['url'=> '{{$mailData["url"]}}'])
        Click here
       @endcomponent 
    
  
    
@endcomponent