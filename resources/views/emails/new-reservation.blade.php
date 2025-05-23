@component('mail::message')

    <div dir="rtl" style="text-align:right;">
        <h2>
            <center> تم حجز جلسة جديدة
                </center>
        </h2>

        {{--<p style="text-align:right;">نوع الجلسه : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">تاريخ الجلسة : {{ $reservation->date }}</p>
        <p style="text-align:right;">توقيت الجلسة : {{ date('h a',strtotime($reservation->start_time.':00')) }}</p>
        <p style="text-align:right;">الحجز مع : {{$reservation->user->name }}</p>--}}


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
