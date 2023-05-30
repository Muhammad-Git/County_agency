<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Mail;

class CustomAuthController extends Controller
{
    public function register(){
    return view('register');
   }
   public function login(){
     return view('login');
   }

   public function register_submision(Request $request){
    // dd($request->password);

     $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:8'
    ]);

dd($request->id);
     $admin = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'role' => 1,
            'user_id' => $request->id,
            'password' => bcrypt($request->password)
    ]);
    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];
    

    Auth::attempt($credentials);

    return redirect('/');
   }


   public function login_submision(Request $request){
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        
    //    $user = User::where(['email'=>$request->email,'password'=>$request->password]);

// dd($user);
       $credentials = [
        'email' => $request->email,
        'password' => $request->password,
        ];

    
            if(Auth::attempt($credentials)){
                $user = Auth::user();
                
                return redirect('/');
                // $user_role = $user->role;
        
                // if($user_role == 1){
                //     return redirect('/admin');
                // }else{
                //     return redirect('/');
                // }
            } else{
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }
       
       


   }

   public function logout(){
    Auth::logout();
     return redirect('/login');
   }
   
   
    public function showForgetPasswordForm()
      {
         return view('forgetpassword');
      }
      
     public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
    
          $token = Str::random(64);
    
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
    
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
    
          return back()->with('message', 'We have e-mailed your password reset link!');
    
      }
      
      public function showResetPasswordForm($token) { 
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }
      
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->with('message', 'Your password has been changed!');
      }
}