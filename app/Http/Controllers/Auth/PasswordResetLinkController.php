<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon; 
use App\Models\User;
use Auth,Hash;

class PasswordResetLinkController extends Controller
{
    public function getEmail()
  {
    if(Auth::check()){
        return redirect()->route('user.dashboard');
     }
    return view('customauth.passwords.email');
  }
    public function postEmail(Request $request)
      {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
    
        $token = Str::random(64);
    
          DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
    
          Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password Notification');
          });
    
          return back()->with('status', 'We have e-mailed your password reset link!');
      }
      
      public function getPassword($token) { 

     return view('customauth.passwords.reset', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {

  $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

  ]);

  $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

  if(!$updatePassword)
      return back()->withInput()->with('error', 'Invalid token!');

    $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return redirect('/login')->with('message', 'Your password has been changed!');

  }
}
