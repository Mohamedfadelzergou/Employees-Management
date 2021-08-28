<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeDataController extends Controller
{
   public function countries(){
    $countries=Country::all();
    return response()->json($countries);
   }
   public function states(Country $country){
    return response()->json($country->states);
   }
   public function cities(State $state){
    return response()->json($state->cities);
   }
   public function departments(){
    $department=Department::all();
    return response()->json($department);
   }
}
