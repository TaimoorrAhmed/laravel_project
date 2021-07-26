<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    { 
        print_r($request);die;
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $request->name = request('name');
        $request->email = request('email');
        $request->password = bcrypt(request('password'));

        $request->save();

        return back();
    }

    public function userUpdate( Request $request)
    {

        print_r($request);die;

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
            'profile_picture_path' => $profile_image_url,
        ];
        // return dd($userUpdate);
        DB::table('users')->where('id',$request->idUpdate)->update($userUpdate);
        return redirect()->back()->with('userUpdate','.');
    }

   
}
?>