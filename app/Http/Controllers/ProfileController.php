<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hash;

class ProfileController extends Controller
{
  public function index($slug){
    $userData = DB::table('users')
              ->leftJoin('profiles', 'profiles.user_id','users.id')
              ->where('slug', $slug)
              ->get();
    return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);
  }

  public function uploadPhoto(Request $request){
    //display values which are stored
    // dd($request->all());

    //echo file path which is uploaded , (file can be stored anywhere, it will take the path from there, not necessary to be in public folder)
    $file = $request->file('pic');

    // echo name of the file which is uploaded
    $filename = $file->getClientOriginalName();

    //move the file to public folder
    $path = 'public/img';
    $file->move($path, $filename);

    //get user id
    $user_id = Auth::user()->id;

    //update in database pic column
    DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);

    // return view('profile.index');
    return back();

  }

  // change password for logged in users
  public function uploadPassword(Request $request){
      // if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
      //     // The passwords matches
      //     return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
      // }
      // if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
      //     //Current password and new password are same
      //     return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
      // }

      // $validateFields = array('current-password' => 'required','new-password' => 'required|string|min:6|confirmed');

      $validateFields = array('new-password' => 'required|string');

      $this->validate($request, $validateFields);
      //Change Password
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();
      return redirect()->back()->with("success","Password changed successfully !");
  }

  public function editProfileForm(){
    $data = DB::table('users')
          ->leftJoin('profiles', 'profiles.user_id','users.id')
          ->where('users.id', Auth::user()->id)
          ->get();
      return view('profile.editProfile')->with('data', $data);
  }

  public function updateProfile(Request $request){
    // to get and print all values of table
    // dd($request->all());

    $user_id = Auth::user()->id;

    // query to update all fields of the form in database except token
    DB::table('profiles')->where('user_id',$user_id)->update($request->except('_token'));

    return back();
  }
}
