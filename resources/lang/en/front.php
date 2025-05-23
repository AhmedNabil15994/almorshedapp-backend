<?php

return array (
  'home' => 
  array (
    'title' => 'El morshed',
  ),
  'auth' => 
  array (
    'email_placeholder' => 'E-mail address',
    'login_msg' => 'Welcome , you can login from here',
    'name_placeholder' => 'Username',
    'password_confirm_placeholder' => 'Confirm Password',
    'password_placeholder' => 'Password',
    'phone_placeholder' => 'Phone',
    'register_msg' => 'Welcome , you can register from here',
    'remember_me' => 'Remember Me',
    'submit_login' => 'Login',
    'submit_register' => 'Register',
    'title' => 'Login or Register',
    'sign_in_to_admin' => 'Sign In To Admin',
    'validation' => 
    array (
      'email' => 
      array (
        'required' => 'Please enter e-mail address',
        'unique' => 'This email is taken',
      ),
      'mobile' => 
      array (
        'digits_between' => 'Phone must be more than 6 & less than 11 numbers',
        'numeric' => 'Please make sure phone is numbers only',
        'required' => 'Please enter your mobile phone',
      ),
      'name' => 
      array (
        'required' => 'Please enter username',
      ),
      'password' => 
      array (
        'confirmed' => 'Confirmation password not match with the password',
        'min' => 'Password can\'t be less than 6 characters',
        'required' => 'Please enter your password',
      ),
    ),
  ),
);
