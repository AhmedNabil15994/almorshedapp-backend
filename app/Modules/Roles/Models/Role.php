<?php

namespace App\Modules\Roles\Models;

use Zizaco\Entrust\EntrustRole;
use Dimsav\Translatable\Translatable;

class Role extends EntrustRole
{
	use Translatable;

	protected $fillable 					= ['name'];
	public $translationModel 			= 'App\Modules\Roles\Models\RoleTranslation';
	public $translatedAttributes 	= ['display_name','description'];

}
