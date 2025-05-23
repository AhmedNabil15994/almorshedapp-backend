@component('mail::message')
<div dir="rtl" style="text-align:right;">
    <p style="text-align:right;">
        # تفعيل الحساب

        لقد تم تفعيل الحساب بنجاح {{ $doctor->user->name }}
        </o>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
</div>
@endcomponent
