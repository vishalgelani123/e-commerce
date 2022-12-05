<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CommonFunctionTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Shipping;
use App\Models\Weight;

use App\Imports\ShippingImport;
use Maatwebsite\Excel\Facades\Excel;


class ShippingController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Shipping::latest()->get();
            $table = Datatables::of($query);
            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('weight', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                    $editGate = 'shipping_edit';
                    $deleteGate = 'shipping_delete';
                    $crudRoutePart = 'shipping';

                    return view('partials.datatablesActions', compact(
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('weight', function ($row) {
                $comment = Weight::find($row->ps_weight_id);
                return (isset($comment->id))?$comment->weight_from.'-'.$comment->weight_to.' Kg':'';
            });

            $table->rawColumns(['actions','ps_pincode','id','weight','ps_price']);

            return $table->make(true);
        }
        return view('admin.shipping.index');
    }

    public function create()
    {
        $categories = Weight::orderby('id', 'asc')->get();
        return view('admin.shipping.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
			'ps_pincode' => 'required',
			'ps_weight_id' => 'required',
            'ps_price' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return redirect()->route('admin.shipping.index')->with('error', 'Failed to create');
        }else{
            $data = $request->input();
            
            if (Shipping::where('ps_pincode', '=', $data['ps_pincode'])->where('ps_weight_id', '=', $data['ps_weight_id'])->exists()) {
                return redirect()->route('admin.shipping.index')->with('error', 'Record Already exist');
            }
           
            $student = new Shipping;
            $student->ps_pincode = $data['ps_pincode'];
            $student->ps_weight_id = $data['ps_weight_id'];
            $student->ps_price = $data['ps_price'];
            $student->save();
            return redirect()->route('admin.shipping.index')->with('success', trans('global.shipping_created'));
        }
    }

    
    public function edit(Request $request,$id)
    {
        $category = Shipping::where('id',$id)->first();
        $categories = Weight::orderby('id', 'asc')->get();
        return view('admin.shipping.edit', compact('category','categories'));
    }

    public function update(Request $request)
    {
        $category_data = $request->all();
        $rules = [
			'ps_pincode' => 'required',
			'ps_weight_id' => 'required',
            'ps_price' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return redirect()->route('admin.shipping.index')->with('error', 'Failed to update');
        }else{
            $data = $request->input();
            $student = Shipping::find($data['id']);
            $student->ps_pincode = $data['ps_pincode'];
            $student->ps_weight_id = $data['ps_weight_id'];
            $student->ps_price = $data['ps_price'];
            $student->save();
            return redirect()->route('admin.shipping.index')->with('success', trans('global.update_success'));
        }
    }

    public function destroy(Shipping $shipping){
        $shipping->delete();
        return back()->with('success','Shipping deleted successfully.');;
    }
    
    public function deleteshipping(Request $request,$id){
        $mail=Shipping::find($id);
        $mail->delete($mail->id);
        return back()->with('success','Shipping deleted successfully.');
    }

    public function import(){
        
        ini_set('max_execution_time', '500');
        Excel::import(new ShippingImport,request()->file('file'));
             
        return back()->with("message", "Pincode import successfully.");
    }
}
