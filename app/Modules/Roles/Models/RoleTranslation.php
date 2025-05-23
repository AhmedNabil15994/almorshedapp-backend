<?php

namespace App\Modules\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
	protected $fillable = ['display_name','description'];
}
