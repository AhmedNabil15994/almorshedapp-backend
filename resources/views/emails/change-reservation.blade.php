@component('mail::message')
    <div dir="rtl" style="text-align:right;">

        {{--<p style="text-align:right;">

            # تغيير موعد الحجز

            لقد تم تغيير موعد الحجز لتاريخ {{ $reservation->date }} من

            {{ date('h a',strtotime($reservation->start_time.':00')) }}

            الى

            {{ date('h a',strtotime($reservation->end_time.':00')) }}

        </p>--}}

        <h2>
            <center>
                تم تغير موعد الجلسة
            </center>
        </h2>


        <p style="text-align:right;">نوع التواصل : {{ $reservation->service->translate('ar')->name }}</p>
        <p style="text-align:right;">
            موعد الجلسة القديم : {{ $oldReservation->date }}
            <span> من : {{ date('h a',strtotime($oldReservation->start_time.':00')) }} </span>
            <span> الى : {{ date('h a',strtotime($oldReservation->end_time.':00')) }} </span>
        </p>
        <p style="text-align:right;">
            موعد الجلسة الجديد : {{ $reservation->date }}
            <span> من : {{ date('h a',strtotime($reservation->start_time.':00')) }} </span>
            <span> الى : {{ date('h a',strtotime($reservation->end_time.':00')) }} </span>
        </p>

        <p style="text-align:right;">اسم المستخدم : {{$reservation->user->name }}</p>
        <p style="text-align:right;">السبب : {{$reservation->reason ? $reservation->reason : '---' }}</p>
        <br>
        <p style="text-align:right;">تطبيق المرشد يرحب بكم دائما</p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>


    </div>

@endcomponent
