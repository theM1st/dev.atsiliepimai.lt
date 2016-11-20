<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function edit($section)
    {
        $user = Auth::user();

        \Former::populate($user);

        return $this->display('profile.edit', [
            'title' => trans('common.profile.sections.'.$section),
            'user' => $user,
            'section' => $section,
            'sections' => User::getProfileSections(),
        ]);
    }

    public function update(User $user)
    {
        dd($user);
//dd(Auth::user(), $this->user);

    }
}