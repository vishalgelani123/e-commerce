<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\UserOrder;
use App\Models\Payment;
use App\Models\Size;
use App\Models\Product;
use App\Models\Category;


class ReportController extends Controller
{


    public function sales(Request $request)
    {
        // abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = UserOrder::where('status',3)->get();
            $table = Datatables::of($query);

            $table->editColumn('order_id', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->order_id.'</span></div>';
            });

            $table->editColumn('name', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->users->name.'</span></div>';
            });

            $table->editColumn('address', function ($row) {
                return '<div class="text-center">'.$row->address.'</div>';
            });

            $table->editColumn('product', function ($row) {
              $count = 0;
                foreach($row->orders as $order){
                  if($count === 0){
                    return '<div class="text-center"><span class="badge badge-dark p-2">'.$order->name.'</span></div>';
                  }
                  $count++;
                }
            });

            $table->editColumn('amount', function ($row) {
              return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->total_amount.'</span></div>';
            });

            $table->editColumn('created', function ($row) {
              return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
            });


            $table->editColumn('image', function ($row) {
              $count = 0;
                foreach($row->orders as $order){
                  if($count === 0){
                    return '<div class="text-center">
                    <img onerror="handleError(this);"src="'.asset("file/$order->images").'" style="width : 70px;" />
                    </div>';
                  }
                  $count++;
                }
            });


            $table->rawColumns(['order_id','name','address','image','product','amount','created']);

            return $table->make(true);
        }

        return view('admin.reports.sales');
    }

    public function orders(Request $request)
    {
      // abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      if ($request->ajax()) {
          $query = new UserOrder;
          $query = $query->leftJoin("users", "users.id", "=", "user_orders.user_id")
          ->select("user_orders.*")
          ->whereNull("users.customer_type_id");
          if($request->start_date != ""){
            $start_date = date("Y-m-d", strtotime($request->start_date)).' 00:00:00';
            $query = $query->where("user_orders.created_at", ">=", $start_date);
          }
          if($request->end_date != ""){
              $end_date = date("Y-m-d", strtotime($request->end_date)).' 23:59:59';
              $query = $query->where("user_orders.created_at", "<=", $end_date);
          }
          if($request->status != ""){
              $query = $query->where("user_orders.status", $request->status);
          }
          
          $query = $query->get();
          $table = Datatables::of($query);

          $table->editColumn('order_id', function ($row) {
              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->order_id.'</span></div>';
          });

          $table->editColumn('name', function ($row) {
            $name = $row->users ? $row->users->name : "";
              return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
          });

          $table->editColumn('address', function ($row) {
              return '<div class="text-center">'.$row->address.'</div>';
          });

          $table->editColumn('product', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  return '<div class="text-center"><span class="badge badge-dark p-2">'.$order->name.'</span></div>';
                }
                $count++;
              }
          });

          $table->addColumn('sku_code', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  $sku_code = $order->product ? $order->product->sku_code : "";
                  return '<div class="text-center"><span class="badge badge-dark p-2">'.$sku_code.'</span></div>';
                }
                $count++;
              }
          });
          $table->addColumn('size', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  $size = $order->size ? $order->size->name : "";
                  return '<div class="text-center"><span class="badge badge-dark p-2">'.$size.'</span></div>';
                }
                $count++;
              }
          });

          $table->editColumn('amount', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->total_amount.'</span></div>';
          });

          $table->editColumn('created', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
          });

          $table->editColumn('image', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  return '<div class="text-center">
                   <img onerror="handleError(this);"src="'.asset("file/$order->images").'" style="width : 70px;" />
                  </div>';
                }
                $count++;
              }
          });

          $table->editColumn('status', function ($row) {
            $html = '<div class="text-center">';
            if($row->status === 0){
              $html .= '<span  class="badge badge-secondary p-2">Confirmed</span>';
            }
            if($row->status === 1){
              $html .= '<span  class="badge badge-warning p-2">Proccessed</span>';
            }
            if($row->status === 2){
              $html .= '<span  class="badge badge-primary p-2">Shipped</span>';
            }
            if($row->status === 3){
              $html .= '<span  class="badge badge-success p-2">Completed</span>';
            }
            if($row->status === 4){
              $html .= '<span  class="badge badge-danger p-2">Refunded</span>';
            }

            $html .= '</div>';

            return $html;
          });

          $table->rawColumns(['order_id','name','address','image','product','amount','created','status','sku_code','size']);

          return $table->make(true);
      }

      return view('admin.reports.orders');
    }

    public function wholesale_orders(Request $request){
      if ($request->ajax()) {
        $query = new UserOrder;
        $query = $query->leftJoin("users", "users.id", "=", "user_orders.user_id")
        ->select("user_orders.*")
        ->whereNotNull("users.customer_type_id");
        if($request->start_date != ""){
          $start_date = date("Y-m-d", strtotime($request->start_date)).' 00:00:00';
          $query = $query->where("user_orders.created_at", ">=", $start_date);
        }
        if($request->end_date != ""){
            $end_date = date("Y-m-d", strtotime($request->end_date)).' 23:59:59';
            $query = $query->where("user_orders.created_at", "<=", $end_date);
        }
        if($request->status != ""){
          $query = $query->where("user_orders.status", $request->status);
        }

        $query = $query->get();
        $table = Datatables::of($query);

        $table->editColumn('order_id', function ($row) {
            return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->order_id.'</span></div>';
        });

        $table->editColumn('name', function ($row) {
          $name = $row->users ? $row->users->name : "";
          return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
        });

        $table->editColumn('address', function ($row) {
            return '<div class="text-center">'.$row->address.'</div>';
        });

        $table->editColumn('product', function ($row) {
          $count = 0;
            foreach($row->orders as $order){
              if($count === 0){
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$order->name.'</span></div>';
              }
              $count++;
            }
        });

        $table->addColumn('sku_code', function ($row) {
          $count = 0;
            foreach($row->orders as $order){
              if($count === 0){
                $sku_code = $order->product ? $order->product->sku_code : "";
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$sku_code.'</span></div>';
              }
              $count++;
            }
        });

        $table->addColumn('size', function ($row) {
          $count = 0;
            foreach($row->orders as $order){
              if($count === 0){
                $size_ids = explode(",", $order->sizes);

                $sizes = Size::whereIn("id", $size_ids)->get();

                $size = "";
                if(count($sizes) > 0){
                  foreach($sizes as $item){
                    if($size != ""){
                      $size = $size .",". $item->name;
                    } else {
                      $size = $item->name;
                    }
                  }
                }
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$size.'</span></div>';
              }
              $count++;
            }
        });

        $table->editColumn('amount', function ($row) {
          return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->total_amount.'</span></div>';
        });

        $table->editColumn('created', function ($row) {
          return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
        });

        $table->editColumn('image', function ($row) {
          $count = 0;
            foreach($row->orders as $order){
              if($count === 0){
                return '<div class="text-center">
                 <img onerror="handleError(this);"src="'.asset("file/$order->images").'" style="width : 70px;" />
                </div>';
              }
              $count++;
            }
        });

        $table->editColumn('status', function ($row) {
          $html = '<div class="text-center">';
          if($row->status === 0){
            $html .= '<span  class="badge badge-secondary p-2">Confirmed</span>';
          }
          if($row->status === 1){
            $html .= '<span  class="badge badge-warning p-2">Proccessed</span>';
          }
          if($row->status === 2){
            $html .= '<span  class="badge badge-primary p-2">Shipped</span>';
          }
          if($row->status === 3){
            $html .= '<span  class="badge badge-success p-2">Completed</span>';
          }
          if($row->status === 4){
            $html .= '<span  class="badge badge-danger p-2">Refunded</span>';
          }

          $html .= '</div>';

          return $html;
        });

        $table->rawColumns(['order_id','name','address','image','product','amount','created','status','sku_code','size']);

        return $table->make(true);
    }

    return view('admin.reports.wholesale_orders');
    }

    public function payments(Request $request)
    {

      if ($request->ajax()) {
          $query = Payment::all();
          $table = Datatables::of($query);


          $table->editColumn('order_id', function ($row) {
              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->orders->order_id.'</span></div>';
          });

          $table->editColumn('name', function ($row) {

              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->users->name.'</span></div>';
          });

          $table->editColumn('product', function ($row) {
              $orders = UserOrder::find($row->order_id);
              $count = 0;
              $html = '<div class="text-center">';
              foreach($orders->orders as $order){
                if($count === 0){
                    $html .= '<span class="badge badge-primary p-2">'.$order->name.'</span>';
                }
                $count ++;

              }
              $html .= '</div>';
              return $html;
          });

          $table->editColumn('image', function ($row) {
              $orders = UserOrder::find($row->order_id);
              $count = 0;
              $html = '<div class="text-center">';
              foreach($orders->orders as $order){
                if($count === 0){
                    $html .= '<img onerror="handleError(this);"style="width : 100px;" src="'.asset("file/$order->images").'">';
                }
                $count ++;
              }
              $html .= '</div>';
              return $html;
          });

          // $table->editColumn('transaction_id', function ($row) {
          //       return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->transaction_id.'</span></div>';
          // });



          $table->editColumn('amount', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->amount.'</span></div>';
          });

          $table->editColumn('created', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
          });

          $table->rawColumns(['order_id','name','image','product','amount','created','status','transaction_id']);
         return $table->make(true);
    }


    return view('admin.reports.orders');

  }

  public function products(Request $request){
    if ($request->ajax()) {

      $query = new Product;
      $query = $query->with(['category', 'sub_category', 'user', 'brand']);
      $query = $query->whereNull('products.deleted_at');
      if($request->cat_id != ""){
        $query = $query->where('products.category_id', $request->cat_id);
      }
      if($request->scat_id != ""){
        $query = $query->where('products.sub_category_id', $request->scat_id);
      }
      $query = $query->select(sprintf('%s.*', (new Product())->table))->orderBy('products.id','desc');

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
        if($categoryname){
          $categoryname = $categoryname['name'];
        }else{
          $categoryname = '';
        }
        
        $subcategoryname =  Category::where('id',$row->sub_category_id)->select('name', 'id')->first();
        if($subcategoryname){
          $subcategoryname = $subcategoryname['name'];
        }else{
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

      /*$table->addColumn('category_name', function ($row) {
          $name =  $row->sub_category ? $row->sub_category->name : '';
          return '<div class="text-center"><span class="badge badge-primary p-2">'.$name.'</span></div>';
      });*/

      $table->editColumn('name', function ($row) {
          $name =  $row->name ? $row->name : '';
          return '<div class=""><span class="badge badge-secondary p-2">'.$name.'</span></div>';
      });

      $table->editColumn('sku_code', function ($row) {
          $sku =  $row->sku_code ? $row->sku_code : '';
          return '<div class="text-center"><span class="badge badge-secondary p-2">'.$sku.'</span></div>';
      });

      $table->addColumn('brand_name', function ($row) {
          $brand =  $row->brand ? $row->brand->name : '';
          return '<div class="text-center"><span class="badge badge-primary p-2">'.$brand.'</span></div>';
      });

      // $table->editColumn('mrp_price', function ($row) {
      //     $mrp = DB::table('product_variations')->where('product_id', $row->id)->first();
      //     $mrp =  $mrp->single_price ? $mrp->single_price : '';
      //     return '<div class="text-center"><span class="badge badge-warning p-2">'.$mrp.'</span></div>';
      // });

      // $table->editColumn('sales_price', function ($row) {
      //     $mrp = DB::table('product_variations')->where('product_id', $row->id)->first();
      //     return '<div class="text-center"><span class="badge badge-warning p-2">'.$mrp->single_sales_price.'</span></div>';
      // });

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
          return $status;
      });

      $table->rawColumns(['placeholder', 'category', 'sub_category', 'brand', 'front_image']);
      $table->rawColumns(['actions', 'placeholder', 'category', 'sub_category', 'brand', 'front_image','category_name','name','brand_name','sku_code','mrp_price','sales_price','in_stock','has_varient','view_count','status','id']);

      return $table->make(true);
    }

    $categories = Category::where(['parent_id' => 0])
            ->orderby('id', 'desc')
            ->whereNull('deleted_at')
            ->get();

    return view('admin.reports.products', compact('categories'));
  }

}
