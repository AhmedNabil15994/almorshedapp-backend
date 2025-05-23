@component('mail::message')
    <div dir="rtl" style="text-align:right;">

        {{--<p style="text-align:right;">
            # الغاء الحجز

            لقد تم الغاء الحجز الخاص بك بتاريخ {{ $reservation->date }}
        </p>--}}

        <h2>
            <center>تم الغاء الجلسة</center>
        </h2>

        <p style="text-align:right;">نوع التواصل : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">تاريخ الجلسة : {{ $reservation->date }}
            : {{ date('h a',strtotime($reservation->start_time.':00')) }}</p>
        <p style="text-align:right;">اسم المرشد : {{$reservation->doctor->user->name }}</p>
        <p style="text-align:right;">سبب الإلغاء : {{$reservation->reason ? $reservation->reason : '---' }}</p>
        <br>
        <p style="text-align:right;">تطبيق المرشد يرحب بكم دائما</p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>

    </div>
@endcomponent
