<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\CommonFunctionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\Size;
use App\Models\Images;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\MapAttribute;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use Carbon\Carbon;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use FileUploadTrait, CommonFunctionTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {

            $query = Product::with(['category', 'sub_category', 'user', 'brand'])
            ->whereNull('products.deleted_at')
            ->select(sprintf('%s.*', (new Product())->table))->orderBy('products.id','desc');

            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';
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
                
                return '<div class="text-center">'.$id.'</div>';
            });

            $table->addColumn('category_name', function ($row) {
              $name =  $row->sub_category ? $row->sub_category->name : '';
              $categoryname =  Category::where('id',$row->category_id)->select('name', 'id')->first();
              if($categoryname) {
                $categoryname = $categoryname['name'];
              } else {
                $categoryname = '';
              }

              $subcategoryname =  Category::where('id',$row->sub_category_id)->select('name', 'id')->first();
              if($subcategoryname) {
                $subcategoryname = $subcategoryname['name'];
              } else {
                $subcategoryname = '';
              }

              $childcategoryname =  Category::where('id',$row->sub_category_child_id)->select('name', 'id')->first();
              if($childcategoryname){
                $childcategoryname = $childcategoryname['name'];
              }else{
                $childcategoryname = '';
              }

              $less = "";
              $name = "";

              if(isset($categoryname) && $categoryname != "") {
                  $name .= $categoryname;
                  $less = " > ";
              }

              if(isset($subcategoryname) && $subcategoryname != "") {
                  $name .= $less . $subcategoryname;
                  $less = " > ";
              }

              if(isset($childcategoryname) && $childcategoryname != "") {
                  $name .= $less . $childcategoryname;
              }

              return '<div class="text-center">'.$name.'</div>';

            });

            $table->editColumn('name', function ($row) {
                $url =  $row->slug ? url($row->slug) : '';
                $name =  $row->name ? $row->name : '';
                return '<div class=""><span class="badge badge-secondary p-2"><a href="'.$url.'" style="color:white" target="_blank">'.$name.'</a></span></div>';
            });

            $table->editColumn('sku_code', function ($row) {
                $sku =  $row->sku_code ? $row->sku_code : '';
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$sku.'</span></div>';
            });

            $table->addColumn('brand_name', function ($row) {
                $brand =  $row->brand ? $row->brand->name : '';
                return '<div class="text-center"><span class="badge badge-primary p-2">'.$brand.'</span></div>';
            });

            $table->editColumn('sales_price', function ($row) {
                $mrp = DB::table('product_variations')->where('product_id', $row->id)->first();
                if($mrp) { 
                return round($mrp->single_sales_price);
                }
            });

            $table->editColumn('in_stock', function ($row) {
                $stock =  $row->in_stock === 1 ? Product::IN_STOCK_SELECT[$row->in_stock] : '';
                if($stock === 'In Stack')
                     return '<div class="text-center"><span class="badge badge-success p-2">'.$stock.'</span></div>';
                else
                     return '<div class="text-center"><span class="badge badge-danger p-2">'.$stock.'</span></div>';

            });

            $table->editColumn('has_varient', function ($row) {
                $varients = DB::table('product_variations')->where('product_id', $row->id)->groupBy('color_id')->get();
                $count = !empty($varients) ? $varients->count() : 0;
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$count.'</span></div>';
            });

            $table->editColumn('front_image', function ($row) {
                $image = DB::table('product_images')->where('product_id', $row->id)->first();
                $count = !empty($varients) ? $varients->count() : 0;
                if(isset($image->file_name)) {
                    return '<div class="text-center"><img onerror="handleError(this);"style="width : 50px; height : 50px;border : 1px solid lightgrey;" src="'.asset("file/$image->file_name").'"></div>';
                }
            });

            $table->editColumn('view_count', function ($row) {
                $count =  $row->view_count;
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$count.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Product::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['placeholder', 'category', 'sub_category', 'brand', 'front_image']);
            $table->rawColumns(['actions', 'placeholder', 'category', 'sub_category', 'brand', 'front_image','category_name','name','brand_name','sku_code','mrp_price','sales_price','in_stock','has_varient','view_count','status','id']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isSubCatSelect = $category_id = $sub_category_id = $isCatSelect = 0;
        $categories = $subcategories = $brands = $colors = $sizes = $attributes = [];

        if ($request->category_id && $request->sub_category_id) {
            $isSubCatSelect = $isCatSelect = 1;
            $category_id = $request->category_id;
            $sub_category_id = $request->sub_category_id;

            $mapAttributes = MapAttribute::where([
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'status' => 1
            ])
            ->first();

            if (!$mapAttributes) {
                return redirect(route('admin.products.index'))->with('warning', trans('product.map_attribute_not_exists'));
            }

            if ($mapAttributes->is_attribute && $mapAttributes->attributes && is_array($mapAttributes->attributes)) {
                foreach ($mapAttributes->attributes as $id => $val) {
                    $attributes[$id] = Attribute::find($id);
                    $attributes[$id]['attributeValues'] = AttributeValue::whereIn('id', $val['attributevalues'] ?? array())->get();
                }
            }

            if ($mapAttributes->is_size) {
                if ($mapAttributes->sizes && is_array($mapAttributes->sizes)) {
                    $sizes = Size::whereIn('id', $mapAttributes->sizes)->where('status', 1)->get();
                } else {
                    $sizes = Size::where('status', 1)->get();
                }
            }

            if ($mapAttributes->is_color) {
                if ($mapAttributes->colors && is_array($mapAttributes->colors)) {
                    $colors = Color::whereIn('id', $mapAttributes->sizes)->where('status', 1)->get();
                } else {
                    $colors = Color::where('status', 1)->get();
                }
            }

            if ($mapAttributes->is_brand) {
                if ($mapAttributes->brands && is_array($mapAttributes->brands)) {
                    $brands = Brand::whereIn('id', $mapAttributes->sizes)
                        ->where('status', 1)
                        ->get()
                        ->pluck('name', 'id')
                        ->prepend(trans('global.pleaseSelect'), '');
                } else {
                    $brands = Brand::where('status', 1)->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
                }
            }
        } elseif ($request->category_id) {
            $isCatSelect = 1;
            $subcategories = Category::where(['status' => 1])->where('parent_id', '=', $request->category_id)->get();
        }

        $maped_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(category_id) as ids')->value('ids');

        $categories = Category::whereIn('id', explode(',', $maped_category_ids))
            ->where(['status' => 1, 'parent_id' => '0'])
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $data = compact('categories');
        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {
        $product_data = $request->except('gallery', 'size_chart', 'attributes', 'color_id', 'size_id');
        $product_data['user_id'] = auth()->id();
        $product_data['slug'] = $this->getSlug($product_data['name'], 'products');

        // if($request->has("size_chart")){
        //      $array = explode('.', $_FILES['size_chart']['name']);
        //     $extension = end($array);
        //     $fileName = time().'.'.$_FILES['size_chart']['name'].$extension;
        //     $request->size_chart->move(public_path('file'), $fileName);
        //     $product_data['size_chart'] = $fileName;
        // }
         if($request->has('size_chart')){
           
            $array = explode('.', $_FILES['size_chart']['name']);
            $extension = end($array);
            $imageName = time().'.'.$_FILES['size_chart']['name'].$extension;
            $request->size_chart->move(public_path('file'), $imageName);
             $product_data['size_chart'] = $imageName;
        }
        if ($request->discount_type == 1) {
            $discount = ($request->mrp_price * $request->discount) / 100;
            $product_data['sales_price'] = $request->mrp_price - $discount;
        } else if ($request->discount_type == 2) {
            $product_data['sales_price'] = $request->mrp_price - $request->discount;
        }

        $product = Product::create($product_data);

        if ($request->has('variation')) {
            $z = 0;
            foreach ($request->input('variation') as $key => $value) {

                if ($key && isset($value['sizes'])) {
                    foreach($value['sizes'] as $k=> $v){
                        $record = explode(",",$v);
                        if($product->discount_type == '1'){
                            $sales_single_price=$value['single_price'][$record[1]]-($product->discount/100)*$value['single_price'][$record[1]];
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                        }else{
                            $sales_single_price=$value['single_price'][$record[1]]-$product->discount;
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                        }
                        
                        ProductVariation::create([
                           'color_id' => $key,
                           'size_id' => $record[0],
                           'single_price' => $value['single_price'][$record[1]],
                           'single_sales_price' => $sales_single_price,
                            'single_price_quantity' => $value['single_price_quantity'][$record[1]],
                            'size_status' => isset($value['size_status'][$record[1]]) ? $value['size_status'][$record[1]] : "",
                           'product_id' => $product->id,
                           'status' => 1,
                           'primary_variation'=> array_key_exists($key,$request->primary) ? 1 : 0
                       ]);
                    }
                }
                $z++;
            }
        }

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $key => $value) {
                if ($key && $value) {
                     ProductAttribute::create([
                         'attribute_id' => $key,
                         'attribute_value_id' => $value,
                         'product_id' => $product->id,
                         'status' => 1,
                     ]);
                }
            }
        }


        if ($request->has('gallery')) {
            foreach ($request->gallery as $key => $value) {
                 foreach($value as $newkey => $newvalue){
                    $imagepath            = $newvalue;
                    $path               = 'file/';
                    $upload             = 'file/';
                    ProductImage::create([
                        'type' => 1,
                        'file_name' => $imagepath,
                        'product_id' =>$product->id,
                        'product_color_id'=>$key
                    ]);
                }
            }
        }
        return redirect()->route('admin.products.index')->with('success', trans('global.save_success'));
    }

    function getpartials(Request $request){
        $productid = $request->input('id');
        $product = Product::where('id',$productid)->first();
        $sizes = $brands = $colors = $attributes = [];

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('category', 'sub_category', 'user', 'brand','child_category','productProductVariations');

        $attributes=ProductAttribute::where('product_id',$product->id)->get();


        $arttvalue=AttributeValue::all();

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $product->category_id,
            'sub_category_id' => $product->sub_category_id
        ])->first();
        if (isset($mapAttributes->sizes) && $mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if (isset($mapAttributes->colors) && $mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        $productimages=ProductImage::where('product_id',$product->id)->get();
        $images=[];
        foreach($productimages as $key=>$img){
            $images[$key]=['file_name'=>$img->file_name,
                           'product_color_id'=>$img->product_color_id,
                           'id'=>$img->id
            ];
        }
        $html = view('admin.products.partial', compact('users', 'brands', 'product','colors', 'sizes','images','attributes'))->render();
        return $html;
    }

    public function edit(Product $product)
    {
        
        $sizes = $brands = $colors = $attributes = [];
        $images=[];
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $maped_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(category_id) as ids')->value('ids');
        $categories = Category::whereIn('id', explode(',', $maped_category_ids))
            ->where(['status' => 1, 'parent_id' => '0'])
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');
        $maped_subcategory_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_id) as ids')->value('ids');
        $sub_categories = Category::where('parent_id',$product->category_id)->whereIn('id', explode(',', $maped_subcategory_ids))->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $child_categories=Category::where('parent_id',$product->sub_category_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $product->load('category', 'sub_category', 'user', 'brand','child_category','productProductVariations', 'productProductImages');
        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $product->category_id,
            'sub_category_id' => $product->sub_category_id
        ])->first();
        if (isset($mapAttributes->sizes) && $mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        $variations = [];
        $productVariation = ProductVariation::where([
            'product_id' => $product->id,
        ])->get();
        foreach ($productVariation as $variation) {
            $variations [$variation->color_id][$variation->size_id] = $variation;

        }
        $productVariation = ProductVariation::where([
            'product_id' => $product->id,
        ])->pluck('size_id')->toArray();
        $productColors = ProductVariation::where([
            'product_id' => $product->id,
        ])->pluck('color_id')->toArray();
        
        $productImages = ProductImage::where([
            'product_id' => $product->id,
        ])->get();
        $productPrimaryVariation = ProductVariation::where([
            'product_id' => $product->id,
            'primary_variation' => 1
        ])->get();
        $productColors = array_unique($productColors);
        if (isset($mapAttributes->colors) && $mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }
        return view('admin.products.edit', compact('product','categories','sub_categories','child_categories','colors','images','productVariation','productColors','sizes', 'variations', 'productImages', 'productPrimaryVariation'));
    }

    function sendimg(Request $request){
        $images = ProductImage::join('products', 'products.id', '=', 'product_images.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('product_images.id as id','product_images.file_name as name','categories.name as ca_name','categories.id as ca_id')
        ->where('categories.parent_id',0)
        ->where('categories.id',$request->get('id'))
        ->whereNull('products.deleted_at')->orderBy('product_images.id','desc')
        ->paginate(24);
        $response = view('admin.products.paginated_media',compact('images'))->render();

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
        exit;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
       abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $icollection = ProductImage::where('product_id', $product->id)->select('id')->get();
       if($icollection->count() > 0){
            foreach($icollection as $i){
                ProductImage::find($i->id)->delete();
            }
       }

       $vcollection = ProductVariation::where('product_id', $product->id)->select('id')->get();
       if($vcollection->count() > 0){
            foreach($vcollection as $v){
                ProductVariation::find($v->id)->delete();
            }
       }

       $acollection = ProductAttribute::where('product_id', $product->id)->select('id')->get();
        if($acollection->count() > 0){
            foreach($acollection as $a){
                ProductAttribute::find($a->id)->delete();
            }
        }

        $is_sho_by_look = (isset($request->is_sho_by_look) && $request->is_sho_by_look != "") ? $request->is_sho_by_look : 0;
        $is_popular = (isset($request->is_popular) && $request->is_popular != "") ? $request->is_popular : 0;
        $data_arr = array(
            "is_sho_by_look" => $is_sho_by_look,
            "is_popular" => $is_popular
        );
        $product->update($data_arr);

        $product_data = $request->except('gallery', 'attributes', 'color_id', 'size_id','old','variation');

        $product_data['is_exclusive'] = isset($product_data['is_exclusive']) ? $product_data['is_exclusive'] : 0;
        $product_data['is_featured'] = isset($product_data['is_featured']) ? $product_data['is_featured'] : 0;
        $product_data['is_sho_by_look'] = isset($product_data['is_sho_by_look']) ? $product_data['is_sho_by_look'] : 0;
        $product_data['is_popular'] = isset($product_data['is_popular']) ? $product_data['is_popular'] : 0;
        $product_data['is_new'] = isset($product_data['is_new']) ? $product_data['is_new'] : 0;

        if($request->has("size_chart")){
            $fileName = time().'.'.$request->size_chart->extension();
            $request->size_chart->move(public_path('file'), $fileName);
            $product_data['size_chart'] = $fileName;
        }

        $product->update($product_data);
        if ($request->has('gallery')) {
            foreach ($request->gallery as $key => $value) {
                 foreach($value as $newkey => $newvalue){
                    $imagepath            = $newvalue;
                    $path               = 'file/';
                    $upload             = 'file/';
                    ProductImage::create([
                        'type' => 1,
                        'file_name' => $imagepath,
                        'product_id' =>$product->id,
                        'product_color_id'=>$key
                    ]);
                 }
            }
        }

        if ($request->has('variation')) {
            foreach ($request->input('variation') as $key => $value) {
                if ($key && isset($value['sizes'])) {
                    foreach($value['sizes'] as $k=> $v){
                        $record = explode(",",$v);
                        if ($product->discount_type == '1') {
                            $sales_single_price=$value['single_price'][$record[1]]-($product->discount/100)*$value['single_price'][$record[1]];
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                        }
                        else{
                            $sales_single_price=$value['single_price'][$record[1]]-$product->discount;
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                        }

                        $primary = 0;
                        if(isset($request->primary) && $request->primary != "" ){
                            if(array_key_exists((int)$key,$request->primary)){
                                $primary = 1;
                            }
                        }

                        $size_status = 0;
                        if(isset($value['size_status'][$record[1]]) && $value['size_status'][$record[1]] != "" ){
                            $size_status = $value['size_status'][$record[1]];
                        }

                        $single_sku = '';
                        if(isset($value['single_sku'][$record[1]]) && $value['single_sku'][$record[1]] != "" ){
                            $single_sku = $value['single_sku'][$record[1]];
                        }

                        $single_price_quantity = 0;
                        if(isset($value['single_price_quantity'][$record[1]]) && $value['single_price_quantity'][$record[1]] != "" ){
                            $single_price_quantity = $value['single_price_quantity'][$record[1]];
                        }

                        $single_price = 0;
                        if(isset($value['single_price'][$record[1]]) && $value['single_price'][$record[1]] != "" ){
                            $single_price = $value['single_price'][$record[1]];
                        }

                        ProductVariation::create([
                           'color_id' => $key,
                           'size_id' => $record[0],
                           'single_sku' => $single_sku,
                           'single_price' => $single_price,
                           'single_sales_price' => $sales_single_price,
                           'single_price_quantity' => $single_price_quantity,
                           'size_status' => $size_status,
                           'product_id' => $product->id,
                           'status' => 1,
                           'primary_variation'=> $primary
                       ]);
                    }
                }
            }
        }

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $key => $value) {
                if ($key && $value) {
                     ProductAttribute::create([
                         'attribute_id' => $key,
                         'attribute_value_id' => $value,
                         'product_id' => $product->id,
                         'status' => 1,
                     ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', trans('global.update_success'));;
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category', 'sub_category', 'user', 'brand', 'productProductImages', 'productProductVariations', 'productProductAttributes');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Request $request, $id)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ProductVariation::where('product_id', $id)->update(['deleted_at' =>  Carbon::now()]);
        ProductAttribute::where('product_id', $id)->update(['deleted_at'=> Carbon::now()]);
        ProductImage::where('product_id', $id)->update(['deleted_at'=> Carbon::now()]);
        Product::where('id', $id)->update(['deleted_at' => Carbon::now(),'status'=>0]);
        return back()->with('success', 'Product deleted successfully');;
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {

        Product::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function getImages()
    {
        $images = ProductImage::all()->toArray();
        foreach($images as $image){
            $tableImages[] = $image['file_name'];
        }
        $storeFolder = public_path('storage/product');
        $file_path = public_path('storage/product/');
        $files = scandir($storeFolder);
        foreach ( $files as $file ) {
            if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('storage/product/').$file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('public/storage/product/'.$file);
                $data[] = $obj;
            }

        }
        //dd($data);
        return response()->json($data);
    }

    public function mappedAttributes(Request $request)
    {
        $sizes = $brands = $colors = $attributes = [];
        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required',
                'sub_category_id' => 'required',
            ],
            [
                'category_id.required' => trans('validation.required.category_id'),
                'sub_category_id.required' => trans('validation.required.sub_category_id'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id
        ]) ->first();

        $maped_sub_category_ids = MapAttribute::where([
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id

        ])->where('sub_category_child_id','>',0)->pluck('sub_category_child_id')->toArray();


        $childCategory = array();
        if(!empty($maped_sub_category_ids)){
            $childCategory = Category::where(['parent_id'=>$request->sub_category_id,'status' => 1])->whereIn('id', $maped_sub_category_ids)->get();
        }
        if (!$mapAttributes) {
            return response()->json([
                'success' => false,
                'sizes' => [],
                'colors' => [],
                'brands' => [],
                'message' => 'Please add attribute first!!'
            ]);
        }

        if ($mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->brands) {
            $brands = Brand::whereIn('id', $mapAttributes->brands)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->get()
                ->toArray();
        }

        $attributes = $mapAttributes->attributes;
        return response()->json([
            'success' => true,
            'sizes' => count($sizes) ? $sizes : [],
            'colors' => count($colors) ? $colors : [],
            'brands' => count($brands) ? $brands : [],
            'child_category' => $childCategory ? $childCategory : array(),
            'html' => view('admin.products.variation', compact('colors', 'sizes'))->render(),
            'attribute_html' => view('admin.products.attributes', compact('attributes'))->render(),
            'message' => 'Attributes found'
        ]);
    }

    public function mappedChildAttributes(Request $request)
    {
        $sizes = $brands = $colors = $attributes = [];
        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'child_id' => 'required',
            ],
            [
                'category_id.required' => trans('validation.required.category_id'),
                'sub_category_id.required' => trans('validation.required.sub_category_id'),
                'child_id.required' => trans('validation.required.child_id'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_category_child_id' => $request->child_id
        ]) ->first();


        if (!$mapAttributes) {
            return response()->json([
                'success' => false,
                'sizes' => [],
                'colors' => [],
                'brands' => [],
                'message' => 'Please add attribute first!!'
            ]);
        }

        if ($mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->brands) {
            $brands = Brand::whereIn('id', $mapAttributes->brands)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->get()
                ->toArray();
        }

        $attributes = $mapAttributes->attributes;
        return response()->json([
            'success' => true,
            'sizes' => count($sizes) ? $sizes : [],
            'colors' => count($colors) ? $colors : [],
            'brands' => count($brands) ? $brands : [],
            'html' => view('admin.products.variation', compact('colors', 'sizes'))->render(),
            'attribute_html' => view('admin.products.attributes', compact('attributes'))->render(),
            'message' => 'Attributes found'
        ]);
    }

    public function subCategories(Request $request)
    {
        $query = Category::where(['status' => 1, 'parent_id' => $request->parent_id]);
        if(isset($request->exclude) && $request->exclude == 1){
          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_id) as ids')->value('ids');
          $cats = [];
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
        foreach($maped_sub_category_ids_arr as $subcat){
            $subcats = Category::where(['status' => 1, 'parent_id' => $subcat])->select(['id', 'name'])->get();
            if(count($subcats) == 0){
              $cats[] = $subcat;
            } else {
                $mappedCats = MapAttribute::where(['sub_category_id' => $subcat])->get();
                if(count($subcats) == count($mappedCats)) {
                    $cats[] = $subcat;
                }
            }
        }
          if(count($cats) > 0) {
            $query->whereNotIn('id', $cats);
          }
        }
        if(isset($request->child_category) && $request->child_category == 1){
          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_child_id) as ids')->value('ids');
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
          if(count($maped_sub_category_ids_arr) > 0){
            $query->whereNotIn('id', $maped_sub_category_ids_arr);
          }
        }

        $map_remove = MapAttribute::where('category_id' , $request->parent_id)->get();

        $map_ids = [];
        foreach($map_remove as $map){
             array_push($map_ids, $map->sub_category_id);
        }
        $query->whereIn('id',$map_ids)->select(['id', 'name','parent_id']);
        $subCategories = $query->get()->toArray();


        if (count($subCategories)) {
            return response()->json([
                'success' => true,
                'subCategories' => $subCategories,
                'message' => 'Sub Categories found'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'subCategories' => [],
                'message' => 'Sub Category not Exists in selected category'
            ]);
        }
    }

    public function childcategory(Request $request)
    {
        $query = Category::where(['status' => 1, 'parent_id' => $request->parent_id]);

          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_child_id) as ids')->value('ids');
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
          if(count($maped_sub_category_ids_arr) > 0){
            $query->whereNotIn('id', $maped_sub_category_ids_arr);
          }

        $map_remove = MapAttribute::where('category_id' , $request->parent_id)->get();
        $map_ids = [];
        foreach($map_remove as $map){
             array_push($map_ids, $map->sub_category_id);
        }
        $query->whereNotIn('id',$map_ids)->select(['id', 'name']);
        $subCategories = $query->get()->toArray();


        if (count($subCategories)) {
            return response()->json([
                'success' => true,
                'subCategories' => $subCategories,
                'message' => 'Sub Categories found'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'subCategories' => [],
                'message' => 'Sub Category not Exists in selected category'
            ]);
        }
    }

    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        $product = Product::find($id);
        $product->status = $status;
        $product->save();

        if($product->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }

    public function sku_code($sku_code){
        $product = Product::where('sku_code', $sku_code)->first();
        $msg = '';
        $code = 0;
        if($product){
            $code = 404;
            $msg = 'Sku code not available';
        }
        else{
            $length = strlen($sku_code);
            if($length < 4){
                $code = 503;
                $msg = 'Sku code length should be atleast 4 character long';
            }
            else{
                $code = 200;
                $msg = 'Sku code is available';
            }
        }

        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $msg
        ]);
    }

    function import(Request $request){
        ini_set('max_execution_time', '500');
        Excel::import(new ProductImport,request()->file('file'));

        return back()->with("message", "Product import successfully.");
    }

    function storeimport(){
        if(!empty($_FILES["csv"]["name"])){
            $allowed_ext = array("csv");
            $extArray = explode(".",$_FILES["csv"]["name"]);
            $extension = end($extArray);
            if(in_array($extension, $allowed_ext))  {
                $counter = 0;
                $file_data = fopen($_FILES["csv"]["tmp_name"], 'r');
                $proid = 0 ;
                $crosst = 0;
                while($row = fgetcsv($file_data)){

                    if($counter == 0){
                        $counter++;
                        continue;
                    }

                    if($row[1] == 'product'){
                        $proid =0;
                        $crosst++;

                        $lastindex = array_key_last($row);

                        $uorder =  new Product;
                        $uorder->name = trim($row[2]);
                        $uorder->user_id = 1;
                        $uorder->slug = $this->getSlug(trim($row[2]), 'products');
                        $uorder->category_id = $this->getCategory(trim($row[3]),'category',0);
                        $uorder->sub_category_id = $this->getCategory(trim($row[4]),'child',$uorder->category_id);
                        $uorder->sub_category_child_id = $this->getCategory(trim($row[5]),'sub',$uorder->sub_category_id);
                        $uorder->description = trim($row[6]);
                        $uorder->care = trim($row[7]);
                        $uorder->sku_code = trim($row[8]);
                        $uorder->hsn_code = trim($row[9]);
                        $uorder->tax_rate = (int)trim($row[10]);
                        $uorder->is_exclusive = (int)trim($row[11]);
                        $uorder->is_featured = (int)trim($row[12]);
                        $uorder->is_new = (int)trim($row[13]);
                        $uorder->weight = trim($row[14]);
                        $uorder->is_sale = (int)trim($row[15]);
                        $uorder->status = 1;

                        $uorder->save();
                        $proid = $uorder->id;

                        $itrate = 0;
                        $attrId = 0;
                        $attrValueId = 0;

                        for($i=16;$i<=$lastindex;$i++){

                            $f = trim($row[$i]);
                            $exp = explode("_",$f);

                            if($exp[0] == 'attr'){
                                $requiredAttr = end($exp);
                                $itrate++;

                                //it is attribute
                                //identify either it is a value or name

                                if($exp['1'] == 'val'){
                                    //it is attr value name
                                    $attrValueId = $this->getAttr($requiredAttr,$attrId);
                                }else{
                                    //it is attr name
                                    $attrId = $this->getAttr($requiredAttr,0);
                                }

                                if($itrate == 2 && $attrId>0 && $attrValueId>0){
                                    $pAttr = new ProductAttribute();
                                    $pAttr->product_id = $proid;
                                    $pAttr->attribute_id = $attrId;
                                    $pAttr->attribute_value_id = $attrValueId;
                                    $pAttr->save();
                                    $itrate = 0;
                                    $attrId = 0;
                                    $attrValueId = 0;
                                }
                            }elseif($exp[0] == 'img'){
                                //it is image
                                $requiredAttr = end($exp);
                                $exImg  = explode("@",$requiredAttr);
                                $color = $exImg[0];
                                $images = explode(",",$exImg[1]);
                                $colorId  = $this->getColor($color);

                                if($colorId>0 && $proid>0){
                                    foreach($images as $img){
                                        $pAttr = new ProductImage();
                                        $pAttr->product_id = $proid;
                                        $pAttr->product_color_id = $colorId;
                                        $pAttr->type = 1;
                                        $pAttr->file_name = $img;
                                        $pAttr->save();
                                    }
                                }
                            }
                        }

                    }else{
                        //variation

                        $colorid = $this->getColor(trim($row[3]));
                        $sizeid = $this->getSize(trim($row[4]));

                        if($sizeid>0 && $colorid>0){
                            $pv = new ProductVariation();
                            $pv->product_id = $proid;
                            $pv->color_id = $colorid;
                            $pv->size_id = $sizeid;
                            $pv->primary_variation = (int)trim($row[2]);
                            $pv->single_price = trim($row[5]);
                            $pv->single_sales_price = trim($row[6]);
                            $pv->single_price_quantity = trim($row[7]);
                            $pv->save();

                            if($pv->primary_variation == 1 && $crosst == 1){

                                $dis = 0;
                                if($pv->single_price>$pv->single_sales_price){
                                    $dis = $pv->single_price - $pv->single_sales_price;
                                }
                                $uorder->update([
                                    'sales_price'=>$pv->single_sales_price,
                                    'mrp_price'=>$pv->single_price,
                                    'discount_type'=>2,
                                    'discount'=>$dis
                                ]);

                                $crosst++;
                            }
                        }
                    }

                    $counter++;
                }
                //die;
                return redirect(route('admin.products.import'))->with('success', 'Products are imported successfully');
            }else{
                return redirect(route('admin.products.import'))->with('error', 'File must be csv');
            }
        }else{
           return redirect(route('admin.products.import'))->with('error', 'Please upload a csv file to import');
        }
    }

    function getColor($cc){
        $dv = explode("#",$cc);
        if(isset($dv[0])  && isset($dv[1])) {
            $val = Color::where('name',$dv[0])->where('value',"#".$dv[1])->first();

            if(isset($val->id)){
                return $val->id;
            } else {
                $or = new Color();
                $or->name = $dv[0];
                $or->value = "#".$dv[1];
                $or->status = 1;
                $or->save();
                return $or->id;
            }
        } else {
            return redirect(route('admin.products.import'))->with('error', 'Either color name or color hexcode is missing');
        }
    }

    function getSize($cc){
        $dv = explode("#",$cc);
        if(isset($dv[0])  && isset($dv[1])) {
            $f = Size::where('name',$dv[0])->where('value',$dv[1])->first();
            if(isset($f->id)) {
               return $f->id;
            } else {
                $val = Size::where('name',$dv[0])->where('value',$dv[1])->first();
                if(isset($val->id)) {
                    return $val->id;
                } else {
                    $or = new Size();
                    $or->name = $dv[0];
                    $or->value = $dv[1];
                    $or->status = 1;
                    $or->save();
                    return $or->id;
                }
            }
        } else {
            return redirect(route('admin.products.import'))->with('error', 'Either siie name or size value is missing');
        }
    }

    function getAttr($name,$parent) {
        if($parent >0) {
            $val = AttributeValue::where('value',$name)->where('attribute_id',$parent)->first();
            if(isset($val->id)) {
                return $val->id;
            } else {
                $or = new AttributeValue();
                $or->value = $name;
                $or->attribute_id = $parent;
                $or->status = 1;
                $or->save();
                return $or->id;
            }
        } else {
           $val = Attribute::where('name',$name)->first();
            if(isset($val->id)){
                return $val->id;
            } else {
                $or = new Attribute();
                $or->name = $name;
                $or->status = 1;
                $or->save();
                return $or->id;
            }
        }
    }


    function getCategory($name,$type,$parent){

        $catCheck = Category::where('name',$name);

        if($parent >0) {
            $catCheck->where('parent_id',$parent);
        }

        $res = $catCheck->first();

        if(isset($res->id)) {
            return $res->id;
        } else {
            $slug = $this->getSlug($name, 'categories');
            $uorder =  new Category;
            $uorder->slug = $slug;
            $uorder->name = $name;
            $uorder->parent_id = $parent;
            $uorder->save();
            return $uorder->id;
        }
    }

}
