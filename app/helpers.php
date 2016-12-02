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
        $actions = Form::tools([
            'edit' => route('categories.edit', $node->id),
            'delete' => route('categories.delete', $node->id)
        ]);

        $element = '<div class="category-name">' .
            '<span class="sort-handle ui-sortable-handle"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></span>' .
            '<span class="text">' . $node->name . '</span>' . $actions .
            '</div>';

        if( $node->isLeaf() ) {
            return '<li'.(!$node->active ? ' class="inactive"': '').' data-id="' . $node->id . '">' . $element . '</li>';
        } else {
            $html = '<li'.(!$node->active ? ' class="inactive"': '').' data-id="' . $node->id . '">' . $element;

            $html .= '<ul class="sortable">';

            foreach($node->children as $child)
                $html .= adminRenderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }
}

if (!function_exists('categoriesHierarchyOptions')) {
    function categoriesHierarchyOptions($node, $value=null)
    {
        if ($node->isLeaf()) {
            $ancestors = $node->getAncestors();
            $ancestors->shift();
            $text = $ancestors->implode('name', ' > ');

            $selected = ($node->id == $value ? ' selected="selected"' : '');

            return '<option value="'.$node->id.'" data-subtext="'.$text.'"'.$selected.'>' . $node->name . '</option>';
        } else {
            if ($node->getLevel() == 0) {
                $html = '<optgroup label="'.$node->name.'">';
            } else {
                $html = '';
            }

            foreach($node->children as $child) {
                $html .= categoriesHierarchyOptions($child, $value);
            }

            if ($node->getLevel() == 0) {
                $html .= '</optgroup>';
            }
        }

        return $html;
    }
}
