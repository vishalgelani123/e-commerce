<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\VideoAdd;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Pincode;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Wishlist;
use App\Models\ProductReview;
use App\Models\Brand;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function index(){
        $slider = Slider::where(array('status'=>1))->get();
        $video = VideoAdd::where(array('status'=>1))->get();
        $category = Category::where(array('status'=>1,'is_home'=>1,'parent_id'=>''))->get();
        return view('web.index',compact('slider','category','video'));
    }


    public function shop(Request $request){

        $product = ProductVariation::with('product','size','color')->where(array('status'=>1));
        $product = $product->groupBy('product_id')->orderBy('single_sales_price','asc')->get();
        return view('web.products',compact('product'));
    }

    public function priceFilter(Request $request){
        $value = $request->value;
        if ($value == 'high') {
            $product = ProductVariation::with('product','size','color')->where(array('status'=>1));
            $product = $product->groupBy('product_id')->orderBy('single_sales_price','desc')->get();
            
            return view('web.append',compact('product'));
        }
         if ($value == 'low') {
            // $product = ProductVariation::with('product','size','color')->where(array('status'=>1));
            // $product = $product->groupBy('product_id')->orderBy('single_sales_price','asc')->get();

            return 'block';
        }
    }


     public function typeFilter(Request $request){
        $product_id = $request->product_id;
        $product = ProductVariation::with('product','size','color')->whereIn('product_id',$product_id);
        $product = $product->groupBy('product_id')->orderBy('single_sales_price','asc')->get();
            
        return view('web.append',compact('product'));
    }


     public function colorFilter(Request $request){
        $product_id = $request->product_id;
        $product = ProductVariation::with('product','size','color')->whereIn('color_id',$product_id);
        $product = $product->groupBy('product_id')->orderBy('single_sales_price','asc')->get();
            
        return view('web.append',compact('product'));
    }

      public function sizeFilter(Request $request){
        $product_id = $request->product_id;
        $product = ProductVariation::with('product','size','color')->whereIn('size_id',$product_id);
        $product = $product->groupBy('product_id')->orderBy('single_sales_price','asc')->get();
            
        return view('web.append',compact('product'));
    }

}
