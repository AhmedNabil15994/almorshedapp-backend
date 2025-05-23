@component('mail::message')
    <div dir="rtl" style="text-align:right;">

        {{--<p style="text-align:right;">
          أهلا وسهلا بك في أسرة تطبيق المرشد سيتم مراجعة حسابك والإتصال بك قريباً ..لتفعيل حسابك .. شكراً لتفهمكم
        </p>  --}}

        <p style="text-align:right;">
            أهلا وسهلا بك في تطبيق المرشد، سعداء برغبتك بالانضمام لأسرة تطبيق المرشد ، ستقوم الإدارة بالتواصل معك في
            أقرب وقت ممكن لتفعيل الحساب
        </p>

        <p>
            Welcome to Almorshed application, happy with your desire to join the family of the guide application,
            the administration will contact you as soon as possible to activate the account
        </p>

        {{--<p>
            Welcome to Almorshed App family, your account will be reviewed and we will contact you soon .. to activate
            your account .. Thanks for your understanding
        </p>--}}

        <center>
            Thanks,
            <br>
            {{ config('app.name') }}
        </center>
    </div>
@endcomponent
