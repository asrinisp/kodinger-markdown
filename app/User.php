<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Facades\Services\PostService;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar', 'provider', 'provider_id',
        'bio',
        'link',
        'location',
        'hireable',
        'github',
        'company',
        'status'

    ];

    protected $appends = ['is_me', 'the_avatar', 'the_avatar_sm'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasDraftPost()
    {
        return PostService::hasDraftedPosts();
    }

    public function draftedPostsCount()
    {
        return PostService::draftedPostsCount();
    }

    public function draftedPosts()
    {
        return PostService::draftedPosts();
    }

    public function getNameAttribute($value)
    {
        return e($value);
    }

    public function getIsMeAttribute()
    {
        return auth()->check() && auth()->id() == $this->id;
    }

    public function savePosts()
    {
        return $this->hasMany('App\Save', 'user_id')->whereMethod('save')->whereModel('Post');
    }

    public function lovePosts()
    {
        return $this->hasMany('App\Save', 'user_id')->whereMethod('love')->whereModel('Post');
    }

    public function getFirstNameAttribute()
    {
        if(strpos($this->name, ' ') > -1)
        {
            return (explode(' ', $this->name))[0];
        }
        
        return $this->name;
    }

    public function getTheAvatarAttribute()
    {
        return avatar($this->avatar, 460, $this->name);
    }

    public function getTheAvatarSmAttribute()
    {
        return avatar($this->avatar, 80, $this->name);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
