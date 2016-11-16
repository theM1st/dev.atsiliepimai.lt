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
        return $this->createAlertRedirect(User::class, $request->all());
    }

    public function edit(User $user, $section='about')
    {
        $sections = ['about', 'photo', 'address', 'email', 'password'];
        
        if (!in_array($section, $sections)) {
            abort(404);
        }

        \Former::populate($user);
        
        return $this->display($this->viewPath('edit'), [
            'user' => $user,
            'sections' => $sections,
            'section' => $section,
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        if ($request->get('user_role') === '' && User::whereUserRole('admin')->count() == 1) {
            return $this->redirectRoutePath('edit', 'admin.users.admin.update.fail', [$user->id]);
        }

        $data = $request->all();

        if ($request->hasFile('picture')) {
            $data['picture'] = $user->upload($request->file('picture'));
        }

        $user->setBirthday($request);

        return $this->saveAlertRedirect($user, $data, 'edit', [$user->id]);
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
