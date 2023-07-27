<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class UserController extends Controller
{
    public function viewUser(string $id)
    {
        $user = User::query()
            ->select('*')
            ->where('user_id', '=', $id)
            ->get()
            ->first();
        $orders = Order::query()
            ->select('*')
            ->where('user_id', '=', $id)
            ->orderBy('date_placed', 'DESC')
            ->get();

        return view('admin_show_user', compact('user', 'orders'));
    }

    public function uploadPhotoProfile(Request $request, string $id)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHiu') . $file->getClientOriginalName();
            $file->move(public_path('img/user_profiles'), $filename);

            $user = User::where('user_id', '=', $id)
                ->update([
                    'image' => $filename
                ]);

            return redirect('/profile')->with('success', 'Profile picture successfully updated!');
        }
    }

    public function adminRegister(Request $request)
    {
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $password =  $request->input('password');
        $user->password = Hash::make($password);
        $user->role = "admin";
       
        $user->save();

        return redirect('/admin')->with('success', 'New admin account created!');
    }

    public function showAdminRegister()
    {
        return view('register_admin');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required|min:11|max:11'
        ]);
        $user = new User;
        $user->first_name = $request->input("first_name");
        $user->last_name = $request->input("last_name");
        $user->email = $request->input("email");
        $user->address = $request->input("address");
        $user->mobile_number = $request->input("mobile_number");
        $user->company = $request->input("company");
        $password =  $request->input('password');
        $user->password = Hash::make($password);
        $user->role = "user";
        $user->save();

       
        return redirect("/admin/register")->with('success', 'Account Created!');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function showProfile()
    {
        if (Session::has('user_id')) {
           
            $u = User::query()
                ->select('*')
                ->where("user_id", "=", Session::get("user_id"))
                ->get()
                ->first();
            return view('profile', compact('u'));
        } else {
            abort(401);
        }
    }

    public function logout()
    {
        if (Session::has('user_id')) {
            Session::flush();
        }

        return redirect('login')->with('success', 'You have been logged out!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where("email", "=", $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('user_id', $user->user_id);
                $request->session()->put('first_name', $user->first_name);
                $request->session()->put('last_name', $user->last_name);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $user->role);
             
                if (Session::get('role') == 'admin') {
                    return redirect('/admin')->with('success', 'Logged in as admin!');
                }
                return redirect('/profile')->with('success', 'Welcome, ' . Session::get('first_name') . '!');
            } else {
                return redirect('/login')->with('fail', 'Incorrect password');
            }
        } else {
            return redirect('/login')->with('fail', 'An account with that email does not exist!');
        }
    }
}
