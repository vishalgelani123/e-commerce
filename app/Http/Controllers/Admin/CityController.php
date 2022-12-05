<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = City::latest()->get();

            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('State', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                    $editGate = 'city_edit';
                    $deleteGate = 'city_delete';
                    $crudRoutePart = 'city';

                    return view('partials.datatablesActions', compact(
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('state', function ($row) {
                $state = State::find($row->state_id);
                $name = !empty($state) ? $state->name : "";
                return $name;
            });

            $table->rawColumns(['actions','name','id','state']);

            return $table->make(true);
        }

        return view('admin.city.index');
    }

    public function create()
    {
        $roles = State::all()->pluck('name', 'id');
        
        return view('admin.city.create', compact('roles'));
    }

    public function store(StoreCityRequest $request)
    {
        $user = City::create($request->all());
        return redirect()->route('admin.city.index');
    }

    public function edit(City $city)
    {
        $roles = State::all()->pluck('name', 'id');
        return view('admin.city.edit', compact('city','roles'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('admin.city.index');
    }

    public function destroy(City $city){
        $city->delete();
        return back();
    }

    public function massDestroy(MassDestroyCityRequest $request)
    {
        City::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
