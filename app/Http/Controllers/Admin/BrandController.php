<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        $brands=Brand::orderby('id','desc')->get();
        return view('admin.brands.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->all());

        return redirect()->route('admin.brands.index')->with('success',trans('global.brand_created'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        return redirect()->route('admin.brands.index')->with('success',trans('global.brand_updated'));
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return back()->with('success',trans('global.brand_deleted'));
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        Brand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Brand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $brand = Brand::find($id);
        $brand->status = $status;
        $brand->save();

        if($brand->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
