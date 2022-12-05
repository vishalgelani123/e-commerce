<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStateRequest;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = State::latest()->get();

            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('country', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                    $editGate = 'state_edit';
                    $deleteGate = 'state_delete';
                    $crudRoutePart = 'state';

                    return view('partials.datatablesActions', compact(
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('country', function ($row) {
                $comment = Country::find($row->country_id);
 
                return $comment->name;
            });

            $table->rawColumns(['actions','name','id','country']);

            return $table->make(true);
        }

        return view('admin.state.index');
    }

    public function create()
    {
        $roles = Country::all()->pluck('name', 'id');
        return view('admin.state.create', compact('roles'));
    }

    public function store(StoreStateRequest $request)
    {
        $user = State::create($request->all());
        return redirect()->route('admin.state.index');
    }

    public function edit(State $state)
    {
        $roles = Country::all()->pluck('name', 'id');
        return view('admin.state.edit', compact('state','roles'));
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $state->update($request->all());
        return redirect()->route('admin.state.index');
    }

    public function destroy(State $state){
        $state->delete();
        return back();
    }

    public function massDestroy(MassDestroyStateRequest $request)
    {
        State::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
