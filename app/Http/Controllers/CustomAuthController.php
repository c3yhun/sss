<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect("dashboard")->withSuccess('You have signed-in');
        }

        return view('auth.login');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        /*if(Auth::check()){
            return redirect("dashboard")->withSuccess('You have signed-in');
        }*/

        return view('auth.registration');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function profileEdit($id)
    {
        $profile = User::findOrFail($id);
        return view('backend.profile-edit',compact('profile'));
    }

    public function profileEditPost($id, Request $request)
    {
        $profile = User::findOrFail($id);

        if($request->hasFile('aphoto')){
            $request->validate([
                'aphoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $aphotoName = Str::random(8).'.'.$request->aphoto->extension();
            $request->aphoto->move(public_path('backend/app-assets/images/portrait/small'), $aphotoName);
            $profile->avatar = $aphotoName;
        }

        if($request->npassword == $request->nrpassword && !empty($request->npassword) && !empty($request->nrpassword))
        {
            $profile->password = Hash::make($request->nrpassword);
        }

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->user_role = $request->user_role;
        $profile->save();

        $notification = array(
            'message' => '👋 Profil Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dashboard')->with($notification);
    }


    public function userCreatePost(Request $request)
    {
        $user = new User();

        if($request->hasFile('aphoto')){
            $request->validate([
                'aphoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $aphotoName = Str::random(8).'.'.$request->aphoto->extension();
            $request->aphoto->move(public_path('backend/app-assets/images/portrait/small'), $aphotoName);
            $user->avatar = $aphotoName;
        }

        if($request->npassword == $request->nrpassword && !empty($request->npassword) && !empty($request->nrpassword))
        {
            $user->password = Hash::make($request->nrpassword);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_role = $request->user_role;
        $user->save();

        $notification = array(
            'message' => '👋 Kullanıcı Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.index')->with($notification);
    }


    public function users(){
        $user = User::get();
        return view('backend.users', compact('user'));
    }

    public function userCreate()
    {
        return view('backend.user-create');
    }

    public function userDestroy($id)
    {
        User::find($id)->delete();

        $notification = array(
            'message' => '👋 Kullanıcı Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.index')->with($notification);
    }




}
