<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Country::latest()->get();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editGate = 'country_edit';
                $deleteGate = 'country_delete';
                $crudRoutePart = 'country';

                return view('partials.datatablesActions', compact(
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->rawColumns(['actions','name','id']);

            return $table->make(true);
        }

        return view('admin.country.index');
    }

    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.country.create', compact('roles'));
    }

    public function store(StoreCountryRequest $request)
    {
        $user = Country::create($request->all());
        return redirect()->route('admin.country.index');
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->all());
        return redirect()->route('admin.country.index');
    }

    public function import(Request $request)
    {
        return view('admin.country.import');
    }

    function storecsv(Request $request){
        $file = $_FILES['name'];
        
        $counter = 0;
        $file_data = fopen($file["tmp_name"], 'r');  
        while($row = fgetcsv($file_data))  
        {  
            if($counter == 0){
                $counter++;
                continue;
            }

            $country = strtolower(trim($row[1]));
            $state = strtolower(trim($row[2]));
            $city = strtolower(trim($row[3]));

            $ecountry = Country::where('name',$country)->first();
            
            if(isset($ecountry->id)){
                $mcountry = $ecountry->id;
            }else{
                $student = new Country;
                $student->name = $country;
                $student->save();
                $mcountry = $student->id;
            }

            $estate = State::where('name',$state)->where('country_id',$mcountry)->first();

            if(isset($estate->id)){
                $mstate = $estate->id;
            }else{
                $student = new State;
                $student->name = $state;
                $student->country_id = $mcountry;
                $student->save();
                $mstate = $student->id;
            }


            $ecity = City::where('name',$city)->where('state_id',$mstate)->first();

            if(isset($ecity->id)){
                $mstate = $ecity->id;
            }else{
                $student = new City;
                $student->name = $city;
                $student->state_id = $mstate;
                $student->save();
            }
            $counter++;  
        }
        return redirect()->route('admin.country.index');
    }

    public function destroy(Country $country){
        $country->delete();
        return back();
    }

    public function massDestroy(MassDestroyCountryRequest $request)
    {
        Country::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
