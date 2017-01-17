<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageRequest;
use App\Page;

class PagesController extends AdminController
{
    /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        $pages = Page::getPages();

        return $this->display($this->viewPath(), [
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return $this->display($this->viewPath('create'));
    }

    public function store(PageRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->createAlertRedirect(Page::class, $request);
    }

    public function edit(Page $page)
    {
        \Former::populate($page);

        return $this->display($this->viewPath('edit'), [
            'page' => $page,
        ]);
    }

    public function update(Page $page, PageRequest $request)
    {
        $request->merge(['active' => $request->get('active', 0)]);

        return $this->saveAlertRedirect($page, $request);
    }

    public function move(Page $page, $position)
    {
        $page->setPosition($position);

        return $page;
    }

    public function delete(Page $page)
    {
        return [
            'html' => view('admin.pages.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'page' => $page,
            ])->render()
        ];
    }

    public function destroy(Page $page)
    {
        return $this->destroyAlertRedirect($page);
    }
}