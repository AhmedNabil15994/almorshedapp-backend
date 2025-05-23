@component('mail::message')
    <div dir="rtl" style="text-align:right;">
        {{--<p style="text-align:right;">
            أهلاً وسهلاً بك في تطبيق المرشد .. مرشدينا بإنتظارك الأن قرر ولا تتردد بإختيار المرشد الذي تراه يناسب مشكلتك
            .. شكراُ لإختيارك تطبيق المرشد
        </p>

        <p>
            Welcome To in Almorshed App .. Our Counselor are waiting for you now. Decide and do not hesitate to choose
            the Counselor you see fit your problem .. Thank you for choosing Almorshed App
        </p>--}}

        <p style="text-align:right;">
            أهلا وسهلاً بك فى تطبيق المرشد ..
            مرشدينا بإنتظارك الآن، قرر ولا تتردد بإختيار المرشد الذى تراه يناسب مشكلتك.

            <span style="border-bottom: 2px solid red;">يرجى قراءة الشروط والأحكام وطريقة التواصل قبل الحجز..</span>
            شكراً لإختيارك تطبيق المرشد
        </p>

        <p>
            Welcome to Almorshed App.. Our counselors are waiting for you now, decide and do not hesitate to choose the
            counselor you see suits your problem

            <span style="border-bottom: 2px solid red;">Kindly read the terms and conditions and method of communications before reservation..</span>
            Thank you for
            choosing Almorshed App
        </p>

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
    </div>
@endcomponent
