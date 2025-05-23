@component('mail::message')

    <div dir="rtl" style="text-align:right;">
        {{--<h2>
            <center> لديك جلسة قريبا
                <center>
        </h2>

        <p style="text-align:right;">نوع الجلسه : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">تاريخ الجلسة : {{ $reservation->date }}</p>
        <p style="text-align:right;">توقيت الجلسة : {{ date('h a',strtotime($reservation->start_time.':00')) }}</p>
        <p style="text-align:right;">الحجز مع : {{$reservation->user->name }}</p>--}}

        <h2>
            <center>
                لديك جلسة بعد ساعتين
            </center>
            <center>الرجاء الجلوس في مكان تكون فيه شبكة الإنترنت قوية .. يفضل الجلوس في مكان هادئ وأن لا تستقبل
                الإتصالات أثناء الجلسة
            </center>
        </h2>

        <p style="text-align:right;">نوع التواصل : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">تاريخ الجلسة : {{ $reservation->date }}
            : {{ date('h a',strtotime($reservation->start_time.':00')) }}</p>
        <p style="text-align:right;">اسم المستخدم : {{$reservation->user->name }}</p>
        <br>
        <p style="text-align:right;">تطبيق المرشد يرحب بكم دائما</p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
    </div>


@endcomponent
