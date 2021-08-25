<?php

namespace App\Http\Controllers\Backend;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index(Request $request){
        $countries=Country::all();
        if($request->has('search')){
            $countries=Country::where('country_code','like',"%{$request->search}%")->orWhere('name','like',"%{$request->search}%")->get();
        }
        return view('country.index',['countries'=>$countries]);
    }
    public function create(){
        return view('country.create');
    }
    public function store(Request $request , Country $country){
        $request->validate([
            'country_code'=>['required','min:3'],
            'name'=>['required']
        ]);
        $country = new country();
        $country->country_code=$request->country_code;
        $country->name=$request->name;
        $country->save();
        return redirect()->route('countries.index')->with('message','Country create succesfully!!');
    }
    public function edit($country_id){
        $country=Country::find($country_id);
        return view('country.edit',['country'=>$country]);
    }
    public function update(Request $request,Country $country){
        $request->validate([
            'country_code'=>['required','min:3'],
            'name'=>['required']
        ]);
        $country->country_code=$request->country_code;
        $country->name=$request->name;
        $country->save();
        return redirect()->route('countries.index')->with('message','Country Updeted succesfully !!');
    }
    public function destroy($idcountry){
        $country=Country::find($idcountry);
        $country->delete();
        return redirect()->route('countries.index')->with('message','Country Deleted succesfully !!');
    }
}
