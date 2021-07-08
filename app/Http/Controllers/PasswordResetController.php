<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    private function sendResetEmail($email, $token)
    {
//Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->first();
//Generate, the password reset link. The token generated is embedded in the link
        $link = \request()->root() . '/password/reset/' . $token . '?email=' . urlencode($user->email);


        try {
            $data = array('user' => $user, "link" => $link);
            Mail::send('password_reset.mail', $data, function ($message) use ($user) {
                $message->to($user->email, 'RMD')->subject
                ('Reset your password');
                $message->from('rmd@gmail.com', 'RMD');
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function validatePasswordRequest($email)
    {
        $user = DB::table('users')->where('email', '=', $email)
            ->first();
        if (!$user) {
            return "User not found";
        }
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => str_random(60),
            'created_at' => now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $email)->first();
        if ($this->sendResetEmail($email, $tokenData->token)) {
            return 'A reset link has been sent to your email address.';
        } else {
            return 'A Network Error occurred. Please try again.';
        }
    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'token' => 'required']);

        $password = $request->password;
// Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
// Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
// Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
//Hash and update the new password
        $user->password = Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return redirect("/login");
    }
}
