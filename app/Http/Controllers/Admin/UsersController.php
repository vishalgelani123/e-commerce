<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::whereNull("customer_type_id")->with(['roles'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                $id = $row->id ? $row->id : '';
                return '<div class="text-center">'.$id.'</div>';
            });
            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });
            $table->editColumn('email', function ($row) {
                $email =  $row->email ? $row->email : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$email.'</span></div>';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    // $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                    $labels[] =  '<span class="badge badge-warning p-2">'.$role->title.'</span>';
                }
                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'roles','name','email','id']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index')->with('success',trans('global.user_created'));
    }

    public function edit(User $user)
    {
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');
        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index')->with('success',trans('global.user_updated'));
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', __('global.cannot_delete_yourself'));
        }

        $user->delete();
        return back()->with('success',trans('global.user_deleted'));
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
