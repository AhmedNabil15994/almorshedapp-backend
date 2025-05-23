<?php

return array(
    'ads' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى الاعلانات',
                    'description' => 'المحتوى',
                    'end_date' => 'تاريخ الانتهاء',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات الاعلانات',
                    'link' => 'رابط الاعلان',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'start_date' => 'تاريخ البداية',
                    'status' => 'الحالة',
                    'title' => 'اضافة الاعلانات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'link' => 'الرابط',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الاعلانات',
                ),
            'title' => 'الاعلانات',
            'validation' =>
                array(
                    'end_date' =>
                        array(
                            'after' => 'تاريخ الانتهاء يجب ان يكون بعد تاريخ البداية',
                            'required' => 'تاريخ الانتهاء مطلوب',
                        ),
                    'image' =>
                        array(
                            'max' => 'من فضلك اختر صور لهذا الاعلان',
                            'required' => 'صورة الاعلان مطلوبة',
                        ),
                    'link' =>
                        array(
                            'required' => 'رابط الاعلان مطلوب',
                            'url' => 'الرابط غير صحيح',
                        ),
                    'name' =>
                        array(
                            'required' => 'العنوان مطلوب',
                        ),
                    'start_date' =>
                        array(
                            'required' => 'تاريخ البداية مطلوب',
                        ),
                ),
        ),
    'answers' =>
        array(
            'create' =>
                array(
                    'answer' => 'الاجابة',
                    'question' => 'السؤال',
                    'status' => 'الحالة',
                    'title' => 'إضافة الاجابات',
                    'value' => 'قيمة الاجابة',
                ),
            'datatable' =>
                array(
                    'answer' => 'نص الاجابة',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الاجابات',
                ),
            'title' => 'الاجابات',
            'validation' =>
                array(
                    'answer' =>
                        array(
                            'required' => 'نص الاجابة مطلوب',
                        ),
                    'value' =>
                        array(
                            'required' => 'قيمة الاجابة مطلوبة',
                        ),
                ),
        ),
    'articles' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى المقالات',
                    'content' => 'محتوى المقال',
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات المقالات',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة المقالات',
                ),
            'datatable' =>
                array(
                    'content' => 'المحتوى',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل المقالات',
                ),
            'title' => 'المقالات',
            'validation' =>
                array(
                    'content' =>
                        array(
                            'required' => 'المحتوى مطلوب',
                        ),
                    'image' =>
                        array(
                            'max' => 'من فضلك اختر صور لهذا المقال',
                            'required' => 'صورة المقال مطلوبة',
                        ),
                    'name' =>
                        array(
                            'required' => 'العنوان مطلوب',
                        ),
                ),
        ),
    'aside' =>
        array(
            'ads' => 'الاعلانات',
            'articles' => 'المقالات',
            'assessments' => 'الاختبارات',
            'attribute_sets' => 'مجموعة الصفات',
            'attribute_values' => 'قيم الصفات',
            'attributes' => 'الصفات',
            'categories' => 'الاقسام',
            'colors' => 'الالوان',
            'control' => 'التحكم',
            'dashboard' => 'لوحة التحكم',
            'doctors' => 'المرشدين',
            'languages' => 'اللغات',
            'logs' => 'عرض الاخطاء',
            'multi' =>
                array(
                    'attributes' => 'الصفات و المميزات',
                    'options' => 'الخيارات الاضافية',
                ),
            'option_values' => 'قيم الخيارات الاضافية',
            'options' => 'الخيارات الاضافية',
            'orderStatuses' => 'حالات الطلب',
            'pages' => 'الصفحات',
            'permissions' => 'الصلاحيات',
            'products' => 'المنتجات',
            'reservations' => 'الحجوزات',
            'roles' => 'الادوار و المهام',
            'services' => 'الخدمات',
            'settings_tab' => 'الاعدادات',
            'sizes' => 'الاحجام',
            'sliders' => 'صور السلايدر',
            'store' => 'إعدادات عامة',
            'translations' => 'الترجمة',
            'users' => 'الاعضاء',
            'users_tab' => 'الاعضاء و الصلاحيات',
            'notifications' => 'إشعارات عامة',
            'reports' => 'التقارير',
        ),
    'assessments' =>
        array(
            'create' =>
                array(
                    'add_answer' => 'إضافة إجابة',
                    'description' => 'الوصف',
                    'doctor' => 'الاستشارى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'البيانات',
                    'message' => 'الرسالة',
                    'name' => 'العنوان',
                    'price' => 'السعر',
                    'questions' => 'الأسئلة',
                    'rank' => 'التقييم',
                    'result_ranges' => 'مستويات النتائج',
                    'score_from' => 'النتيجة من',
                    'score_to' => 'النتيجة الى',
                    'status' => 'الحالة',
                    'title' => 'إضافة الاختبارات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الاختبارات',
                ),
            'title' => 'الاختبارات',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'الوصف مطلوب',
                        ),
                    'doctor_id' =>
                        array(
                            'required' => 'من فضلك اختر المسشتار',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                            'required' => 'الصورة مطلوبة',
                        ),
                    'name' =>
                        array(
                            'required' => 'العنوان مطلوب',
                        ),
                    'price' =>
                        array(
                            'required' => 'السعر مطلوب',
                        ),
                ),
        ),
    'attribute_sets' =>
        array(
            'create' =>
                array(
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات مجموعة الصفات',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة مجموعة الصفات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل مجموعة الصفات',
                ),
            'title' => 'مجموعة الصفات',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان مجموعة الصفات',
                        ),
                ),
        ),
    'attribute_values' =>
        array(
            'create' =>
                array(
                    'attributes' => 'الصفة',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات قيم الصفات',
                    'name' => 'القيمة',
                    'status' => 'الحالة',
                    'title' => 'اضافة قيم للصفات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'القيمة',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'القيمة',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل بيانات القيم للصفات',
                ),
            'title' => 'قيم الصفات',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان القيمة',
                        ),
                ),
        ),
    'attribute_valuess' =>
        array(
            'validation' =>
                array(
                    'attribute_id' =>
                        array(
                            'required' => 'من فضلك اختر الصفة لهذه القيمة',
                        ),
                ),
        ),
    'attributes' =>
        array(
            'create' =>
                array(
                    'attribute_sets' => 'مجموعة الصفات',
                    'categories' => 'الاقسام',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات الصفات',
                    'is_filterable' => 'قابل للبحث',
                    'name' => 'العنوان',
                    'order' => 'ترتيب قيم الصفات',
                    'other' => 'اخرى',
                    'sort-btn' => 'ترتيب',
                    'status' => 'الحالة',
                    'title' => 'اضافة الصفات',
                ),
            'datatable' =>
                array(
                    'attribute_set' => 'مجموعة الصفات',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الصفات',
                ),
            'title' => 'الصفات',
            'validation' =>
                array(
                    'attribute_set_id' =>
                        array(
                            'required' => 'من فضلك اختر مجموعة الصفات لهذه الصفة',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الصفة',
                        ),
                ),
        ),
    'availabilities' =>
        array(
            'create' =>
                array(
                    'available_from' => 'متاح من',
                    'available_to' => 'إلى',
                    'status' => 'الحالة',
                    'title' => 'إضافة وقت متاح',
                ),
            'datatable' =>
                array(
                    'available_from' => 'متاح من',
                    'available_to' => 'إلى',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل وقت متاح',
                ),
            'title' => 'وقت متاح',
            'validation' =>
                array(
                    'available_from' =>
                        array(
                            'required' => 'متاح من مطلوب',
                        ),
                    'available_to' =>
                        array(
                            'required' => 'متاح الى مطلوب',
                        ),
                ),
        ),
    'availability-exceptions' =>
        array(
            'create' =>
                array(
                    'off_date' => 'التاريخ',
                    'off_from' => 'غير متاح من',
                    'off_to' => 'إلى',
                    'status' => 'الحالة',
                    'title' => 'أيام وساعات الإجازة',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'off_date' => 'التاريخ',
                    'off_from' => 'غير متاح من',
                    'off_to' => 'إلى',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل وقت غير متاح',
                ),
            'title' => 'وقت غير متاح',
            'validation' =>
                array(
                    'off_date' =>
                        array(
                            'required' => 'التاريخ مطلوب',
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
    'categories' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى القسم',
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات القسم',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة اقسام',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل القسم',
                ),
            'title' => 'الاقسام',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'يجب تحديد مستوى القسم',
                        ),
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى القسم',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان القسم',
                        ),
                ),
        ),
    'colors' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى الالوان',
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات الالوان',
                    'link' => 'رابط الالوان',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة الالوان',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'link' => 'الرابط',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الالوان',
                ),
            'title' => 'الالوان',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'يجب تحديد مستوى الالوان',
                        ),
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى الالوان',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الالوان',
                        ),
                ),
        ),
    'datatable' =>
        array(
            'colvis' => 'الاعمدة',
            'excel' => 'ملف اكسيل',
            'pageLength' => 'عدد الحقول',
            'pdf' => 'ملف PDF',
            'print' => 'طباعة',
            'active' => 'مفعل',
            'not_active' => 'غير مفعل',
        ),
    'doctors' =>
        array(
            'create' =>
                array(
                    'academic_degree' => 'الدرجة العلمية',
                    'account_name' => 'أسم الحساب البنكي بالكامل',
                    'avatar' => 'الصورة الشخصية',
                    'categories' => 'الأقسام',
                    'confirm_password' => 'تآكيد كلمة المرور',
                    'current_workplaces' => 'الخبرات الحالية',
                    'day' => 'اليوم',
                    'email' => 'البريد الالكتروني',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'البيانات',
                    'language' => 'اللغة',
                    'mobile' => 'رقم الهاتف',
                    'name' => 'الاسم',
                    'password' => 'كلمة المرور',
                    'previous_experience' => 'الخبرات السابقة',
                    'price' => 'السعر',
                    'roles' => 'الادوار',
                    'services_prices' => 'أسعار الخدمات',
                    'specialization' => 'التخصص',
                    'title' => 'إضافة مستشار',
                    'working_days' => 'ساعات العمل',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'email' => 'البريد الالكتروني',
                    'image' => 'الصورة',
                    'mobile' => 'الموبيل',
                    'name' => 'الاسم',
                    'options' => 'خيارات',
                ),
            'edit' =>
                array(
                    'title' => 'حفظ',
                ),
            'title' => 'المرشد',
            'validation' =>
                array(
                    'academic_degree' =>
                        array(
                            'required' => 'الدرجة العلمية مطلوبة',
                        ),
                    'categories' =>
                        array(
                            'required' => 'من فضلك اختر القسم',
                        ),
                    'current_workplaces' =>
                        array(
                            'required' => 'الخبرات الحالية مطلوبة',
                        ),
                    'email' =>
                        array(
                            'required' => 'من فضلك ادخل البريد الالكتروني',
                            'unique' => 'هذا البريد تم ادخالة من قبل',
                            'email' => 'يجب أن يكون البريد الإلكترونى عنوان بريد إلكتروني صحيح البُنية.',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'languages' =>
                        array(
                            'required' => 'من فضلك اختر اللغة',
                        ),
                    'mobile' =>
                        array(
                            'numeric' => 'يجب ان يتكون رقم الموبيل من ارقام انجليزية',
                            'required' => 'من فضلك ادخل رقم الهاتف',
                        ),
                    'name' =>
                        array(
                            'required' => 'من فضلك ادخل الاسم',
                        ),
                    'password' =>
                        array(
                            'confirmed' => 'كلمة المرور غير مطابقة لكلمة التآكيد',
                            'min' => 'يجب الا تقل كلمة المرور عن ٦ احرف',
                            'required' => 'من فضلك ادخل كلمة المرور',
                        ),
                    'previous_experience' =>
                        array(
                            'required' => 'الخبرات السابقة مطلوبة',
                        ),
                    'specialization' =>
                        array(
                            'required' => 'التخصص مطلوب',
                        ),
                ),
        ),
    'footer' =>
        array(
            'copy_rights' => 'جميع الحقوق محفوظة',
        ),
    'general' =>
        array(
            'add_btn' => 'اضافة',
            'add_new' => 'اضافة جديد',
            'back_btn' => 'للخلف',
            'send_btn' => 'ارسال',
            'create_success_alert' => 'تم الاضافة بنجاح',
            'date_range' =>
                array(
                    '30days' => 'اخر ٣٠ يوم',
                    '7days' => 'اخر ٧ ايام',
                    'cancel' => 'الغاء',
                    'custom' => 'ترتيب خاص',
                    'last_month' => 'الشهر السابق',
                    'month' => 'هذا الشهر',
                    'save' => 'حفظ',
                    'today' => 'اليوم',
                    'yesterday' => 'امس',
                ),
            'delete_success_alert' => 'تم الحذف بنجاح',
            'edit_btn' => 'حفظ',
            'msg_all_delete' => 'هل تريد حذف الحقول المحددة ؟',
            'msg_delete' => 'هل تريد حذف هذا الحقل ؟',
            'no_delete' => 'لا',
            'ops_alert' => 'حدث خطا ما',
            'update_success_alert' => 'تم الحفظ بنجاح',
            'yes_delete' => 'نعم',
        ),
    'home' =>
        array(
            'home' => 'الرئيسية',
            'title' => 'لوحة التحكم',
            'welcome' => 'اهلا بك',
        ),
    'languages' =>
        array(
            'create' =>
                array(
                    'language' => 'كود اللغة',
                    'name' => 'الاسم',
                    'status' => 'الحالة',
                    'title' => 'إضافة الغات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'language' => 'كود اللغة',
                    'name' => 'الاسم',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل اللغات',
                ),
            'title' => 'اللغات',
            'validation' =>
                array(
                    'language' =>
                        array(
                            'required' => 'كود اللغة مطلوب',
                        ),
                    'name' =>
                        array(
                            'required' => 'الاسم مطلوب',
                        ),
                ),
        ),
    'nav' =>
        array(
            'logout' => 'تسجيل الخروج',
            'profile' => 'الملف الشخصي',
        ),
    'option_values' =>
        array(
            'create' =>
                array(
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات قيم الخيارات الاضافية',
                    'name' => 'قيمة الخيار الاضافي',
                    'options' => 'الخيار الاضافي',
                    'status' => 'الحالة',
                    'title' => 'اضافة قيم للخيارات الاضافية',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'القيمة',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'القيمة',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل بيانات القيم للخيار الاضافي',
                ),
            'title' => 'قيم  الخيار الاضافي',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان القيمة',
                        ),
                ),
        ),
    'options' =>
        array(
            'create' =>
                array(
                    'attribute_sets' => 'مجموعة الصفات',
                    'categories' => 'الاقسام',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات الخيارات الاضافية',
                    'is_filterable' => 'قابل للبحث',
                    'name' => 'العنوان',
                    'order' => 'ترتيب قيم الخيارات الاضافية',
                    'other' => 'اخرى',
                    'sort-btn' => 'ترتيب',
                    'status' => 'الحالة',
                    'title' => 'اضافة خيارات اضافية',
                ),
            'datatable' =>
                array(
                    'attribute_set' => 'مجموعة الصفات',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الخيارات الاضافية',
                ),
            'title' => 'الخيارات الاضافية',
            'validation' =>
                array(
                    'attribute_set_id' =>
                        array(
                            'required' => 'من فضلك اختر مجموعة الصفات لهذه الصفة',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الخيار الاضافي',
                        ),
                ),
        ),
    'orderStatuses' =>
        array(
            'create' =>
                array(
                    'code' => 'كود الحالة',
                    'title' => 'حالة الطلب',
                ),
            'datatable' =>
                array(
                    'code' => 'كود الحالة',
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'حالة الطلب',
                ),
            'edit' =>
                array(
                    'title' => 'حالة الطلب',
                ),
            'title' => 'حالات الطلب',
            'validation' =>
                array(
                    'code' =>
                        array(
                            'required' => 'كود الحالة مطلوب',
                        ),
                    'title' =>
                        array(
                            'required' => 'حالة الطلب مطلوبة',
                        ),
                ),
        ),
    'pages' =>
        array(
            'create' =>
                array(
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات الصفحة',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة صفحات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الصفحة',
                ),
            'title' => 'الصفحات',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى الصفحة',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الصفحة',
                        ),
                ),
        ),
    'permissions' =>
        array(
            'create' =>
                array(
                    'description' => 'وصف الصلاحية',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات الصلاحية',
                    'key' => 'رمز الصلاحية',
                    'name' => 'اسم الصلاحية',
                    'title' => 'اضافة صلاحيات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'رمز المجموعة',
                    'options' => 'خيارات',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الصلاحية',
                ),
            'title' => 'الصلاحيات',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل الوصف',
                        ),
                    'display_name' =>
                        array(
                            'required' => 'من فضلك ادخل رمز الصلاحية',
                            'unique' => 'هذا الرمز مدخل من قبل',
                        ),
                    'name' =>
                        array(
                            'required' => 'من فضلك ادخل اسم الصلاحية',
                            'unique' => 'هذه الصلاحية مدخلة من قبل',
                        ),
                ),
        ),
    'products' =>
        array(
            'create' =>
                array(
                    'attribute_values' => 'القيم',
                    'attributes' => 'الصفات',
                    'categories' => 'الاقسام',
                    'color' => 'الالوان',
                    'colors' => 'الالوان',
                    'description' => 'المحتوى',
                    'gallery_images' => 'معرض الصور',
                    'general' => 'بيانات عامة',
                    'images' => 'الصور',
                    'info' => 'بيانات المنتج',
                    'inventory_price' => 'المخزون و السعر',
                    'main_images' => 'الصورة الرئيسية',
                    'name' => 'العنوان',
                    'new_product' => 'منتج جديد',
                    'new_product_from' => 'يبدا المنتج الجديد',
                    'new_product_to' => 'ينتهي المنتج الجديد',
                    'options' => 'الخيارات الاضافية',
                    'price' => 'سعر المنتج',
                    'qty' => 'الكمية',
                    'size' => 'الاحجام',
                    'sizes' => 'الحجم',
                    'sku' => 'الكود - SKU',
                    'special_price' => 'سعر خاص',
                    'special_price_from' => 'يبدا السعر الخاص',
                    'special_price_to' => 'ينتهي السعر الخاص',
                    'status' => 'الحالة',
                    'table_image' => 'جدول القياسات',
                    'title' => 'اضافة المنتجات',
                    'variations' => 'الخصائص للمنتج',
                    'video_link' => 'رابط الفيديو',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'price' => 'السعر',
                    'sku' => 'الكود',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل المنتج',
                ),
            'title' => 'المنتجات',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'من فضلك اختر قسم واحد على الاقل',
                        ),
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى المنتج',
                        ),
                    'image' =>
                        array(
                            'max' => 'من فضلك قم باختيار الصورة الرئيسية ، واحده فقط',
                            'required' => 'من فضلك قم باختيار الصورة الرئيسية للمنتج',
                        ),
                    'price' =>
                        array(
                            'required' => 'من فضلك ادخل سعر المنتج',
                        ),
                    'qty' =>
                        array(
                            'required' => 'من فضلك ادخل كمية المنتج',
                        ),
                    'sku' =>
                        array(
                            'required' => 'من فضلك ادخل كود المنتج',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الصفحة',
                        ),
                ),
        ),
    'questions' =>
        array(
            'create' =>
                array(
                    'answer' => 'الاجابة',
                    'assessment' => 'الاختبار',
                    'question' => 'السؤال',
                    'status' => 'الحالة',
                    'title' => 'إضافة الاسئلة',
                    'value' => 'قيمة الاجابة',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'options' => 'خيارات',
                    'question' => 'نص السؤال',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الاسئلة',
                ),
            'title' => 'الاسئلة',
            'validation' =>
                array(
                    'answer' =>
                        array(
                            'required' => 'الاجابة مطلوبة',
                        ),
                    'question' =>
                        array(
                            'required' => 'نص السؤال مطلوب',
                        ),
                ),
        ),
    'reservations' =>
        array(
            'create' =>
                array(
                    'info' => 'بيانات عامة',
                    'general' => 'بيانات عامة',
                    'title' => 'انشاء الحجوزات',
                    'change_apponitment' => 'تغيير الموعد',
                    'date' => 'تاريخ الحجز',
                    'service' => 'الخدمة',
                    'doctor' => 'المرشد',
                    'end_time' => 'وقت النهاية',
                    'is_paid' => 'حالة الدفع',
                    'order_status_id' => 'الحالة',
                    'price' => 'السعر',
                    'start_time' => 'وقت البداية',
                    'username' => 'اسم المستخدم',
                    'reason' => 'السبب',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date' => 'تاريخ الحجز',
                    'date_range' => 'فترة زمنية',
                    'doctor' => 'المرشد',
                    'end_time' => 'وقت النهاية',
                    'options' => 'خيارات',
                    'price' => 'السعر',
                    'service_name' => 'الخدمة',
                    'services' => 'الخدمة',
                    'start_time' => 'وقت البداية',
                    'status' => 'الحالة',
                    'username' => 'اسم المستخدم',
                    'user_id' => 'رقم المستخدم',
                    'user_email' => 'البريد الإلكترونى للمستخدم',
                    'user_mobile' => 'رقم الهاتف للمستخدم',
                    'doctor_email' => 'البريد الإلكترونى للمرشد',
                    'doctor_id' => 'رقم المرشد',
                    'order_status' => 'حالة الدفع',
                    'payment_type' => 'نوعية الدفع',
                    'cash_visa' => 'كاش / فيزا / ماستر',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الحجوزات',
                ),
            'title' => 'الحجوزات',
            'validation' =>
                array(
                    'availability_id' =>
                        array(
                            'required' => 'تاريخ البداية مطلوب',
                        ),
                    'order_status_id' =>
                        array(
                            'required' => 'من فضلك اختر الحالة',
                        ),
                    'required_at' =>
                        array(
                            'required' => 'وقت الحجز مطلوب',
                        ),
                ),
        ),
    'roles' =>
        array(
            'create' =>
                array(
                    'description' => 'وصف الدور',
                    'general' => 'بيانات عامة',
                    'info' => 'بيانات الدور',
                    'key' => 'رمز الدور',
                    'name' => 'العنوان',
                    'permissions' => 'الصلاحيات',
                    'title' => 'اضافة ادوار',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'name' => 'رمز الدور',
                    'options' => 'خيارات',
                    'permissions' => 'الصلاحيات',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الدور',
                ),
            'title' => 'الادوار',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل الوصف',
                        ),
                    'display_name' =>
                        array(
                            'required' => 'من فضلك ادخل رمز الدور',
                            'unique' => 'هذا الرمز مدخل من قبل',
                        ),
                    'name' =>
                        array(
                            'required' => 'من فضلك ادخل اسم الدور',
                            'unique' => 'هذه الصلاحية مدخلة من قبل',
                        ),
                ),
        ),
    'services' =>
        array(
            'create' =>
                array(
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'إضافة الخدمات',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الخدمات',
                ),
            'title' => 'الخدمات',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'الوصف مطلوب',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                            'required' => 'الصورة مطلوبة',
                        ),
                    'name' =>
                        array(
                            'required' => 'العنوان مطلوب',
                        ),
                ),
        ),
    'settings' =>
        array(
            'Language_label' => 'اللغات',
            'countries_label' => 'الدول',
            'currencies_label' => 'العملات',
            'default_country' => 'الدولة الاساسية',
            'default_currency' => 'العملة الاساسية',
            'default_language' => 'اللغة الاساسية',
            'default_shipping' => 'التوصيل الثابت',
            'force_update' => 'تحديث ضروري',
            'general' => 'عامة',
            'general_data' => 'بيانات عامة',
            'info' => 'الاعدادات',
            'logo' => 'اللوجو',
            'mail' => 'اعدادات البريد الالكتروني',
            'mail_driver' => 'Mail Driver',
            'mail_encryption' => 'Mail Encryption',
            'mail_host' => 'Mail Host',
            'mail_password' => 'Password',
            'mail_port' => 'Mail Port',
            'mail_username' => 'Username',
            'mail_cc' => 'CC E-mail',
            'other' => 'اخرى',
            'privacy_policy' => 'الشروط و الاحكام',
            'save_buttons' => 'حفظ التغيرات',
            'shipping' => 'التوصيل',
            'shipping_label' => 'التوصيل',
            'social_media' => 'التواصل الاجتماعي',
            'supported_countries' => 'الدول المدعومة',
            'supported_currencies' => 'العملات المدعومة',
            'supported_language' => 'اللغات المدعومة',
            'title' => 'الاعدادات',
            'title_label' => 'العنوان',
        ),
    'sizes' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى الاحجام',
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات الاحجام',
                    'link' => 'رابط الاحجام',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة الاحجام',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'link' => 'الرابط',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل الاحجام',
                ),
            'title' => 'الاحجام',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'يجب تحديد مستوى الاحجام',
                        ),
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى الاحجام',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان الاحجام',
                        ),
                ),
        ),
    'sliders' =>
        array(
            'create' =>
                array(
                    'category_level' => 'مستوى السلايدر',
                    'description' => 'المحتوى',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات السلايدر',
                    'link' => 'رابط السلايدر',
                    'main_tree' => 'قسم رئيسي',
                    'name' => 'العنوان',
                    'status' => 'الحالة',
                    'title' => 'اضافة السلايدر',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'description' => 'الوصف',
                    'image' => 'الصورة',
                    'link' => 'الرابط',
                    'name' => 'العنوان',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                    'title' => 'العنوان',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل السلايدر',
                ),
            'title' => 'السلايدر',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'يجب تحديد مستوى السلايدر',
                        ),
                    'description' =>
                        array(
                            'required' => 'من فضلك ادخل محتوى السلايدر',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'title' =>
                        array(
                            'required' => 'من فضلك ادخل عنوان السلايدر',
                        ),
                ),
        ),
    'users' =>
        array(
            'create' =>
                array(
                    'avatar' => 'الصورة الشخصية',
                    'confirm_password' => 'تآكيد كلمة المرور',
                    'email' => 'البريد الالكتروني',
                    'general' => 'بيانات عامة',
                    'image' => 'الصورة',
                    'info' => 'بيانات العضو',
                    'mobile' => 'رقم الهاتف',
                    'name' => 'اسم العضو',
                    'password' => 'كلمة المرور',
                    'roles' => 'الادوار',
                    'status' => 'الحالة',
                    'title' => 'اضافة اعضاء',
                ),
            'datatable' =>
                array(
                    'created_at' => 'تاريخ الانشاء',
                    'date_range' => 'فترة زمنية',
                    'email' => 'البريد الالكتروني',
                    'image' => 'الصورة',
                    'mobile' => 'الموبيل',
                    'name' => 'اسم العضو',
                    'options' => 'خيارات',
                    'status' => 'الحالة',
                ),
            'edit' =>
                array(
                    'title' => 'تعديل العضو',
                ),
            'title' => 'الاعضاء',
            'validation' =>
                array(
                    'email' =>
                        array(
                            'required' => 'من فضلك ادخل البريد الالكتروني',
                            'unique' => 'هذا البريد تم ادخالة من قبل',
                            'email' => 'يجب أن يكون البريد الإلكترونى عنوان بريد إلكتروني صحيح البُنية.',
                        ),
                    'image' =>
                        array(
                            'max' => 'يجب عليك اختيار صورة واحده فقط',
                        ),
                    'mobile' =>
                        array(
                            'numeric' => 'يجب ان يتكون رقم الموبيل من ارقام انجليزية',
                            'required' => 'من فضلك ادخل رقم الهاتف',
                        ),
                    'name' =>
                        array(
                            'required' => 'من فضلك ادخل اسم العضو',
                        ),
                    'password' =>
                        array(
                            'confirmed' => 'كلمة المرور غير مطابقة لكلمة التآكيد',
                            'min' => 'يجب الا تقل كلمة المرور عن ٦ احرف',
                            'required' => 'من فضلك ادخل كلمة المرور',
                        ),
                ),
        ),
    'notifications' => [
        'title' => 'اشعارات عامة',
        'create' => [
            'title' => 'اضافة اشعارات عامة للمستخدمين',
            'name' => 'ارسال الإشعارات',
            'msg_title' => 'عنوان الرسالة',
            'msg_title_placeholder' => 'مثال : شاهد المنتجات الجديدة',
            'msg_body' => 'محتوى الرسالة',
        ],
    ],
);
