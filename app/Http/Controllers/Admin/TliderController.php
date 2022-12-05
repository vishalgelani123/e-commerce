<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TtoreSliderRequest;
use App\Http\Requests\UpdateTliderRequest;
use App\Http\Requests\MassDestroyTliderRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Tlider;

class TliderController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Tlider::query()->select(sprintf('%s.*', (new Tlider())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'slider_show';
                $editGate = 'slider_edit';
                $deleteGate = 'slider_delete';
                $crudRoutePart = 'trendsliders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('title', function ($row) {
                $title =  $row->title ? $row->title : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$title.'</span></div>';
            });
            $table->editColumn('image', function ($row) {

                if ($photo = $row->photo) {
                    return sprintf(
                        '<div class="text-center"><a href="%s" target="_blank"><img onerror="handleError(this);"src="%s" width="50px" height="50px" style="border : 2px solid lightgray; border-radius : 5px;"></a></div>',
                        !empty($photo) && isset($photo->url) ? $photo->url : "",
                        !empty($photo) && isset($photo->thumb) ? $photo->thumb : ""
                    );
                }

                return '';
            });
            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Tlider::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'image','id','title','status']);

            return $table->make(true);
        }

        return view('admin.trendsliders.index');
    }

    public function create()
    {
        return view('admin.trendsliders.create');
    }

    public function store(TtoreSliderRequest $request)
    {
        Tlider::create($request->all());

        return redirect()->route('admin.trendsliders.index');
    }

    public function edit(Tlider $slider,$id)
    {
        $slider = Tlider::where('id',$id)->first();
        return view('admin.trendsliders.edit', compact('slider'));
    }

    public function update(UpdateTliderRequest $request, Tlider $slider,$id)
    {
        $rt = Tlider::find($id);
        $rt->title = $request->input('title');
        $rt->url = $request->input('url');
        $rt->description = $request->input('description');
        $rt->image = $request->input('image');
        $rt->status = $request->input('status');
        $rt->save();
        
        return redirect()->route('admin.trendsliders.index');
    }

    public function show(Tlider $slider,$id)
    {
        $slider = Tlider::where('id',$id)->first();
        return view('admin.trendsliders.show', compact('slider'));
    }

    public function destroy(Tlider $slider,$id)
    {
        $mail=Tlider::find($id);
        $mail->delete($mail->id);
        return back();
    }

    public function massDestroy(MassDestroyTliderRequest $request)
    {
        Tlider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Tlider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $slider = Tlider::find($id);
        $slider->status = $status;
        $slider->save();

        if($slider->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
