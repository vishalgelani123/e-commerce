<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\ProductVariation;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;



class ProductImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
      return 2;
    }
    public function model(array $row)
    {

        if($row[0] == "product"){
          $category_id = 0;
          $sub_category_id = 0;
          $sub_category_child_id = 0;
  
          $category = Category::where("name", trim($row[2]))->first();
          if(!empty($category)){
            $category_id = $category->id;
  
            $sub_category = Category::where("name", trim($row[3]))->first();
            if(!empty($sub_category)){
              $sub_category_id = $sub_category->id;
              $sub_category_child = Category::where("name", trim($row[4]))->first();
              if(!empty($sub_category_child)){
                $sub_category_child_id = $sub_category_child->id;
              }
            }
          }

          $product = new Product;
          $product->user_id = 1;
          $product->name = $row[1];
          $product->category_id = $category_id;
          $product->sub_category_id = $sub_category_id;
          $product->sub_category_child_id = $sub_category_child_id;
          $product->size_chart = $row[5];
          $product->hsn_code = $row[6];
          $product->tax_rate = $row[7];
          $product->weight = $row[8];
          $product->discount_type = $row[9];
          $product->discount = $row[10];
          $product->is_exclusive = $row[11];
          $product->is_featured = $row[12];
          $product->is_sho_by_look = $row[13];
          $product->is_new = $row[14];
          $product->status = $row[15];
          $product->care = $row[16];
          $product->details = $row[17];
          $product->description = $row[18];
          $product->need_help = $row[19];
          $product->sku_code = $row[20];
          $product->in_stock = 1;
          $product->slug = create_slug($row[1]);
          $product->is_bulk = 0;

          $product->save();

          session()->put("product_id", $product->id);
        }
        if($row[0] == "attribute"){
          $Attribute_id = Attribute::where("name", trim($row[1]))->first();
            
          $AttributeValue_id = AttributeValue::where("value", $row[2])->first();
          $attr = new ProductAttribute;
          $attr->product_id = session()->get('product_id');
          $attr->attribute_id = $Attribute_id->id;
          $attr->attribute_value_id = $AttributeValue_id->id;
          $attr->status = 1;
          $attr->save();
        }
        
        if($row[0] == "gallery"){
          $Color = Color::where("name", $row[2])->first();
          $imagepath            = $row[1];
          $path               = 'file/';
          $upload             = 'file/';
            ProductImage::create([
                'type' => 1,
                'file_name' => $imagepath,
                'product_id' =>session()->get('product_id'),
                'product_color_id'=>$Color->id
            ]);
        }

        if($row[0] == "variation") {
          
          $product = Product::where("id", session()->get('product_id'))->first();
          $Size = Size::where("name", $row[1])->first();
          $Color = Color::where("name", $row[8])->first();

          if ($product->discount_type == 1) {
            $sales_single_price= $row[3]-($product->discount/100)*$row[3];
            if ($row[7] != "") {
                $product->update([
                    'sales_price'=>$sales_single_price,
                    'mrp_price'=>$row[3]
                  ]);
            }
          } else {
            $sales_single_price=$row[3]-$product->discount;
            if ($row[7] != "") {
                $product->update([
                    'sales_price'=>$sales_single_price,
                    'mrp_price'=>$row[3]
                  ]);
            }
          }
        
          $ProductVariation = [
            'color_id' => $Color->id,
            'size_id' => $Size->id,
            'single_sku' => $row[2],
            'single_price' => $row[3],
            'single_sales_price' => $sales_single_price,
            'single_price_quantity' => $row[4],
            'size_status' => $row[7] ? $row[7] : "",
            'product_id' => session()->get('product_id'),
            'status' => 1,
            'primary_variation'=> $row[9] != "" ? $row[9] : 0
          ];
          ProductVariation::create($ProductVariation);
        }

      return ;
    }
}