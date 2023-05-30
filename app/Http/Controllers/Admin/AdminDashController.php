<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\WebsiteCustomization;
use App\Models\VideoArtist;
use App\Models\VideoCategory;
use App\Rules\ValidSlug;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Goal;
use Session;
use bcrypt;



class AdminDashController extends Controller
{
  public function home(){
    //   dd(auth()->user()->id);
    $user = User::where('user_id', auth()->user()->id)->get();
    return view('home')->with('users',  $user);
  }
 

  public function adduser(Request $request){
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:6',
    ]);
    $user = User::create([
        
            'name' => $request->first_name,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => auth()->user()->role +1,
            'password' => bcrypt($request->password),     
            'user_id' => auth()->user()->id,
    ]);
    
    if(auth()->user()->role == 1){
        $goal = Goal::where('user_id',auth()->user()->id)->first();
        Goal::where('user_id', auth()->user()->id)->update(['achived'=> $goal->achived+1]);
    }
    
    Session::flash('message', "User added successfully!");

    // $users = User::where('user_id', auth()->user()->id)->get();
    // return redirect()->back()->with('users', $users);
    return redirect('/');
   }
   
   
   public function update_user(Request $request){
        $update_user = User::where('id', $request->id)->update(['first_name' => $request->first_name, 'last_name'=> $request->last_name]);
       return redirect('/');
    }
   
   public function user_destroy($id){
        User::find($id)->delete();
       return redirect('/');
    }

   


   


}