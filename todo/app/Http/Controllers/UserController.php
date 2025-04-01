<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::Select('id', 'name', 'email')
                ->OrderBy('name')
                ->with('tasks')
                ->paginate(5);

               // return $users;
        
        return view('user.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|max:20',
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->save();

        return redirect(route('user.index'))->withSuccess('User created successfully!');
    }

    public function forgot(){
        return view('user/forgot');
    }

    public function email(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users'
        ]);
        $user = User::where('email', $request->email)->first();
        $userId = $user->id;
        $tempPassword = str::random(45);
        $user->temp_password = $tempPassword;
        $user->save();
        
        // $user->update([
        //     'temp_password' => $tempPassword
        // ]);

        $body="<a href='".route('user.reset', [$userId, $tempPassword])."'>Click here to reset your password</a>";

        $to_name = $user->name;
        $to_email = $request->email;

        Mail::send('user.mail', ['name'=> $to_name, 'body' =>$body ], 
        function($message) use ($to_email){
            $message->to($to_email)->subject('Reset Password');
        });
        return redirect(route('login'))->withSuccess('Please check your email to reset the password!');
    }

    public function reset(User $user, $token){
        if($user->temp_password === $token){
            return view('user.reset');
        }
        return redirect(route('user.forgot'))->withErrors(trans('auth.failed'));
    }

    public function resetUpdate(User $user, $token, Request $request){
        if($user->temp_password === $token){
            $request->validate([
                'password' => 'required|min:6|max:20|confirmed'
            ]);

            $user->password = $request->password;
            $user->temp_password = NULL;
            $user->save();
            return redirect(route('login'))->withSuccess('Password chnaged with success!');
        }
        return redirect(route('user.forgot'))->withErrors(trans('auth.failed'));
    }


}
