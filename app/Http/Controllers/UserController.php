<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Appeal;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $questions = Question::whereHas('questionOrAnswer', function ($query) use ($id) {
            $query->whereHas('publication', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        })->get();
        $answers = Answer::whereHas('questionOrAnswer', function ($query) use ($id) {
            $query->whereHas('publication', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        })->get();
        return view('pages.user', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }

    public function editProfileForm($id) {

        $user = User::find($id);
        return view('pages.editProfileForm', ['user' => $user]);
    }

    public function editProfile(Request $request, $id) {

        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:250',
            'password' => 'required|min:8|confirmed',
            'description' => 'required|max:255',
        ]);
        
        $user = User::find($id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($validatedData['password']);
        $user->description = $request->description;
        $user->save();

        return redirect('/user/'.$user->id);
    }

    public function showAppeal(){
        $this->authorize('showAppeal', User::class);
        return view('pages.appeal');
    }

    public function createAppeal(Request $request){

        $request->validate([
            'description' => 'required|max:255',
        ]);

        $user = User::findOrFail(auth()->user()->id);

        $appeal = Appeal::create([
            'user_id' => $user->id,
            'description' => $request->description,
        ]);

        if($appeal) {
            return redirect('/appeal?error=0');
        }
        else{ 
            return redirect('/appeal?error=1');
        }
    }

    public function showForgetPassword(){
        return view('pages.forgetPassword');
    }

    public function createForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return back()->withErrors(['email' => 'This email address is not registered.']);
        }

        $token = Str::random(64);
        DB::insert('INSERT INTO password_reset_tokens (email, token, created_at) VALUES (?, ?, ?)', [
            $request->email,
            $token,
            now(), 
        ]);

        Mail::send('emails.email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPassword($token){
        return view('pages.newPassword', ['token' => $token]);
    }

    public function createResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);
        
        $updated_password = DB::select('SELECT * FROM password_reset_tokens WHERE email = ? AND token = ? LIMIT 1', [
            $request->email,
            $request->token,
        ]);

        if(!$updated_password) {
            return redirect('/login?error=1')->withErrors(['email' => 'The email address or token is invalid.']);
        }

        $hashedPassword = Hash::make($request->password);

        DB::update('UPDATE users SET password = ? WHERE email = ?', [
            $hashedPassword,
            $request->email,
        ]);

        DB::delete('DELETE FROM password_reset_tokens WHERE email = ?', [
            $request->email,
        ]);

        return redirect('/login?error=0')->with('message', 'Your password has been reset!');
    }
}
