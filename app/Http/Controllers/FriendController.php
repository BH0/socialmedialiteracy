<?php 

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller { 
    
    public function getIndex() { 
		$user = Auth::user(); 
        $friends = Auth::user()->friends(); 
        $requests = Auth::user()->friendRequests(); 
        return view('friends.index')->with('friends', $friends)
        ->with('requests', $requests)->with('user', $user);  
        /* 
        $friends = Auth::user()->friends(); 
        $requests = Auth::user()->friendRequests(); 
        return view('friends.index)
        ->with('friends', $friends)
        ->with('requests', $requests); 
        */ 
    } 

    public function getAdd($username) { // $usrrname = email 
        $user = User::where('username', $username)->first(); 
        if (!$user) { 
            return redirect()->route('dashboard');  // these aren't identical to the video 
        } 

        if (Auth::user()->id === $user->id) { 
            return redirect()->route('dashboard');  // these aren't identical to the video 
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) { 
            return redirect()->route('dashboard'); 
        } 

        if (Auth::user()->isFriendsWith($user)) { 
            return redirect()->route('dashboard'); 
        } 

        Auth::user()->addFriend($user); 
        return redirect()->route('dashboard'); 
    } 

    public function getAccept($username) { 
        $user = User::where('username', $username)->first(); 

        if (!$user) { 
            return redirect()->route('dashboard');  // these aren't identical to the video 
        } 
        
        if (!Auth::user()->hasFriendRequestReceived($user)) { 
            return redirect()->route('dashboard');  // these aren't identical to the video 
        } 

        Auth::user()->acceptFriendRequest($user); 

        return redirect()->route('dashboard');  // these aren't identical to the video 
    }
} 
