<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model implements Authenticatable
{
    protected $table = 'EMPLOYEES';
    use \Illuminate\Auth\Authenticatable;
}
