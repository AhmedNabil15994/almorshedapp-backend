<?php

return array(
    'general' =>
        array(
            'error_happended' => 'Something went wrong, please try again',
        ),
    'contact' =>
        array(
            'msg_sent_success' => 'Message sent successfully',
        ),
    'ads' =>
        array(
            'ad_not_found' => 'Ad not found',
        ),
    'articles' =>
        array(
            'article_not_found' => 'Article not found',
        ),
    'assessments' =>
        array(
            'assessment_not_found' => 'Assessment not found',
            'assessment_result' => 'Assessment result',
            'send' => 'Send',
            'validation' =>
                array(
                    'assessment_id' =>
                        array(
                            'required' => 'Assessment is required',
                        ),
                    'questions' =>
                        array(
                            'id' =>
                                array(
                                    'required' => 'Please choose the question',
                                    'exists' => 'This question does not exist',
                                ),
                            'answer_id' =>
                                array(
                                    'required' => 'Please choose the answer',
                                    'exists' => 'This answer does not exist',
                                ),
                            'value' =>
                                array(
                                    'required' => 'Answer value is required',
                                )
                        )
                )
        ),
    'auth' =>
        array(
            'failed' => 'Wrong email or password',
            'unautenticated' => 'Unautenticated',
            'logout_success' => 'Logout Successfully',
            'reset_password' => 'Password reset successfully',
            'wrong_password' => 'Wrong Password',
            array(
                'validation' =>
                    array(
                        'email' =>
                            array(
                                'required' => 'Please enter e-mail address',
                                'unique' => 'This email is taken',
                                'email' => 'The email must be a valid email address',
                            ),
                        'avatar' =>
                            array(
                                'image' => 'File should be image',
                                'mimes' => 'Image extension sholud be one of :values',
                                'max' => 'Image size sholud not be bigger than :max',
                            ),
                        'mobile' =>
                            array(
                                'digits_between' => 'Phone must be more than 6 & less than 11 numbers',
                                'numeric' => 'Please make sure phone is numbers only',
                                'required' => 'Please enter your mobile phone',
                            ),
                        'name' =>
                            array(
                                'required' => 'Please enter username',
                            ),
                        'password' =>
                            array(
                                'confirmed' => 'Confirmation password not match with the password',
                                'min' => 'Password can\'t be less than 6 characters',
                                'required' => 'Please enter your password',
                            ),
                        'new_password' =>
                            array(
                                'confirmed' => 'Confirmation password not match with the password',
                                'min' => 'Password can\'t be less than 6 characters',
                                'max' => 'Password can\'t be greater than 16 character',
                                'required' => 'Please enter your new password',
                                'different' => 'New password matches current password',
                            ),
                    ),
            ),
        ),
    'users' =>
        array(
            'user_not_found' => 'User not found',
            'user_deleted_before' => 'Account has already been deleted',
            'user_deleted_successfully' => 'Account has been deleted successfully',
        ),
    'categories' =>
        array(
            'category_not_found' => 'Category not found',
        ),
    'doctors' =>
        array(
            'doctor_not_found' => 'Consuler not found',
        ),
    'pages' =>
        array(
            'page_not_found' => 'Page not found',
        ),
    'ratings' =>
        array(
            'add_rating_success' => 'Your rating send successfully',
            'validation' =>
                array(
                    'doctor_id' =>
                        array(
                            'required' => 'Consuler is required',
                        ),
                    'rating' =>
                        array(
                            'required' => 'Rating is required',
                            'integer' => 'Rating should be an integer number',
                        ),
                ),
        ),
    'reservations' =>
        array(
            'choose_another_date' => 'Please choose a nother date',
            'choose_another_date_befor_2_h' => 'Please choose a nother date ,Choose the time :hour hours before the appointment',
            'time_not_available' => 'The selected date is not available',
            'missed_reservation' => 'You have missed your reservation',
            'missed_reservation_not_paid' => 'You have missed your reservation without paying',
            'reservation_not_found' => 'Reservation not found',
            'already_reserved' => 'Already reserved',
            'status' =>
                array(
                    'upcoming' => 'Upcoming',
                    'last' => 'Last',
                    'current' => 'Current',
                ),
            'validation' =>
                array(
                    'doctor_id' =>
                        array(
                            'required' => 'Consuler is required',
                        ),
                    'service_id' =>
                        array(
                            'required' => 'Service is required',
                        ),
                    'notes' =>
                        array(
                            'required' => 'Notes is required',
                        ),
                    'date' =>
                        array(
                            'required' => 'Reservation date is required',
                            'date_format' => 'Reservation date format sholud be like Y-m-d',
                            'after_or_equal' => 'Reservation date sholud be equal or greater than today',
                        ),
                ),
        ),
    'availability-exceptions' =>
        array(
            'availability_exception_not_found' => 'Exception date not found',
            'validation' =>
                array(
                    'off_date' =>
                        array(
                            'required' => 'Unavailable date is required',
                            'date_format' => 'Off date format sholud be like Y-m-d',
                            'after_or_equal' => 'Off date sholud be equal or greater than today',
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
);
