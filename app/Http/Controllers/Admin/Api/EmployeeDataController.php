<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use Illuminate\Http\Request;

class EmployeeDataController extends Controller
{
    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountries()
    {
        return Country::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
    }

    /**
     * Display a listing of the states.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStates(Country $country)
    {
        return $country->states;
    }

    /**
     * Display a listing of the cities.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities(State $state)
    {
        return $state->cities;
    }

    /**
     * Display a listing of the departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDepartments()
    {
        return Department::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
