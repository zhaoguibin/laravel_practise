<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//软删除
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;

    /**
     * 软删除
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getEmail($user_id){
        $users = DB::table('emails')
            ->leftJoin('users', 'users.id', '=', 'emails.user_id')
            ->select('users.*', 'emails.content', 'emails.title')
            ->where("users.id",'=',"$user_id")
            ->get();
        return $users->toArray();
    }
}
