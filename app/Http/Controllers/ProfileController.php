<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        // if (auth()->user()->id == 1) {
        //     return back()->withErrors(['not_allow_profile' => __('You are not allowed to change data for a default user.')]);
        // }

        $user = auth()->user();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->save();

        // auth()->user()->update($request->all());

        return back()->withStatus(__('Profil mis à jour avec succès.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        // if (auth()->user()->id == 1) {
        //     return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        // }

        if(Hash::check($request->old_password, auth()->user()->mdp)){
            if($request->password == $request->password_confirmation){
                $user = auth()->user();
                $user->mdp = Hash::make($request->password);
                $user->save();
                return back()->withPasswordStatus(__('Le mot de passe a été mis à jour avec succès.'));
            }else
                return back()->withPasswordStatus(__('Les mots de passe ne correspondent pas.'));
        }else{
            return back()->withPasswordStatus(__('Le mot de passe est incorrect.'));
        }

        // auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        // return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
