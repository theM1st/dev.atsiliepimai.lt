<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Censor;

class CensorsController extends AdminController
{
    public function index()
    {
        $censors = Censor::all();

        return $this->display($this->viewPath(), [
            'censors' => $censors
        ]);
    }

    public function delete(Censor $censor)
    {
        return [
            'html' => view('admin.censors.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'censor' => $censor,
            ])->render()
        ];
    }

    public function destroy(Censor $censor)
    {
        return $this->destroyAlertRedirect($censor);
    }
}
