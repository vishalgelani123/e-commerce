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

use App\Models\ContactUs;


class ContactusController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ContactUs::latest()->get();
            $table = Datatables::of($query);

            $table->rawColumns(['name','email','phone','subject','message']);

            return $table->make(true);
        }
        return view('admin.contactus.index');
    }

    public function create()
    {
        $categories = Weight::orderby('id', 'asc')->get();
        return view('admin.contactus.create', compact('categories'));
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
            return redirect()->route('admin.contactus.index')->with('error', 'Failed to create');
        }else{
            $data = $request->input();
            
            if (ContactUs::where('ps_pincode', '=', $data['ps_pincode'])->where('ps_weight_id', '=', $data['ps_weight_id'])->exists()) {
                return redirect()->route('admin.contactus.index')->with('error', 'Record Already exist');
            }
           
            $student = new Shipping;
            $student->ps_pincode = $data['ps_pincode'];
            $student->ps_weight_id = $data['ps_weight_id'];
            $student->ps_price = $data['ps_price'];
            $student->save();
            return redirect()->route('admin.contactus.index')->with('success', trans('global.save_success'));
        }
    }

    
    public function edit(Request $request,$id)
    {
        $category = ContactUs::where('id',$id)->first();
        $categories = Weight::orderby('id', 'asc')->get();
        return view('admin.contactus.edit', compact('category','categories'));
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
            return redirect()->route('admin.contactus.index')->with('error', 'Failed to update');
        }else{
            $data = $request->input();
            $student = ContactUs::find($data['id']);
            $student->ps_pincode = $data['ps_pincode'];
            $student->ps_weight_id = $data['ps_weight_id'];
            $student->ps_price = $data['ps_price'];
            $student->save();
            return redirect()->route('admin.contactus.index')->with('success', trans('global.update_success'));
        }
    }

    public function destroy(Shipping $shipping){
        $shipping->delete();
        return back()->with('success','Shipping deleted successfully.');;
    }
    
    public function deleteshipping(Request $request,$id){
        $mail=ContactUs::find($id);
        $mail->delete($mail->id);
        return back()->with('success','Shipping deleted successfully.');
    }
}
