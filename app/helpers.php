<?php

if (!function_exists('flash')) {
    /**
     * Set a flash message in the session.
     *
     * @param  string $message
     * @param  string $type
     * @return void
     */
    function alert($message, $type = 'info')
    {
        session()->flash('alert.message', $message);
        session()->flash('alert.type', $type);
    }
}

if (!function_exists('getTitle')) {
    /**
     * Render nodes for nested sets
     *
     * @param        $object
     * @param string $property
     *
     * @return string
     */
    function getTitle($object = null, $property = "title")
    {
        if (is_object($object) && isset($object->$property)) {
            return $object->$property;
        } elseif (is_string($object) && !empty($object)) {
            return $object;
        }
    }
}

if (!function_exists('adminHeaderTitle')) {
    /**
     * Return the header title for each page
     *
     * @return string
     */
    function adminHeaderTitle()
    {
        $title = '<div class="admin-header"><h2>';
        $title .= trans('admin.'.Route::getCurrentRoute()->getName());
        $title .= '</h2></div>';

        return $title;
    }
}

if (!function_exists('adminRenderNode2')) {
    function adminRenderNode2($node)
    {
        if ($node->isLeaf()) {
            return '<li>' . $node->name . '</li>';
        } else {
            $html = '<li>' . $node->name;

            $html .= '<ul>';

            foreach ($node->children as $child) {
                $html .= adminRenderNode($child);
            }

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }
}

if (!function_exists('adminRenderNode')) {
    function adminRenderNode($node)
    {
        $actions = Form::actions([
            'edit' => route('categories.edit', $node->id),
            'delete' => route('categories.delete', $node->id)
        ]);

        if( $node->isLeaf() ) {
            return '<li class="clearfix category-name" data-id="' . $node->id . '">' .
                '<span class="sort-handle ui-sortable-handle"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></span>' .
                $node->name . $actions .
                '</li>';
        } else {
            $html = '<li class="clearfix category-name" data-id="' . $node->id . '">' .
                '<span class="sort-handle ui-sortable-handle"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></span>' .
                $node->name . $actions;

            $html .= '<ul class="sortable">';

            foreach($node->children as $child)
                $html .= adminRenderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }
}