<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        return view('home',['userCount' => User::count(), 'userDetails'=>User::all()]);
    }

    public static function editUser()
    {
        echo "EDIT HERE";
    }

    public function getUserById(Request $request){
        $id =$request->input('id');
        $user =  User::find($id);
        return $user;
    }
    
    public function update(Request $request)
    { 
        
        
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
           // 'password' => 'required|min:6|confirmed'
        ]);

        $request = request();

        $profileImage = $request->file('profile_picture_path');
        $profileImageSaveAsName = time() . "-profile." . $profileImage->getClientOriginalExtension();

        $upload_path = 'profile_images/';
        $profile_image_url = $upload_path . $profileImageSaveAsName;
        $success = $profileImage->move($upload_path, $profileImageSaveAsName);
       
       $userUpdate = [
        'name'          =>  $request->name,
        'email'         =>  $request->email,
        'address'    =>  $request->address,
        'phone_number'      =>  $request->phone_number,
        
    ];
     if($profile_image_url != "")
        {
            $userUpdate['profile_picture_path'] = $profile_image_url;
        };
       // print_r($userUpdate);die;
    DB::table('users')->where('id',auth()->user()->id)->update($userUpdate);
    return redirect()->back()->with('userUpdate','.');

        return back();
    }

    
    
}
