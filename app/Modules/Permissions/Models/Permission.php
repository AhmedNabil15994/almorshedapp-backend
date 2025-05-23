<?php

namespace App\Modules\Permissions\Models;

use Zizaco\Entrust\EntrustPermission;
use Dimsav\Translatable\Translatable;

class Permission extends EntrustPermission
{
	use Translatable;

	protected $fillable 					= ['display_name','name'];
	public $translationModel 			= 'App\Modules\Permissions\Models\PermissionTranslation';
	public $translatedAttributes 	= ['description'];

}
