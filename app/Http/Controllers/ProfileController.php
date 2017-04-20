<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use App\Review;
use App\Scopes\ActiveScope;
use Auth;

class ProfileController extends Controller
{
    public function show($section)
    {
        $user = Auth::user();

        $title = trans('common.profile.sections.'.$section);

        $viewData = [
            'title' => $title,
            'section' => $section,
        ];

        if ($section == 'reviews') {
            $viewData['reviews'] = $user->reviews()->latest()->withoutGlobalScope(ActiveScope::class)->get();
        }

        if ($section == 'questions') {
            $viewData['questions'] = $user->questions()->latest()->withoutGlobalScope(ActiveScope::class)->get();
        }

        if ($section == 'answers') {
            $viewData['answers'] = $user->answers()->latest()->withoutGlobalScope(ActiveScope::class)->get();
        }

        $this->breadcrumbs->addCrumb($title);

        $viewData['breadcrumbs'] = $this->breadcrumbs;

        return $this->display('profile.show', $viewData);
    }

    public function edit($section)
    {
        $user = Auth::user();

        $title = trans('common.profile.sections.'.$section);

        \Former::populate($user);

        $this->breadcrumbs->addCrumb($title);

        $viewData['breadcrumbs'] = $this->breadcrumbs;

        return $this->display('profile.edit', [
            'title' => $title,
            'section' => $section,
            'breadcrumbs' => $this->breadcrumbs,
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

    public function editReview(Review $review)
    {
        $title = trans('common.profile.sections.reviews');

        $this->breadcrumbs->addCrumb($title);

        \Former::populate($review);

        return $this->display('profile.editReview', [
            'title' => $title,
            'section' => 'reviews',
            'breadcrumbs' => $this->breadcrumbs,
            'review' => $review,
            'listing' => $review->listing,
        ]);
    }
}