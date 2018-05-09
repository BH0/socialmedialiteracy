<?php 

namespace App\Http\Controllers;
use DB; 
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller {
    public function getResults(Request $request) { 
        $query = $request->input('query'); 
        if (!$query) { 
            dd($query); // redirect 
        } 

        $users = User::where(DB::raw("email", "LIKE", "%{$query}%"))->orWhere("email", "LIKE",  "%{$query}%")->get(); 

        return view('search.results')->with('users', $users); 
    }
}

 