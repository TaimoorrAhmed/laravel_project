@extends('layouts.app')
<?php

use \App\Http\Controllers\HomeController; ?>
@section('content')
<script>
function editUser() {
    var divId = document.getElementById('userDetail').style.visibility  = 'visible'
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" > 
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(auth()->user()->is_admin == 0)
                    <h1>Total User: {{ $userCount }}</h1>
                    @endif
                    


                    <br />
                    <table class="table table-hover">

                    
                    @if(auth()->user()->is_admin == 0)
                        <thead>

                            <th>Avatar</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Address</th>

                            <th>Phone Number</th>

                            <th>Created At</th>

                            <th>User Type</th>


                        </thead>
                        @elseif(auth()->user()->is_admin == 1)
                        <thead>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Address</th>

                            <th>Phone Number</th>

                            <th>Created At</th>

                            <th>User Type</th>


                        </thead>
                        @endif

                        @if(auth()->user()->is_admin == 0)
                        <tbody>
                            @foreach($userDetails as $user)

                            <tr>

                                @if($user->profile_picture_path == "")
                                <td> <img src="" alt="No preview Available" width="46" height="34"></td>
                                @elseif($user->profile_picture_path)
                                <td> <img src="{{$user->profile_picture_path}}" alt="Avatar" width="46" height="34"></td>
                                @endif
                                <td>{{$user->name}} </td>

                                <td>{{$user->email}} </td>

                                @if($user->address == "")

                                <td> N/A </td>

                                @elseif($user->address)

                                <td>{{$user->address}} </td>

                                @endif


                                @if($user->phone_number == "")

                                <td> N/A </td>

                                @elseif($user->phone_number)

                                <td>{{$user->phone_number}} </td>

                                @endif


                                <td>{{$user->created_at}} </td>

                                @if($user->is_admin == 0)

                                <td> Admin </td>

                                @elseif($user->is_admin == 1)

                                <td>Client </td>

                                @endif

                                @if($user->id == auth()->user()->id)

                                <td><button onclick="editUser()">Edit</button></td>

                                @endif


                            </tr>
                            @endforeach

                        </tbody>
                        @elseif(auth()->user()->is_admin == 1)
                        <tbody >

                        <tr><img src="{{auth()->user()->profile_picture_path}}" alt="Avatar" width="50%"></tr>
                           

                            <tr>
                                

                                <td>{{auth()->user()->name}} </td>

                                <td>{{auth()->user()->email}} </td>

                                @if(auth()->user()->address == "")

                                <td> N/A </td>

                                @elseif(auth()->user()->address)

                                <td>{{auth()->user()->address}} </td>

                                @endif


                                @if(auth()->user()->phone_number == "")

                                <td> N/A </td>

                                @elseif(auth()->user()->phone_number)

                                <td>{{auth()->user()->phone_number}} </td>

                                @endif


                                <td>{{auth()->user()->created_at}} </td>

                                @if(auth()->user()->is_admin == 0)

                                <td> Admin </td>

                                @elseif(auth()->user()->is_admin == 1)

                                <td>Client </td>

                                @endif

                                

                                <td><button onclick="editUser()">Edit</button></td>

                                


                            </tr>
                           

                        </tbody>
                        @endif
                        

                    </table>
                </div>
            </div>
            <div id="userDetail" style="visibility: hidden;"><h3>Edit Profile</h3>
                <form method="POST" action="/home" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   
                    

                            <td>Update Profile Picture</td><br>
                            <td><input type="file" class="form-control" name="profile_picture_path" id="profile_picture_path"></td><br>
                    
                            <td>Name</td><br>
                            <td><input type="text" name="name"  value="{{ auth()->user()->name }}" />,</td><br>

                            <td>Email</td><br>
                            <td><input type="email" name="email"  value="{{ auth()->user()->email }}" /></td><br>

                            <td>Address</td><br>
                            <td><input type="address" name="address"  value="{{ auth()->user()->address }}" /></td><br>

                            <td>Phone Number</td><br>
                            <td><input type="phone_number" name="phone_number"  value="{{ auth()->user()->phone_number }}" /></td><br>
                            
                            <td>New Password</td><br>
                            <td><input type="password" name="password" /></td><br>

                            <td>Confirm Password</td><br>
                            <td><input type="password" name="password_confirmation" /></td><br>

                            <td><button type="submit">Update</button></td><br>
                    
                </form>
            </div>
        </div>
    </div>
</div>



@endsection