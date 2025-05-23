<?php

if (! function_exists('is_rtl')) {
    /**
     * The Current dir
     *
     * @param string $locale
     */
    function is_rtl()
    {
        return LaravelLocalization::getCurrentLocaleDirection();
    }
}

if (! function_exists('check_dir')) {
    /**
     * The Check dir by lang
     *
     * @param string $locale
     */
    function check_dir($lang)
    {
      switch ($lang) {
          case 'ar':
          return 'rtl';
          default:
          return 'ltr';
      }
    }
}


if (! function_exists('locale')) {
    /**
     * The Current locale
     *
     * @param string $locale
     */
    function locale()
    {
        return app()->getLocale();
    }
}


if (! function_exists('int_to_array')) {
    /**
     * convert a comma separated string of numbers to an array
     *
     * @param string $integers
     */
    function int_to_array($integers)
    {
        return array_map("intval", explode(",", $integers));
    }
}

if (! function_exists('get_path')) {
    /**
     * The Current dir
     *
     * @param string $locale
     */
    function get_path($path)
    {
        $url = $path;
        $parts = explode("/",$url);
        array_shift($parts);
        array_shift($parts);
        array_shift($parts);
        $newurl = implode("/",$parts);

        return $newurl;
    }
}

if (! function_exists('slugfy')) {
    /**
     * The Current dir
     *
     * @param string $locale
     */
     function slugfy($string, $separator = '-')
     {
         $url = trim($string);
         $url = strtolower($url);
         $url = preg_replace('|[^a-z-A-Z\p{Arabic}0-9 _]|iu', '', $url);
         $url = preg_replace('/\s+/', ' ', $url);
         $url = str_replace(' ', $separator, $url);

         return $url;
     }
}

if (! function_exists('formatTime')) {
    function formatTime($time)
    {
        $time = $time % 12 ? $time % 12 : 12;

        return $time > 12 ? 'PM' : 'AM';
    }
}

if (!function_exists('htmlView')) {
    /**
     * Access the OrderStatus helper.
     */
     function htmlView($content)
     {
         return
         '<!DOCTYPE html>
           <html lang="en">
             <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link href="css/bootstrap.min.css" rel="stylesheet">
               <!--[if lt IE 9]>
                 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
               <![endif]-->
             </head>
             <body>
               '.$content.'
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
               <script src="js/bootstrap.min.js"></script>
             </body>
           </html>';
     }
}
