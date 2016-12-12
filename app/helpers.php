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
     * @param string $title
     *
     * @return string
     */
    function adminHeaderTitle($title=null)
    {
        $title = $title ? $title : trans('admin.'.Route::getCurrentRoute()->getName());

        $return = '<div class="admin-header"><h2>';
        $return .= $title;
        $return .= '</h2></div>';

        return $return;
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
            ($node->active ? '<i class="fa fa-circle text-green"></i> ': '<i class="fa fa-circle text-red"></i> ') .
            '<span class="text">' . $node->name . '</span>' .
            '<small class="label label-default"><i class="fa fa-commenting"></i> ' . $node->reviews()->count() . '</small>' .
            $actions .
            '</div>';

        if( $node->isLeaf() ) {
            return '<li data-id="' . $node->id . '">' . $element . '</li>';
        } else {
            $html = '<li data-id="' . $node->id . '">' . $element;

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

if (!function_exists('starRating')) {
    function starRating($rate=0, $size='sm') {
        $html = '<span class="empty-stars">';

        for ($i = 0; $i < 5; ++$i) {
            $html .= '<span class="star"><i class="fa fa-star"></i></span>';
        }

        $html .= '</span>';

        if ($rate) {
            $width = ceil(20 * $rate);
            $html .= '<span class="filled-stars" style="width: '.$width.'%">';

            for ($i = 0; $i < 5; ++$i) {
                $html .= '<span class="star"><i class="fa fa-star"></i></span>';
            }

            $html .= '</span>';
        }

        return '<div class="rating-container theme-krajee-fa rating-'.$size.'">'.
            '<div class="rating">'.$html.'</div>'.
            '</div>';
    }
}

if (!function_exists('transPlural')) {
    function transPlural($text, $count=1)
    {
        if ($count%10 == 1 && $count%100 != 11) {
            $plural = 0;
        } else {
            $plural = ($count%10 >= 2 && ($count%100 < 10 || $count%100 >= 20) ? 1 : 2);
        }

        return trans_choice($text, $plural);
    }
}