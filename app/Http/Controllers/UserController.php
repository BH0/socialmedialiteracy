<?php 

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
	public function postSignup(Request $request) { 
	
		$this->validate($request, [
			'email' => 'required|email|unique:users', 
			'password' => 'required|min:8|max:32'
		]); 
	
		$email = $request['email'];
		$password = bcrypt($request['password']);
		
        $user = new User();
		
        $user->email = $email;
        $user->password = $password;
        $user->save();	 
		
		Auth::login($user); 

		return redirect()->route('dashboard'); 
	}

	public function postSignin(Request $request) { 

		if (Auth::attempt(['email' => $request['email'], 'password' => $request['password' ]])) { 
			return redirect()->route('dashboard'); 
		} 
		return redirect()->back(); 
	} 

	public function getAccount() { 
		return view('account', ['user' => Auth::user()]); 
	}

	public function postUpdateAccount(Request $request) { 
		$this->validate($request, [
			'email' => 'required|max:30' 
		]); 

		$user = Auth::user(); 
		$user->email = $request['email']; 
		$user->update(); 
		$file = $request->file('image'); 
		$filename = $request['email'] . '-' . $user->id . '.jpg';	// may support other file extensions 
		if ($file) { 
			Storage::disk('local')->put($filename, File::get($file)); 
		} 
		return redirect()->route('account'); 
   }

	public function getSignout() { 
		Auth::logout(); 
		return redirect()->route('home');
	} 

	public function getUserImage($filename) { 
		$file = Storage::disk('local')->get($filename);
        return new Response($file, 200);	
	} 
}

 