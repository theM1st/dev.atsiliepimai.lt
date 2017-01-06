<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use App\Scopes\ActiveScope;
use Auth;

class ProfileController extends Controller
{
    public function show($section)
    {
        $user = Auth::user();

        $viewData = [
            'title' => trans('common.profile.sections.'.$section),
            'section' => $section,
        ];

        if ($section == 'reviews') {
            $viewData['reviews'] = $user->reviews()->latest()->withoutGlobalScope(ActiveScope::class)->get();
        }

        return $this->display('profile.show', $viewData);
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