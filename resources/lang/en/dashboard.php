<?php

return array(
    'ads' =>
        array(
            'create' =>
                array(
                    'category_level' => 'Category Level',
                    'description' => 'Description',
                    'end_date' => 'End date',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Category Information',
                    'link' => 'URL',
                    'main_tree' => 'Main Category',
                    'name' => 'Title',
                    'start_date' => 'Start date',
                    'status' => 'Status',
                    'title' => 'Create Ads',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Category Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Category',
                ),
            'title' => 'Categories',
            'validation' =>
                array(
                    'end_date' =>
                        array(
                            'after' => 'End date should be greater than start date',
                            'required' => 'End date is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'Please select one image only for this ad',
                            'required' => 'Please upload the image of ad',
                        ),
                    'link' =>
                        array(
                            'required' => 'Ad URL is required',
                            'url' => 'Ad URL is wrong',
                        ),
                    'name' =>
                        array(
                            'required' => 'Title is required',
                        ),
                    'start_date' =>
                        array(
                            'required' => 'Start date is required',
                        ),
                ),
        ),
    'answers' =>
        array(
            'create' =>
                array(
                    'answer' => 'Answer',
                    'question' => 'Question',
                    'status' => 'Status',
                    'title' => 'Add Answers',
                    'value' => 'Value',
                ),
            'datatable' =>
                array(
                    'answer' => 'Answer',
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Answers',
                ),
            'title' => 'Answers',
            'validation' =>
                array(
                    'answer' =>
                        array(
                            'required' => 'Answer is required',
                        ),
                    'value' =>
                        array(
                            'required' => 'Answer value is required',
                        ),
                ),
        ),
    'articles' =>
        array(
            'create' =>
                array(
                    'category_level' => 'Category Level',
                    'content' => 'Content',
                    'description' => 'Description',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Category Information',
                    'link' => 'URL',
                    'main_tree' => 'Main Category',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Create Categories',
                ),
            'datatable' =>
                array(
                    'content' => 'Content',
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Category',
                ),
            'title' => 'Articles',
            'validation' =>
                array(
                    'content' =>
                        array(
                            'required' => 'Content is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'Please select one image only for this article',
                            'required' => 'Please upload the image of article',
                        ),
                    'name' =>
                        array(
                            'required' => 'Title is required',
                        ),
                ),
        ),
    'aside' =>
        array(
            'ads' => 'Ads',
            'articles' => 'Articles',
            'assessments' => 'Assessments',
            'attribute_sets' => 'Attribute Sets',
            'attribute_values' => 'Attribute Values',
            'attributes' => 'Attributes',
            'categories' => 'Categories',
            'control' => 'Control',
            'dashboard' => 'Dashboard',
            'doctors' => 'Consulers',
            'languages' => 'Languages',
            'logs' => 'Logs Viewer',
            'multi' =>
                array(
                    'attributes' => 'Attributes Sets & Values',
                    'options' => 'Options Groups & Values',
                ),
            'option_values' => 'Option Values',
            'options' => 'Options',
            'orderStatuses' => 'Order statuses',
            'pages' => 'Pages',
            'permissions' => 'Permissions',
            'products' => 'Products',
            'reservations' => 'Reservations',
            'roles' => 'Roles',
            'services' => 'Services',
            'settings_tab' => 'Settings',
            'sliders' => 'Slider',
            'store' => 'General Settings',
            'translations' => 'Translations',
            'users' => 'Users',
            'users_tab' => 'Users & Permissions',
            'notifications' => 'General Notifications',
            'reports' => 'Reports',
        ),
    'assessments' =>
        array(
            'create' =>
                array(
                    'add_answer' => 'Add answer',
                    'description' => 'Description',
                    'doctor' => 'Consuler',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Info',
                    'message' => 'Message',
                    'name' => 'Title',
                    'price' => 'Price',
                    'questions' => 'Questions',
                    'rank' => 'Rank',
                    'result_ranges' => 'Result ranges',
                    'score_from' => 'Score from',
                    'score_to' => 'Score to',
                    'status' => 'Status',
                    'title' => 'Add Assessments',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'name' => 'Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Assessments',
                ),
            'title' => 'Assessments',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'Description is required',
                        ),
                    'doctor_id' =>
                        array(
                            'required' => 'Consuler is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must choose only one image',
                            'required' => 'Image is required',
                        ),
                    'name' =>
                        array(
                            'required' => 'Title is required',
                        ),
                    'price' =>
                        array(
                            'required' => 'Price is required',
                        ),
                ),
        ),
    'attribute_sets' =>
        array(
            'create' =>
                array(
                    'general' => 'General',
                    'info' => 'Attribute Sets Information',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Create Attribute Sets',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Attribute Sets',
                ),
            'title' => 'Attribute Sets',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'attribute_values' =>
        array(
            'create' =>
                array(
                    'attributes' => 'Attributes',
                    'general' => 'General',
                    'info' => 'Attribute Values Information',
                    'name' => 'Value',
                    'status' => 'Status',
                    'title' => 'Create Attribute Values',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Value',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Value',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Attribute Values',
                ),
            'title' => 'Attribute Values',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'Value field is required',
                        ),
                ),
        ),
    'attribute_valuess' =>
        array(
            'validation' =>
                array(
                    'attribute_id' =>
                        array(
                            'required' => 'Please select attribute for this value',
                        ),
                ),
        ),
    'attributes' =>
        array(
            'create' =>
                array(
                    'attribute_sets' => 'Attribute Sets',
                    'categories' => 'Categories',
                    'general' => 'General',
                    'info' => 'Attribute Information',
                    'is_filterable' => 'Filterable',
                    'name' => 'Title',
                    'order' => 'Sorting Values',
                    'other' => 'Others',
                    'sort-btn' => 'Sorting',
                    'status' => 'Status',
                    'title' => 'Create Attributes',
                ),
            'datatable' =>
                array(
                    'attribute_set' => 'Attribute Sets',
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Attribute Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Attribute',
                ),
            'title' => 'Attributes',
            'validation' =>
                array(
                    'attribute_set_id' =>
                        array(
                            'required' => 'Please select attribute sets for this attribute',
                        ),
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'availabilities' =>
        array(
            'create' =>
                array(
                    'available_from' => 'Available from',
                    'available_to' => 'Available to',
                    'status' => 'Status',
                    'title' => 'Add availabilities',
                ),
            'datatable' =>
                array(
                    'available_from' => 'Available from',
                    'available_to' => 'Available to',
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit availabilities',
                ),
            'title' => 'Availabilities',
            'validation' =>
                array(
                    'available_from' =>
                        array(
                            'required' => 'Available from is required',
                        ),
                    'available_to' =>
                        array(
                            'required' => 'Available to is required',
                        ),
                ),
        ),
    'availability-exceptions' =>
        array(
            'create' =>
                array(
                    'off_date' => 'Unavailable date',
                    'off_from' => 'Unavailable from',
                    'off_to' => 'Unavailable to',
                    'status' => 'Status',
                    'title' => 'Add Unavailable date',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'off_date' => 'Unavailable Date',
                    'off_from' => 'Unavailable from',
                    'off_to' => 'Unavailable to',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Unavailable date',
                ),
            'title' => 'Unavailable Date',
            'validation' =>
                array(
                    'off_date' =>
                        array(
                            'required' => 'Unavailable date is required',
                        ),
                    'off_from' =>
                        array(
                            'required' => 'Unavailable from is required',
                        ),
                    'off_to' =>
                        array(
                            'required' => 'Unavailable to is required',
                        ),
                ),
        ),
    'categories' =>
        array(
            'create' =>
                array(
                    'category_level' => 'Category Level',
                    'description' => 'Description',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Category Information',
                    'main_tree' => 'Main Category',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Create Categories',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Category Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Category',
                ),
            'title' => 'Categories',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'You must select category level for this category',
                        ),
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must chose only one image',
                        ),
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'datatable' =>
        array(
            'colvis' => 'Columns',
            'excel' => 'Excel',
            'pageLength' => 'Page Length',
            'pdf' => 'PDF',
            'print' => 'Print',
            'active' => 'Active',
            'not_active' => 'Not Active',
        ),
    'doctors' =>
        array(
            'create' =>
                array(
                    'academic_degree' => 'Academic degree',
                    'account_name' => 'Bank Account Full Name',
                    'avatar' => 'Avatar',
                    'categories' => 'Categories',
                    'confirm_password' => 'Confirm Password',
                    'current_workplaces' => 'Current workplaces',
                    'day' => 'Day',
                    'email' => 'E-mail',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Consuler Information',
                    'language' => 'Language',
                    'mobile' => 'Mobile',
                    'name' => 'Username',
                    'password' => 'Password',
                    'previous_experience' => 'previous experience',
                    'price' => 'Price',
                    'roles' => 'Roles',
                    'services_prices' => 'Services prices',
                    'specialization' => 'Specialization',
                    'title' => 'Create Consuler',
                    'working_days' => 'Woking days',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'email' => 'E-mail',
                    'image' => 'Image',
                    'mobile' => 'Mobile',
                    'name' => 'username',
                    'options' => 'Options',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Consuler',
                ),
            'title' => 'Consulers',
            'validation' =>
                array(
                    'academic_degree' =>
                        array(
                            'required' => 'Please fill the academic degree input',
                        ),
                    'categories' =>
                        array(
                            'required' => 'Please select the category',
                        ),
                    'current_workplaces' =>
                        array(
                            'required' => 'Please fill the current workplaces input',
                        ),
                    'email' =>
                        array(
                            'required' => 'E-mail is required',
                            'unique' => 'This email is taken before',
                            'email' => 'The email must be a valid email address',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must chose only one image',
                        ),
                    'languages' =>
                        array(
                            'required' => 'Please select the language',
                        ),
                    'mobile' =>
                        array(
                            'numeric' => 'Please put english numbers only in mobile field',
                            'required' => 'Mobile is required',
                        ),
                    'name' =>
                        array(
                            'required' => 'Please fill the name input',
                        ),
                    'password' =>
                        array(
                            'confirmed' => 'Password not matching the confirmation',
                            'min' => 'Password must be more than 6 characters',
                            'required' => 'Password is required',
                        ),
                    'previous_experience' =>
                        array(
                            'required' => 'Please fill the previous experience input',
                        ),
                    'specialization' =>
                        array(
                            'required' => 'Please fill the specialization input',
                        ),
                ),
        ),
    'footer' =>
        array(
            'copy_rights' => 'Copy Rights',
        ),
    'general' =>
        array(
            'add_btn' => 'Add',
            'add_new' => 'Add New',
            'back_btn' => 'Back',
            'send_btn' => 'Send',
            'create_success_alert' => 'Added Successfully',
            'date_range' =>
                array(
                    '30days' => 'Last 30 Days',
                    '7days' => 'Last 7 Days',
                    'cancel' => 'Cancel',
                    'custom' => 'Custom Range',
                    'last_month' => 'Last Month',
                    'month' => 'This Month',
                    'save' => 'Save',
                    'today' => 'Today',
                    'yesterday' => 'Yesterday',
                ),
            'delete_success_alert' => 'Deleted Successfully',
            'edit_btn' => 'Edit',
            'msg_all_delete' => 'Do you need to delete selected recored ?',
            'msg_delete' => 'Do you need to delete the recored ?',
            'no_delete' => 'No',
            'ops_alert' => 'ops!! , something wrong',
            'update_success_alert' => 'Updated Successfully',
            'yes_delete' => 'Yes',
        ),
    'home' =>
        array(
            'home' => 'Home',
            'title' => 'Dashboard',
            'welcome' => 'Welcome',
        ),
    'languages' =>
        array(
            'create' =>
                array(
                    'language' => 'Language Code',
                    'name' => 'Name',
                    'status' => 'Status',
                    'title' => 'Create Languages',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'language' => 'Language Code',
                    'name' => 'Name',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Language',
                ),
            'title' => 'Languages',
            'validation' =>
                array(
                    'language' =>
                        array(
                            'required' => 'Language code is required',
                        ),
                    'name' =>
                        array(
                            'required' => 'Name is required',
                        ),
                ),
        ),
    'nav' =>
        array(
            'logout' => 'Logout',
            'profile' => 'Profile',
        ),
    'option_values' =>
        array(
            'create' =>
                array(
                    'general' => 'General',
                    'info' => 'Option Values Information',
                    'name' => 'Value',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Create Option Values',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Value',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Value',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Option Values',
                ),
            'title' => 'Option Values',
            'validation' =>
                array(
                    'title' =>
                        array(
                            'required' => 'Value field is required',
                        ),
                ),
        ),
    'options' =>
        array(
            'create' =>
                array(
                    'categories' => 'Categories',
                    'general' => 'General',
                    'info' => 'Option Information',
                    'is_filterable' => 'Filterable',
                    'name' => 'Title',
                    'option_sets' => 'Option Sets',
                    'order' => 'Sorting Values',
                    'other' => 'Others',
                    'sort-btn' => 'Sorting',
                    'status' => 'Status',
                    'title' => 'Create Options',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Attribute Title',
                    'option_set' => 'Option Sets',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Option',
                ),
            'title' => 'Options',
            'validation' =>
                array(
                    'option_set_id' =>
                        array(
                            'required' => 'Please select attribute sets for this attribute',
                        ),
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'orderStatuses' =>
        array(
            'create' =>
                array(
                    'code' => 'Status code',
                    'title' => 'Order status',
                ),
            'datatable' =>
                array(
                    'code' => 'Status code',
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Order status',
                ),
            'edit' =>
                array(
                    'title' => 'Order status',
                ),
            'title' => 'Order statuses',
            'validation' =>
                array(
                    'code' =>
                        array(
                            'required' => 'Status code is required',
                        ),
                    'title' =>
                        array(
                            'required' => 'Order status is required',
                        ),
                ),
        ),
    'pages' =>
        array(
            'create' =>
                array(
                    'description' => 'Description',
                    'general' => 'General',
                    'info' => 'Page Information',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Create Pages',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Page Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Page',
                ),
            'title' => 'Pages',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                ),
        ),
    'permissions' =>
        array(
            'create' =>
                array(
                    'description' => 'Description',
                    'general' => 'General',
                    'info' => 'Permission Information',
                    'key' => 'Key',
                    'name' => 'Name',
                    'title' => 'Create Permission',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Key Name',
                    'options' => 'Options',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Permission',
                ),
            'title' => 'Permissions',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                    'display_name' =>
                        array(
                            'required' => 'Please fill the key input',
                            'unique' => 'This key taken before',
                        ),
                    'name' =>
                        array(
                            'required' => 'Please fill the name input',
                            'unique' => 'This name taken before',
                        ),
                ),
        ),
    'products' =>
        array(
            'create' =>
                array(
                    'attribute_values' => 'Values',
                    'attributes' => 'Attributes',
                    'categories' => 'Categories',
                    'description' => 'Description',
                    'gallery_images' => 'Gallery Images',
                    'general' => 'General',
                    'images' => 'Images',
                    'info' => 'Product Information',
                    'inventory_price' => 'inventory & price',
                    'main_images' => 'Main Images',
                    'name' => 'Title',
                    'new_product' => 'New Product',
                    'new_product_from' => 'New Product From',
                    'new_product_to' => 'New Product To',
                    'options' => 'Options',
                    'price' => 'Product Price',
                    'qty' => 'Qty',
                    'sku' => 'SKU',
                    'special_price' => 'Special Price',
                    'special_price_from' => 'Special Price From',
                    'special_price_to' => 'Special Price To',
                    'status' => 'Status',
                    'title' => 'Create Pages',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Product Title',
                    'options' => 'Options',
                    'price' => 'Price',
                    'sku' => 'SKU',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Product',
                ),
            'title' => 'Products',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'Please select at least one category',
                        ),
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'Please select one image only for this cover product',
                            'required' => 'Please upload the cover image of product',
                        ),
                    'price' =>
                        array(
                            'required' => 'price field is required',
                        ),
                    'qty' =>
                        array(
                            'required' => 'Please fill the quantity of the product',
                        ),
                    'sku' =>
                        array(
                            'required' => 'SKU field is required',
                        ),
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'questions' =>
        array(
            'create' =>
                array(
                    'answer' => 'Answer',
                    'assessment' => 'Assessment',
                    'question' => 'Question',
                    'status' => 'Status',
                    'title' => 'Add Question',
                    'value' => 'Value',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'options' => 'Options',
                    'question' => 'Question',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Questions',
                ),
            'title' => 'Questions',
            'validation' =>
                array(
                    'answer' =>
                        array(
                            'required' => 'Answer is required',
                        ),
                    'question' =>
                        array(
                            'required' => 'Question is required',
                        ),
                ),
        ),
    'reservations' =>
        array(
            'create' =>
                array(
                    'info' => 'بيانات عامة',
                    'general' => 'بيانات عامة',
                    'title' => 'Create Reservation',
                    'change_apponitment' => 'Change apponitment',
                    'date' => 'Reservation date',
                    'doctor' => 'Consuler',
                    'end_time' => 'End time',
                    'is_paid' => 'Payment status',
                    'order_status_id' => 'Status',
                    'price' => 'Price',
                    'start_time' => 'Start time',
                    'username' => 'Username',
                    'reason' => 'Reason',
                    'service'   => 'Service',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created at',
                    'date' => 'Reservation date',
                    'service' => 'Service',
                    'date_range' => 'Date Range',
                    'doctor' => 'Doctor',
                    'end_time' => 'End time',
                    'options' => 'Options',
                    'price' => 'Price',
                    'service_name' => 'Service',
                    'services' => 'Service',
                    'start_time' => 'Start time',
                    'status' => 'Status',
                    'username' => 'Username',
                    'user_id' => 'User ID',
                    'user_email' => 'User E-mail',
                    'user_mobile' => 'User Mobile',
                    'doctor_email' => 'Doctor E-mail',
                    'doctor_id' => 'Doctor ID',
                    'order_status' => 'Reservation Status',
                    'payment_type' => 'Payment Type',
                    'cash_visa' => 'Cash / Visa / Master Card',
                ),
            'edit' =>
                array(
                    'title' => 'Edit reservation',
                ),
            'title' => 'Reservations',
            'validation' =>
                array(
                    'availability_id' =>
                        array(
                            'required' => 'Start time is required',
                        ),
                    'order_status_id' =>
                        array(
                            'required' => 'Please select status',
                        ),
                    'required_at' =>
                        array(
                            'required' => 'Reservation date is required',
                        ),
                ),
        ),
    'roles' =>
        array(
            'create' =>
                array(
                    'description' => 'Description',
                    'general' => 'General data',
                    'info' => 'Role Information',
                    'key' => 'Key',
                    'name' => 'Name',
                    'permissions' => 'Permissions',
                    'title' => 'Create Role',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'name' => 'Key Name',
                    'options' => 'Options',
                    'permissions' => 'Permissions',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Role',
                ),
            'title' => 'Roles',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                    'display_name' =>
                        array(
                            'required' => 'Please fill the key input',
                            'unique' => 'This key taken before',
                        ),
                    'name' =>
                        array(
                            'required' => 'Please fill the name input',
                            'unique' => 'This name taken before',
                        ),
                ),
        ),
    'services' =>
        array(
            'create' =>
                array(
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Add Services',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'name' => 'Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Services',
                ),
            'title' => 'Services',
            'validation' =>
                array(
                    'description' =>
                        array(
                            'required' => 'Description is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must choose only one image',
                            'required' => 'Image is required',
                        ),
                    'name' =>
                        array(
                            'required' => 'Title is required',
                        ),
                ),
        ),
    'settings' =>
        array(
            'Language_label' => 'Languages',
            'countries_label' => 'Countries',
            'currencies_label' => 'Currencies',
            'default_country' => 'Default Country',
            'default_currency' => 'Default Currency',
            'default_language' => 'Default Language',
            'default_shipping' => 'Default Country Shipping',
            'general' => 'General',
            'general_data' => 'General Data',
            'info' => 'Setting Information',
            'logo' => 'Logo',
            'mail' => 'E-mail Config.',
            'mail_driver' => 'Mail Driver',
            'mail_encryption' => 'Mail Encryption',
            'mail_host' => 'Mail Host',
            'mail_password' => 'Password',
            'mail_port' => 'Mail Port',
            'mail_username' => 'Username',
            'mail_cc' => 'CC E-mail',
            'other' => 'Other',
            'privacy_policy' => 'Privacy Policy',
            'save_buttons' => 'Save Changes',
            'shipping' => 'Shipping Config.',
            'shipping_label' => 'Shipping',
            'social_media' => 'Social Media',
            'supported_countries' => 'Supported Countries',
            'supported_currencies' => 'Supported Currencies',
            'supported_language' => 'Supported Language',
            'title' => 'Settings',
            'title_label' => 'Title',
        ),
    'sliders' =>
        array(
            'create' =>
                array(
                    'category_level' => 'Category Level',
                    'description' => 'Description',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'Category Information',
                    'main_tree' => 'Main Category',
                    'name' => 'Title',
                    'status' => 'Status',
                    'title' => 'Create Categories',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'description' => 'Description',
                    'image' => 'Image',
                    'name' => 'Category Title',
                    'options' => 'Options',
                    'status' => 'Status',
                    'title' => 'Title',
                ),
            'edit' =>
                array(
                    'title' => 'Edit Category',
                ),
            'title' => 'Categories',
            'validation' =>
                array(
                    'category_id' =>
                        array(
                            'required' => 'You must select category level for this category',
                        ),
                    'description' =>
                        array(
                            'required' => 'Description field is required',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must chose only one image',
                        ),
                    'title' =>
                        array(
                            'required' => 'Title field is required',
                        ),
                ),
        ),
    'users' =>
        array(
            'create' =>
                array(
                    'avatar' => 'Avatar',
                    'confirm_password' => 'Confirm Password',
                    'email' => 'E-mail',
                    'general' => 'General',
                    'image' => 'Image',
                    'info' => 'User Information',
                    'mobile' => 'Mobile',
                    'name' => 'Username',
                    'password' => 'Password',
                    'roles' => 'Roles',
                    'status' => 'Status',
                    'title' => 'Create User',
                ),
            'datatable' =>
                array(
                    'created_at' => 'Created At',
                    'date_range' => 'Date Range',
                    'email' => 'E-mail',
                    'image' => 'Image',
                    'mobile' => 'Mobile',
                    'name' => 'username',
                    'options' => 'Options',
                    'status' => 'Status',
                ),
            'edit' =>
                array(
                    'title' => 'Edit User',
                ),
            'title' => 'Users',
            'validation' =>
                array(
                    'email' =>
                        array(
                            'required' => 'E-mail is required',
                            'unique' => 'This email is taken before',
                            'email' => 'The email must be a valid email address',
                        ),
                    'image' =>
                        array(
                            'max' => 'You must chose only one image',
                        ),
                    'mobile' =>
                        array(
                            'numeric' => 'Please put english numbers only in mobile field',
                            'required' => 'Mobile is required',
                        ),
                    'name' =>
                        array(
                            'required' => 'Please fill the name input',
                        ),
                    'password' =>
                        array(
                            'confirmed' => 'Password not matching the confirmation',
                            'min' => 'Password must be more than 6 characters',
                            'required' => 'Password is required',
                        ),
                ),
        ),
    'notifications' => [
        'title' => 'General Notifications',
        'create' => [
            'title' => 'Add New General Notifications',
            'name' => 'Send Notifications',
            'msg_title' => 'Message Title',
            'msg_title_placeholder' => 'Example: view new products',
            'msg_body' => 'Message Content',
        ],
    ],
);
