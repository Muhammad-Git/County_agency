<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Goal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  private $logo;
    //  private $logo_2;
    //  private $logo_3;
    //  private $phone_number;
    //  private $phone_number_2;
    //  private $email;
    //  private $email_2;
    //  private $address;
    //  private $address_2;
    //  private $timing;
    //  private $timing_2;
    //  private $footer_about;
    //  private $color_1;
    //  private $color_2;
    //  private $color_3;

     

    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
     
     public function goal(){
        $user = User::where('role' , 1)->get();
         return view('goal')->with('users',$user);
     }
     
     public function goal_store(Request $request){
         //Goal::truncate();
         
        $users = User::get();
        foreach($users as $user){
            if($user->status == 1){
                Goal::where('user_id', $user->id)->delete();
            }
        }
        foreach($users as $user){
            Goal::create([
            'user_id'=> $user->id,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
            'goal'=> $request->goal_number,
            'subscription'=> $request->subscription,
        ]);
        }
       return redirect('/goal');
    }
    
    
    
    public function update_goal(Request $request){
        $goal = Goal::where('user_id', $request->user_id)->first();
        if($goal){
            $goal->goal = $request->goal;
            $goal->save();
        }
        else{
            Goal::create([
                'user_id'=> $request->user_id,
                'start_date'=> today(),
                'end_date'=> today(),
                'goal'=> $request->goal,
            ]);
        }
       return redirect('/goal');
    }
    
    
    public function update_status($id){
        $user = User::find($id);
        if($user){
            if($user->status == 1){
                $user->status = 0;
            } else{
                $user->status = 1;
            }
            $user->save();
        }
    }

    
}