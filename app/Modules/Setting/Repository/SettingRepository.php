<?php

namespace	App\Modules\Setting\Repository;

use App\Modules\Support\Libraries\EnvTrait;
use Setting;

class SettingRepository
{
    use EnvTrait;

    public function set($request)
    {
        $this->saveSettings($request->except('_token', '_method'));

				return true;
    }

    public function saveSettings($request)
    {
        foreach ($request as $key => $value) {

            if ($key == 'translate')
                static::setTranslatableSettings($value);

            if ($key == 'images')
                  static::setImagesPath($value);

            if ($key == 'env')
                self::setEnv($value);

            Setting::set($key, $value);
        }
    }

    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            Setting::lang(locale())->set($key, $value);
        }
    }

    public static function setImagesPath($settings = [])
    {
        foreach ($settings as $key => $value) {
            Setting::set($key, get_path($value));
        }
    }
}
