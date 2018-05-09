<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    // might have to put arrays here 

    public function posts()
    { 
        return $this->hasMany('App\Post');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    } 

    public function getName() { // note: I only use an email and not a username/firstname 
        if ($this->email) { 
            return "{$this->email}"; 
        }
    } 

    public function getFirstNameOrUsername() { // getNameOrEmail / getEmail  
        return $this->getName() ? : $this->email; 
    } 

    public function friendsOfMine() { 
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id'); // App\Models\User > App\User 
    } 

    public function friendOf() { 
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id'); 
    }

    public function friends() { 
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get()); 
    }

    public function friendRequests() { 
        return $this->friendsOfMine()->wherePivot('accepted', false)->get(); 
    } 

    public function friendRequestsPending() { 
        return $this->friendOf()->wherePivot('accepted', false)->get(); 
    } 

    public function hasFriendRequestPending(User $user) { 
        return $this->friendRequestsPending()->where('id', $user->id)->count(); 
    } 

    public function hasFriendRequestReceived(User $user) { 
        return (bool) $this->friendRequests()->where('id', $user->id)->count(); 
    } 

    public function addFriend(User $user) { 
        $this->friendOf()->attatch($user->id); 
    } 

    public function acceptFriendRequest(User $user) {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
          'accepted' => true 
        ]); 
    } 

    public function isFriendsWith(User $user) { 
        return (bool) $this->friends()->where('id', $user->id)->count(); 
    } 
} 

/* 

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable; 

	public function posts() { 
		return $this->hasMany('App\Post'); 
	}
	public function likes() { 
		return $this->boolean('App\Like'); 
	} 
}

*/  
