<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model implements Authenticatable
{
	use \Illuminate\Auth\Authenticatable;
}
