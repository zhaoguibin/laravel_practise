<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//软删除
use Illuminate\Database\Eloquent\SoftDeletes;

class Emails extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];
}
