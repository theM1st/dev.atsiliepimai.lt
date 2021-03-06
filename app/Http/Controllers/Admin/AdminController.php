<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AdminController extends Controller
{
    /**
     * Model name
     *
     * @var string
     */
    protected $model = null;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function display($path, $data = array())
    {
        if (!isset($data['title'])) {
            $data['title'] = trim(strip_tags(adminHeaderTitle()) . ' - ' . trans('admin.control_management_system'), '- ');
        }

        return view($path, $data);
    }

    /**
     * Returns view path for the admin
     *
     * @param string $path
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function viewPath($path = "index")
    {
        return 'admin.' . str_plural(snake_case($this->model))  . '.' . $path;
    }

    /**
     * Create, flash success or error then redirect
     *
     * @param $class
     * @param Request $request
     * @param string $path
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAlertRedirect($class, Request $request, $path = "index")
    {
        $this->createAlert($class, $request);

        return $this->redirectRoutePath($path);
    }

    /**
     * Save, flash success or error then redirect
     *
     * @param $model
     * @param Request $request
     * @param string $path
     * @param array $args
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveAlertRedirect($model, Request $request, $path = "index", $args = [])
    {
        $this->saveAlert($model, $request);

        return $this->redirectRoutePath($path, null, $args);
    }

    /**
     * Delete and flash success or fail then redirect to path
     *
     * @param $model
     * @param string $path
     * @param bool $permanently
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyAlertRedirect($model, $path = "index", $permanently=false)
    {
        if ($permanently) {
            $model->forceDelete() ?
                alert(trans('admin.delete.success'), 'success') :
                alert(trans('admin.delete.fail'), 'danger');
        } else {
            $model->delete() ?
                alert(trans('admin.delete.success'), 'success') :
                alert(trans('admin.delete.fail'), 'danger');
        }

        return $this->redirectRoutePath($path);
    }

    public function createAlert($class, $data)
    {
        $model = $class::create($data->all());

        if ($model) {
            if ($data->hasFile('picture')) {
                $model->picture = $model->upload($data->file('picture'));
                $model->save();
            }

            alert(trans('admin.create.success'), 'success');
        } else {
            alert(trans('admin.create.fail'), 'danger');
        }

        return $model;
    }

    public function saveAlert($model, $data)
    {
        $fill = $data->all();
        if ($data->hasFile('picture')) {
            $fill['picture'] = $model->upload($data->file('picture'));
        }

        $model->fill($fill);
        ($saved = $model->save()) ?
            alert(trans('admin.update.success'), 'success'):
            alert(trans('admin.update.fail'), 'danger');

        return $saved;
    }

    /**
     * Returns redirect url path, if error is passed, show it
     *
     * @param string $path
     * @param null $error
     * @param array $args
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectRoutePath($path = "index", $error = null, $args = [])
    {
        if ($error) {
            alert(trans($error), 'danger');
        }

        if ($path == 'back') {
            return back();
        }

        return redirect($this->urlRoutePath($path, $args));
    }

    /**
     * Returns full url
     *
     * @param string $path
     * @param array $args
     * @return string
     */
    protected function urlRoutePath($path = "index", $args = [])
    {
        if ($args) {
            return route($this->routePath($path), $args);
        } else {
            return route($this->routePath($path));
        }
    }

    /**
     * Returns route path as string
     *
     * @param string $path
     * @return string
     */
    public function routePath($path = "index")
    {
        return snake_case($this->model) . '.' . $path;
    }

    /**
     * Get model name, if isset the model parameter, then get it, if not then get the class name, strip "Controller" out
     *
     * @return string
     */
    protected function getModel()
    {
        return empty($this->model) ?
            explode('Controller', substr(strrchr(get_class($this), '\\'), 1))[0]  :
            $this->model;
    }
}