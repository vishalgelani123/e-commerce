<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CommonFunctionTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Weight;

class WeightController extends Controller
{

    public function index(Request $request)
    {
        $categories = Weight::orderby('id', 'asc')->get();
        return view('admin.weight.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.weight.create');
    }

    public function store(Request $request)
    {
        $rules = [
			'weight_from' => 'required',
			'weight_to' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return redirect()->route('admin.weight.index')->with('error', 'Failed to create');
        }else{
            $data = $request->input();
            $student = new Weight;
            $student->weight_from = $data['weight_from'];
            $student->weight_to = $data['weight_to'];
            $student->save();
            return redirect()->route('admin.weight.index')->with('success', trans('global.weight_created'));
        }
    }

    
    public function edit(Request $request,$id)
    {
        $category = Weight::where('id',$id)->first();
        return view('admin.weight.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category_data = $request->all();
        $rules = [
			'weight_from' => 'required',
			'weight_to' => 'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return redirect()->route('admin.weight.index')->with('error', 'Failed to update');
        }else{
            $data = $request->input();
            //$student = new Weight;
            $student = Weight::find($data['id']);
            $student->weight_from = $data['weight_from'];
            $student->weight_to = $data['weight_to'];
            $student->save();
            return redirect()->route('admin.weight.index')->with('success', trans('global.weight_updated'));
        }
    }

    public function deleteweight(Request $request,$id){
        $mail=Weight::find($id);
        $mail->delete($mail->id);
        return back()->with('success','Weight range deleted successfully.');
    }
}
