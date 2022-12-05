<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Permission::query()->select(sprintf('%s.*', (new Permission())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'permission_show';
                $editGate = 'permission_edit';
                $deleteGate = 'permission_delete';
                $crudRoutePart = 'permissions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                $title =  $row->title ? $row->title : '';
                return '<span class="badge badge-dark p-2">'.$title.'</span>';
            });

            $table->rawColumns(['actions', 'placeholder','title']);

            return $table->make(true);
        }
        return view('admin.permissions.index');
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        return redirect()->route('admin.permissions.index')->with('success',trans('global.permission_created'));
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('success',trans('global.permission_updated'));
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success',trans('global.permission_deleted'));
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
