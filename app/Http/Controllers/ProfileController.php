<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function show($section)
    {
        return $this->display('profile.show', [
            'title' => trans('common.profile.sections.'.$section),
            'section' => $section,
        ]);
    }

    public function edit($section)
    {
        $user = Auth::user();

        \Former::populate($user);

        return $this->display('profile.edit', [
            'title' => trans('common.profile.sections.'.$section),
            'section' => $section,
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $data['picture'] = $user->upload($request->file('picture'));
        }

        $user->setBirthday($request);

        if ($request->get('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }

        $user->fill($data);

        ($saved = $user->save()) ?
            alert(trans('common.profile.update.success'), 'success'):
            alert(trans('common.profile.update.fail'), 'danger');

        return back();
    }
}