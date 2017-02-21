<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends AdminBaseController
{
    public function getIndex(){
        $title = 'Users';
        $users = User::get();
        $auth_user = Auth::user();
        return view('admin.users.show-users', compact(['title', 'users','auth_user']));
    }

    public function postIndex( Request $request ){

        $user_check = $request->get('user_check');
        if( $user_check ) {
            User::destroy( $user_check );
        }

        return redirect()->back()->with('success','Saved');
    }

    public function getEdit( $id ) {
        $title = "User edit";
        $post = User::find( $id );
        return view('admin.users.edit-user', compact(['title', 'post']));
    }

    public function postEdit( UpdateUserRequest $request, $id ){
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if( $request->get('password') !== '' ) {
            $user->password = Hash::make( $request->get('password') );
        }

        $user->save();

        return redirect()->back()->with('success','Changes saved');
    }

    public function getAdd() {
        $post = new User;
        $title = "User add";
        return view('admin.users.edit-user', compact(['title', 'post']));
    }


    public function postAdd( CreateUserRequest $request ){
        $user = User::create([
            'name'   		=> $request->get('name'),
            'email'   		=> $request->get('email'),
            'password' 		=> Hash::make($request->get('password'))
        ]);
        return redirect('/master/users')->with('success', 'User Added');
    }

}
