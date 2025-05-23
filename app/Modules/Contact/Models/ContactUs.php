<?php

namespace App\Modules\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
	protected $fillable = ['name' , 'email', 'message'];

}
