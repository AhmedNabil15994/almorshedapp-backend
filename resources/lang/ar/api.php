<?php

return array(
    'general' =>
        array(
            'error_happended' => 'لقد حدث خطأ ما من فضلك حاول مرة أخرى',
        ),
    'contact' =>
        array(
            'msg_sent_success' => 'تم إرسال رسالتك بنجاح',
        ),
    'ads' =>
        array(
            'ad_not_found' => 'هذا الاعلان غير موجود',
        ),
    'articles' =>
        array(
            'article_not_found' => 'هذا المقال غير موجود',
        ),
    'assessments' =>
        array(
            'assessment_not_found' => 'هذا الاختبار غير موجود',
            'assessment_result' => 'نتيجة الاختبار',
            'send' => 'إرسال',
            'validation' =>
                array(
                    'assessment_id' =>
                        array(
                            'required' => 'الاختبار مطلوب',
                        ),
                    'questions' =>
                        array(
                            'id' =>
                                array(
                                    'required' => 'من فضلك اختر السؤال',
                                    'exists' => 'هذا السؤال غير موجود',
                                ),
                            'answer_id' =>
                                array(
                                    'required' => 'من فضلك اختر الاجابة',
                                    'exists' => 'هذه الاجابة غير موجودة',
                                ),
                            'value' =>
                                array(
                                    'required' => 'قيمة الاجابة مطلوبة',
                                )
                        )
                )
        ),
    'users' =>
        array(
            'user_not_found' => 'هذا المستخدم غير موجود',
            'user_deleted_before' => 'تم حذف الحساب بالفعل',
            'user_deleted_successfully' => 'تم حذف الحساب بنجاح',
        ),
    'categories' =>
        array(
            'category_not_found' => 'هذا القسم غير موجود',
        ),
    'doctors' =>
        array(
            'doctor_not_found' => 'هذا المرشد غير موجود',
        ),
    'pages' =>
        array(
            'page_not_found' => 'هذه الصفحة غير موجودة',
        ),
    'ratings' =>
        array(
            'add_rating_success' => 'تم ارسال تقييمك بنجاح',
            'validation' =>
                array(
                    'doctor_id' =>
                        array(
                            'required' => 'الموشد مطلوب',
                        ),
                    'rating' =>
                        array(
                            'required' => 'التقييم مطلوب',
                            'integer' => 'التقييم يجب أن يكون رقم صحيح',
                        ),
                ),
        ),
    'reservations' =>
        array(
            'choose_another_date' => 'من فضلك اختر تاريخ اخر',
            'time_not_available' => 'التاريخ المختار غير متاح',
            'choose_another_date_befor_2_h' => "من فضلك اختر الوقت قبل الموعد ب :hour ساعه ",
            'missed_reservation' => 'لقد فوت تاريخ الحجز',
            'missed_reservation_not_paid' => 'لقد فوت تاريخ الحجز غير مدفوع',
            'reservation_not_found' => 'الحجز غير موجود',
            'already_reserved' => 'تم الحجز بالفعل',
            'status' =>
                array(
                    'upcoming' => 'قادمة',
                    'last' => 'سابقة',
                    'current' => 'حالية',
                ),
            'validation' =>
                array(
                    'doctor_id' =>
                        array(
                            'required' => 'من فضلك اختر المرشد',
                        ),
                    'service_id' =>
                        array(
                            'required' => 'من فضلك اختر الخدمة',
                        ),
                    'notes' =>
                        array(
                            'required' => 'الملاحظات مطلوبة',
                        ),
                    'date' =>
                        array(
                            'required' => 'تاريخ الحجز مطلوب',
                            'date_format' => 'تاريخ الحجز يجب أن يكون مثل Y-m-d',
                            'after_or_equal' => 'تاريخ الحجز يجب أن يكون أكبر من أو يساوى تاريخ اليوم',
                        ),
                ),
        ),
    'auth' =>
        array(
            'failed' => 'تأكد من البريد الالكترونى وكلمة المرور',
            'unautenticated' => 'من فضلك قم بتسجيل الدخول',
            'logout_success' => 'تم تسجيل الخروج بنجاح',
            'reset_password' => 'تم تغيير كلمة المرور بنجاح',
            'wrong_password' => 'كلمة المرور خطأ',
            'validation' =>
                array(
                    'email' =>
                        array(
                            'required' => 'من فضلك ادخل البريد الالكتروني',
                            'unique' => 'هذا البريد مستخدم من قبل',
                            'email' => 'يجب أن يكون البريد الإلكترونى عنوان بريد إلكتروني صحيح البُنية.',
                        ),
                    'mobile' =>
                        array(
                            'digits_between' => 'رقم الهاتف يجب الا يقل عن ٦ ارقام ولا يزيد عن ١١ ارقام',
                            'numeric' => 'من فضلك تآكد من ان رقم الهاتف ارقام فقط',
                            'required' => 'من فضلك ادخل رقم الهاتف',
                        ),
                    'calling_code' =>
                        array(
                            'digits_between' => 'كود الهاتف يجب الا يقل عن ٦ ارقام ولا يزيد عن ١١ ارقام',
                            'numeric' => 'من فضلك تآكد من ان كود الهاتف ارقام فقط',
                            'required' => 'من فضلك ادخل كود الهاتف',
                        ),
                    'name' =>
                        array(
                            'required' => 'من فضلك ادخل اسم المستخدم',
                        ),
                    'avatar' =>
                        array(
                            'image' => 'ملف الصورة غير صالح',
                            'mimes' => 'امتداد الصورة يجب أن يكون :values',
                            'max' => 'حجم الصورة يجب ألا يزيد عن :max',
                        ),
                    'password' =>
                        array(
                            'confirmed' => 'كلمة المرور غير متطابقة مع التآكيد',
                            'min' => 'يجب الا تقل كلمة المرور عن ٦ احرف',
                            'required' => 'من فضلك ادخل كلمة المرور',
                        ),
                    'new_password' =>
                        array(
                            'confirmed' => 'كلمة المرور غير متطابقة مع التآكيد',
                            'min' => 'يجب الا تقل كلمة المرور عن ٦ احرف',
                            'max' => 'كلمة المرور يجب ألات زيد عن 16 حرف',
                            'required' => 'من فضلك ادخل كلمة المرور',
                            'different' => 'كلمة المرور الجديدة مشابهة لكلمة المرور القديمة',
                        ),
                ),
        ),
    'availability-exceptions' =>
        array(
            'availability_exception_not_found' => 'هذا التاريخ غير موجود',
            'validation' =>
                array(
                    'off_date' =>
                        array(
                            'required' => 'التاريخ مطلوب',
                            'date_format' => 'صيغة التاريخ يجب أن تكون مثل Y-m-d',
                            'after_or_equal' => 'التاريخ يجب أن يكون أكبر من أو يساوى تاريخ اليوم',
                        ),
                    'off_from' =>
                        array(
                            'required' => 'غير متاح من مطلوب',
                        ),
                    'off_to' =>
                        array(
                            'required' => 'غير متاح الى مطلوب',
                        ),
                ),
        ),
);
