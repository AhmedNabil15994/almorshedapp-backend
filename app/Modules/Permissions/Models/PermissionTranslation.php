<?php

namespace App\Modules\Permissions\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
		protected $fillable = ['description','permission_id'];
}
