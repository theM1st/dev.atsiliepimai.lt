<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CountryRequest;
use App\Country;

class CountriesController extends AdminController
{
    /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        $countries = Country::getCountries();

        return $this->display($this->viewPath(), [
            'countries' => $countries
        ]);
    }

    public function create()
    {
        return $this->display($this->viewPath('create'));
    }

    public function store(CountryRequest $request)
    {
        return $this->createAlertRedirect(Country::class, $request->all());
    }

    public function edit(Country $country)
    {
        \Former::populate($country);

        return $this->display($this->viewPath('edit'), [
            'country' => $country,
        ]);
    }

    public function update(Country $country, CountryRequest $request)
    {
        return $this->saveAlertRedirect($country, $request->all());
    }

    public function move(Country $country, $position)
    {
        $country->setPosition($position);

        return $country;
    }

    public function delete(Country $country)
    {
        return [
            'html' => view('admin.countries.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'country' => $country,
            ])->render()
        ];
    }

    public function destroy(Country $country)
    {
        return $this->destroyAlertRedirect($country);
    }
}