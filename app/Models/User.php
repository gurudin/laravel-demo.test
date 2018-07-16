<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user item.
     *
     * @return array
     */
    public function getUser()
    {
        $result = [];
        $this->select(['id', 'name', 'email'])
            ->orderBy('id', 'desc')
            ->chunk(100, function ($items) use (&$result) {
                foreach ($items as $item) {
                    $result[] = $item->toArray();
                }
            });
        
        return $result;
    }
}
