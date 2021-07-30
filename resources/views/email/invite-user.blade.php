<p>
 Hi, we're writing to let you know that you've been invited by {{$name}}
 to join the account for {{$company}} on {{env('APP_NAME')}}.
</p>

<p>If you were expecting this invitation, please click the button below to activate your account.</p>

<a href="{{env('APP_CLIENT_URL')}}/accept-invite/{{$token}}">Click here to activate your account.</a>

<p>If you do not want to accept this invitation, no further action is required.</p>

<p>Thanks,</p>
The {{env('APP_NAME')}} Team
