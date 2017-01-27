<?php

namespace App\Http\Controllers;

use App\Review;
use App\Http\Requests\SendMessageRequest;
use Illuminate\Http\Request;
use App\Mail\sendMessage;
use Illuminate\Support\Facades\Mail;
use App\Category;
use App\Page;

class PagesController extends Controller
{
    public function index()
    {
        $popularCategories = Category::popular()->get();

        $lastReviews = Review::latest()->limit(4)->get();
        
        return $this->display('pages.index', [
            'title' => '',
            'popularCategories' => $popularCategories,
            'lastReviews' => $lastReviews,
        ]);
    }

    public function show(Page $page)
    {
        $this->breadcrumbs->addCrumb($page->title, route('page.show', $page->slug));

        return $this->display('pages.show', [
            'page' => $page,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function sendMessage(SendMessageRequest $request)
    {
        Mail::to(config('mail.from.address'))->send(new sendMessage($request->all()));

        alert(trans('common.form.page.sendMessage.success'), 'success');

        return back();
    }
}
