<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName(){
        return $this->name;
    }
    #Many to Many, my friends
    public function friendsOfMine(){
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    #Many to Many, my friend
    public function friendOf(){
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    #get friends
    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }


    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestRcieved(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update(['accepted'=>true]);
    }

    public function isFriendWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function statuses(){
        return $this->hasMany('App\Models\Status', 'user_id');
    }
}
