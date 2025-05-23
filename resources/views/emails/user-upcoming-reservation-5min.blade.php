@component('mail::message')

    <div dir="rtl" style="text-align:right;">
        <h2>
            <center>
                ستبدء الجلسة بعد خمس دقائق
            </center>
            <center>
                ستبدأ جلستك بعد خمس دقائق الرجاء الدخول للتطبيق والإستعداد ..
            </center>
        </h2>
        <p style="text-align:right;">نوع التواصل : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">تاريخ الجلسة : {{ $reservation->date }}
            : {{ date('h a',strtotime($reservation->start_time.':00')) }}</p>
        <p style="text-align:right;">اسم المرشد : {{$reservation->doctor->user->name }}</p>
        <br>
        <p style="text-align:right;">تطبيق المرشد يرحب بكم دائما</p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
    </div>

@endcomponent
