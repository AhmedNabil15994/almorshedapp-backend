<?php

namespace App\Modules\Support\Libraries;

trait EnvTrait
{
    public static function setEnv($request)
    {
        $envPath = app()->environmentFilePath();

        foreach ($request as $key => $value) {

	        file_put_contents($envPath, str_replace(
	            $key . '=' . '"'.env($key).'"',
	            $key . '="' . $value.'"',
	            file_get_contents($envPath)
	        ));
				}

				return true;
    }

}
