<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Requests\MassDestroyVideoAddRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\HomeBestSeller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Models\NewArrivalBanner;
use App\Models\BestSellerBanner;
use App\Models\LatestBanner;
use App\Models\Htext;

class HtextController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Htext::orderby('id', 'asc')->get();
        return view('admin.htext.index',compact('categories'));
    }

    public function create(){
        return view('admin.htext.create');
    }
  
    public function store(Request $request){
        $vi = new Htext();
        $vi->text = $request->text;
        $vi->status = $request->status;
        $vi->save();
        return redirect()->route('admin.htext.index')->with('success', trans('global.header_created'));
    }

    public function edit(Htext $slider,$id)
    {   
        $slider = Htext::where('id',$id)->first();     
        return view('admin.htext.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $vi=Htext::find($id);
        $vi->text = $request->input('text');
        $vi->status = $request->input('status');
        $vi->save();
        return redirect()->route('admin.htext.index')->with('success', trans('global.header_updated'));
    }

    public function show(Htext $slider)
    {
       return view('admin.htext.show', compact('slider'));
    }

    public function destroy(Request $request,$id)
    {
        $mail=Htext::find($id);
        $mail->delete($mail->id);
        return back()->with('success', trans('global.header_deleted'));;
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
     //   dd($status);
        $slider = Htext::find($id);
        $slider->status = $status;
        $slider->save();

        if($slider->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }

}
