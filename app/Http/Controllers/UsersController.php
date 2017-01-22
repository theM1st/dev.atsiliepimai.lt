<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use App\Scopes\ActiveScope;
use Auth;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return $this->display('users.show', [
            'thisUser' => $user,
            'reviews' => $user->reviews()->latest()->withoutGlobalScope(ActiveScope::class)->get(),
            'questions' => $user->questions()->latest()->withoutGlobalScope(ActiveScope::class)->get(),
            'answers' => $user->answers()->latest()->withoutGlobalScope(ActiveScope::class)->get(),
        ]);
    }
}