<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyColorRequest;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Color::query()->select(sprintf('%s.*', (new Color())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'color_show';
                $editGate = 'color_edit';
                $deleteGate = 'color_delete';
                $crudRoutePart = 'colors';

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
            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class=""><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });
            $table->editColumn('value', function ($row) {
                $value =  sprintf(
                    '<input type="color" disabled readonly value="%s" /> &nbsp; (%s)',
                    $row->value,
                    $row->value
                );
                return '<div class="text-center">'.$value.'</div>';
            });
            $table->editColumn('status', function ($row) {
                $status =  Color::STATUS_SELECT[$row->status];
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'value', 'placeholder', 'name','status']);
            return $table->make(true);
        }

        return view('admin.colors.index');
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(StoreColorRequest $request)
    {
        $color = Color::create($request->all());
        return redirect()->route('admin.colors.index')->with('success', trans('global.color_created'));
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->update($request->all());
        return redirect()->route('admin.colors.index')->with('success', trans('global.color_updated'));
    }

    public function show(Color $color)
    {
        return view('admin.colors.show', compact('color'));
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return back()->with('success',trans('global.color_deleted'));
    }

    public function massDestroy(MassDestroyColorRequest $request)
    {
        Color::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $pattr = ProductVariation::where('color_id', $id)->first();

        if($pattr) {
            return response()->json(['code' => 304, 'success' => false, 'message' => "Can't delete this because use in one of the live product"]);
        }

        $color = Color::find($id);
        $color->status = $status;
        $color->save();

        if($color->id) {
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        }
        else {
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
        }
    }
}
