@component('mail::message' ,['message'=>$message])
# Report Mail


{{$message}}


Thanks,<br>


{{ config('app.name') }}
@endcomponent
