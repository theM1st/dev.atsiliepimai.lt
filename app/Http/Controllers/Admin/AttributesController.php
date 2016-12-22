<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeRequest;
use App\Attribute;
use App\AttributeOption;

class AttributesController extends AdminController
{
    public function index()
    {
        $attributes = Attribute::all();

        return $this->display($this->viewPath(), [
            'attributes' => $attributes
        ]);
    }

    public function create()
    {
        return $this->display($this->viewPath('create'), []);
    }

    public function store(AttributeRequest $request)
    {
        return $this->createAlertRedirect(Attribute::class, $request);
    }

    public function edit(Attribute $attribute)
    {
        \Former::populate($attribute);

        return $this->display($this->viewPath('edit'), [
            'attribute' => $attribute,
        ]);
    }

    public function update(Attribute $attribute, AttributeRequest $request)
    {
        $optionNames = $request->get('option_name');
        $optionIds = $request->get('option_id');

        foreach ($optionNames as $k => $name) {
            if ($name = trim($name)) {
                if (isset($optionIds[$k])) {
                    $option = AttributeOption::find($optionIds[$k]);
                    $option->update([ 'option_name' => $name ]);
                } else {
                    $option = new AttributeOption([ 'option_name' => $name ]);
                    $attribute->options()->save($option);
                }
            }
        }

        return $this->saveAlertRedirect($attribute, $request, 'back');
    }

    public function delete(Attribute $attribute)
    {
        return [
            'html' => view('admin.attributes.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'attribute' => $attribute,
            ])->render()
        ];
    }

    public function destroy(Attribute $attribute)
    {
        return $this->destroyAlertRedirect($attribute);
    }
}
