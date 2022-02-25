@component('mail::message')
    You are registered in the system "Ongila BOSHQARUV" <br>
    Your password:  {{ $password }} <br><br>
    Please, confirm your registration!
    <p>@component('mail::button', ['url' =>$host_name.'/#/verify/' . $mailData->verification_token])
            Verification url
        @endcomponent </p>
    Thanks, <br>
    {{ config('app.name') }} team.
@endcomponent
