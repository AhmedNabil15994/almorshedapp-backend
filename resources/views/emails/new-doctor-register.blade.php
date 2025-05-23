@component('mail::message')
    <div dir="rtl" style="text-align:right;">
        <p style="text-align:right;">

            # تسجيل مرشد جديد

            لقد تم تسجيل مرشد جديد باسم {{ $doctor->user->name }}
        </p>
        <p style="text-align:right;">
            : البريد الإلكترونى {{ $doctor->user->email }}
        </p>
        <p style="text-align:right;">
            : رقم الهاتف {{ $doctor->user->mobile }}
        </p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
    </div>
@endcomponent
