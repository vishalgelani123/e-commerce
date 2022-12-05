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
use App\Models\VideoAdd;


use App\Models\Slider;

class VideoAddController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $video_data = VideoAdd::get()->count();
     
        if ($request->ajax()) {
           
           
            $query = VideoAdd::query()->select(sprintf('%s.*', (new VideoAdd())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'slider_show';
                $editGate = 'slider_edit';
                $deleteGate = 'slider_delete';
                $crudRoutePart = 'video-add';

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

                if ($photo =  $row->video ? $row->video : '') {
                   
                   return '<div class="text-center"><span class="badge badge-dark p-2">'.$photo.'</span></div>
                   ';
                    // return sprintf(
                   
                    //     '<div class="text-center"><a href="%s" target="_blank"><img onerror="handleError(this);"src="%s" width="50px" height="50px" style="border : 2px solid lightgray; border-radius : 5px;"></a></div>',
                    //     $photo,
                    //     $photo,
                    // );
                }

                return '';
            });
            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Slider::STATUS_SELECT[$row->status] : '';
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

        return view('admin.videoAdd.index',compact('video_data'));
    }

    public function create()
    {
        // abort_if(Gate::denies('slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videoAdd.create');
    }

  
    public function store(Request $request)
    {
        // $request = $this->imageUpload($request, 'slider');
       //  dd($request->all());
        $data=$request->all();
        $video=$data['video'];
        $originalName = $data['video']->getClientOriginalName();
        $input = time().'.'.$video->getClientOriginalExtension();
        $destinationPath = public_path().'/file/videos/';
       
        $video->move($destinationPath, $input);
        $vi = new VideoAdd();
        $vi->title = $request->title;
        $vi->video = $input;
        $vi->save();
        return redirect()->route('admin.video-add.index')->with('success', trans('global.video_created'));
    }

    public function edit(VideoAdd $video,$id)
    {   
        // abort_if(Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $slider = VideoAdd::where('id',$id)->first();     
        return view('admin.videoAdd.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        // $request = $this->imageUpload($request, 'slider');
     
        $input = null;
        $data=$request->all();
        if(isset($data['video'])){
            $video=$data['video'];
            $originalName = $data['video']->getClientOriginalName();
            $input = time().'.'.$video->getClientOriginalExtension();
            $destinationPath = public_path().'/file/videos/';
            $video->move($destinationPath, $input);
        }
        
        $videoDetails=VideoAdd::find($id);
        $videoDetails->title = $request->input('title');
        $videoDetails->video = $input;
        $videoDetails->status = $request->input('status');
        $videoDetails->save();
        
        return redirect()->route('admin.video-add.index')->with('success', trans('global.video_updated'));
    }

    public function show(Slider $slider)
    {   
        return view('admin.sliders.show', compact('slider'));
    }

    public function destroy(Request $request)
    {
        // abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $vi = new VideoAdd();
        $vi->exists = true;
        $vi->id = 1;
        
        $get_video = $vi->get();
       
        
        
        $image_path = public_path("file/videos/{$get_video[0]->video}");
        if (!empty($get_video[0]->video)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        
        $res = VideoAdd::truncate();
//        $slider->delete();

        return back()->with('success', trans('global.video_deleted'));
    }

    public function massDestroy(MassDestroySliderRequest $request)
    {
        $res = VideoAdd::whereIn('id', request('ids'))->delete();
       
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('slider_create') && Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Slider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
     //   dd($status);
        $slider = VideoAdd::find($id);
        $slider->status = $status;
        $slider->save();

        if($slider->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }

}
