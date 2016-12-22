<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\AttributeOption;

class AttributeOptionsController extends AdminController
{
    public function delete(AttributeOption $option)
    {
        return [
            'html' => view('admin.attribute_options.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'option' => $option,
            ])->render()
        ];
    }

    public function destroy(AttributeOption $option)
    {
        return $this->destroyAlertRedirect($option, 'back');
    }
}
