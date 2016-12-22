<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\User;

class UsersController extends AdminController
{
    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return $this->display($this->viewPath(), [
            'users' => $users,
        ]);
    }

    public function create(User $user)
    {
        \Former::populate($user);

        return $this->display($this->viewPath('create'));
    }

    public function store(UserRequest $request)
    {
        return $this->createAlertRedirect(User::class, $request);
    }

    public function edit(User $user, $section='About')
    {
        \Former::populate($user);

        return $this->display($this->viewPath('edit'), [
            'user' => $user,
            'sections' => User::getProfileSections(),
            'section' => $section,
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        if ($request->get('user_role') === '' && User::whereUserRole('admin')->count() == 1) {
            return $this->redirectRoutePath('edit', 'admin.users.admin.update.fail', [$user->id]);
        }

        $user->setBirthday($request);

        if ($request->get('password')) {
            $request->merge(['password' => $request->get('password')]);
        }

        return $this->saveAlertRedirect($user, $request, 'back');
    }

    public function delete(User $user)
    {
        return [
            'html' => view('admin.users.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'user' => $user,
            ])->render()
        ];
    }

    public function destroy(User $user)
    {
        $admins = User::whereUserRole('admin')->count();

        if ($admins == 1 && $user->admin) {
            return $this->redirectRoutePath('index', 'admin.users.admin.destroy.fail');
        } else {
            return $this->destroyAlertRedirect($user);
        }
    }
}
