<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Category;

class CategoriesController extends AdminController
{
    /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all()->toHierarchy();

        return $this->display($this->viewPath(), [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return $this->display($this->viewPath('create'), [
            'categories' => Category::getNestedList('name', null, '- ')
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::find($request->get('parent_id'));

        $request->merge(['active' => $request->get('active', 0)]);

        if ($model = $this->createAlert(Category::class, $request->all())) {
            if ($category) {
                $model->makeChildOf($category);
            }
        }

        return $this->redirectRoutePath();
    }

    public function edit(Category $category)
    {
        \Former::populate($category);

        return $this->display($this->viewPath('edit'), [
            'category' => $category,
            'categories' => Category::getNestedList('name', null, '- ')
        ]);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $parent = Category::find($request->get('parent_id'));

        $request->merge(['active' => $request->get('active', 0)]);

        $this->saveAlert($category, $request->all());

        if (!$parent && !$category->isRoot()) {
            $category->makeRoot();
        } elseif ($parent) {
            $category->makeChildOf($parent);
        }

        return $this->redirectRoutePath();
    }

    public function move(Category $category, $position)
    {
        $siblings = $category->getSiblingsAndSelf();

        if (!isset($siblings[$position])) {
            abort(404);
        }

        if ($category->lft > $siblings[$position]->lft) {
            return $category->moveToLeftOf($siblings[$position]);
        } else {
            return $category->moveToRightOf($siblings[$position]);
        }
    }

    public function delete(Category $category)
    {
        return [
            'html' => view('admin.categories.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'category' => $category,
            ])->render()
        ];
    }

    public function destroy(Category $category)
    {
        return $this->destroyAlertRedirect($category);
    }
}