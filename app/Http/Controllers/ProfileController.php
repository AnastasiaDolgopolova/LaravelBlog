<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'mood' => 'required',
            'avatar' => 'nullable|image'
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
