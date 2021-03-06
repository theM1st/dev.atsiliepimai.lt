<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $breadcrumbs; 

    public function __construct()
    {
        $this->breadcrumbs = new \Creitive\Breadcrumbs\Breadcrumbs;
        $this->breadcrumbs->setDivider(null);
        $this->breadcrumbs->addCrumb('Pradinis', '/');
    }

    public function display($path, $data = array())
    {
        $data['user'] = \Auth::user();
        //$data['title'] = trim(strip_tags(adminHeaderTitle()) . ' - ' . trans('admin.control_management_system'), '- ');

        return view($path, $data);
    }
}
