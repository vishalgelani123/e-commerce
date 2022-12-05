    <div class="product-widget-type product-widget">
        <h4 class="product-widget-title">Color</h4>
        <ul class="product-widget-filter product-categories">
            @php
                $colors = \App\Models\Color::where('status', '1')->get();
            @endphp
            @if (count($colors) > 0 && $match !== null)
                @foreach ($colors as $color)
                    @if ($cat_id !== 0)
                        @if (in_array($color->id, $match->colors) && $match->is_color === 1)
                            @if ($color->name != '')
                                <li>
                                    <label class="container_category">
                                        @php
                                            $checked = '';
                                            if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                                $checked = in_array($color->id, request()->get('colors')) ? 'checked' : '';
                                            }
                                        @endphp
                                        <input class="filter color_{{ $color->id }}" id="color-{{ $color->id }}"
                                            data-name="{{ $color->id }}" data-id="{{ $color->id }}"
                                            {{ $checked }} type="checkbox">
                                        {{ $color->name }}
                                        <span class="checkmark"></span>
                                        @php
                                            $products_ids = new \App\Models\Product();
                                            $products_ids = $products_ids->leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id');
                                            
                                            $products_ids = $products_ids->where('products.status', 1);
                                            $products_ids = $products_ids->where('product_variations.size_status', 1);
                                            $products_ids = $products_ids->where('product_variations.color_id', $color->id);
                                            $products_ids = $products_ids->where('product_variations.single_price_quantity', '!=', '');
                                            // $products_ids = $products_ids->where('products.sub_category_id', $cat_id);

                                            if ($cat_id !== 0) {
                                                $products_ids = $products_ids->where(function ($query) use ($cat_id) {
                                                    $query
                                                        ->where('products.category_id', $cat_id)
                                                        ->orWhere('products.sub_category_id', $cat_id)
                                                        ->orWhere('products.sub_category_child_id', $cat_id);
                                                });
                                            }
                                            
                                            $products_ids = $products_ids->groupBy('products.id');
                                            $products_ids = $products_ids->get();
                                            
                                            $attribute_count = $products_ids->count();
                                            
                                        @endphp
                                        ({{ $attribute_count }})
                                    </label>
                                </li>
                            @endif
                        @endif
                    @else
                        @if ($color->name != '')
                            <li>
                                <label class="container_category">
                                    @php
                                        $checked = '';
                                        if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                            $checked = in_array($color->id, request()->get('colors')) ? 'checked' : '';
                                        }
                                    @endphp
                                    <input class="filter color_{{ $color->id }}" id="color-{{ $color->id }}"
                                        data-name="{{ $color->id }}" data-id="{{ $color->id }}"
                                        {{ $checked }} type="checkbox">
                                    {{ $color->name }}
                                    <span class="checkmark"></span>
                                    @php
                                        $data = DB::table('product_variations')
                                            ->join('products', 'products.id', 'product_variations.product_id')
                                            ->where('product_variations.size_status', 1)
                                            ->where('product_variations.color_id', $color->id);
                                        if ($request->search != '') {
                                            $products_ids = \App\Models\Product::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id');
                                            $data = $data->whereIn('product_variations.product_id', $products_ids);
                                        }
                                        $data = $data->where('products.status', 1)->where('single_price_quantity', '!=', '');
                                        
                                        $attribute_count = count($data->groupBy('products.id')->get());
                                        
                                    @endphp
                                    ({{ $attribute_count }})
                                </label>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    </div>

    <div class="product-widget-type product-widget">
        <h4 class="product-widget-title">Size</h4>
        <ul class="product-widget-filter product-categories">
            @php
                $sizes = \App\Models\Size::where('status', '1')->get();
            @endphp
            @if (count($sizes) > 0 && $match !== null)
                @foreach ($sizes as $size)
                    @if ($cat_id !== 0)
                        @if (in_array($size->id, $match->sizes) && $match->is_size === 1)
                            @if ($size->name != '')
                                <li>
                                    <label class="container_category">
                                        @php
                                            $checked = '';
                                            if (!empty(request()->get('sizes')) && count(request()->get('sizes')) > 0) {
                                                $checked = in_array($size->id, request()->get('sizes')) ? 'checked' : '';
                                            }
                                        @endphp
                                        <input class="filter size_{{ $size->id }}" id="size-{{ $size->id }}"
                                            data-name="{{ $size->id }}" data-id="{{ $size->id }}"
                                            {{ $checked }} type="checkbox">
                                        {{ $size->name }}
                                        <span class="checkmark"></span>
                                        @php
                                            $products_ids = new \App\Models\Product();
                                            $products_ids = $products_ids->leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id');
                                            
                                            $products_ids = $products_ids->where('products.status', 1);
                                            $products_ids = $products_ids->where('product_variations.size_status', 1);
                                            $products_ids = $products_ids->where('product_variations.size_id', $size->id);
                                            $products_ids = $products_ids->where('product_variations.single_price_quantity', '!=', '');
                                            if ($cat_id !== 0) {
                                                $products_ids = $products_ids->where(function ($query) use ($cat_id) {
                                                    $query
                                                        ->where('products.category_id', $cat_id)
                                                        ->orWhere('products.sub_category_id', $cat_id)
                                                        ->orWhere('products.sub_category_child_id', $cat_id);
                                                });
                                            }
                                            if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                                $products_ids = $products_ids->whereIn('product_variations.color_id', request()->get('colors'));
                                            }
                                            $products_ids = $products_ids->groupBy('products.id');
                                            $products_ids = $products_ids->get();
                                            
                                            $attribute_count = $products_ids->count();
                                            
                                        @endphp
                                        ({{ $attribute_count }})
                                    </label>
                                </li>
                            @endif
                        @endif
                    @else
                        @if ($size->name != '')
                            <li>
                                <label class="container_category">
                                    @php
                                        $checked = '';
                                        if (!empty(request()->get('sizes')) && count(request()->get('sizes')) > 0) {
                                            $checked = in_array($size->id, request()->get('sizes')) ? 'checked' : '';
                                        }
                                    @endphp
                                    <input class="filter size_{{ $size->id }}" id="size-{{ $size->id }}"
                                        data-name="{{ $size->id }}" data-id="{{ $size->id }}"
                                        {{ $checked }} type="checkbox">
                                    {{ $size->name }}
                                    <span class="checkmark"></span>
                                    @php
                                        $data = DB::table('product_variations')
                                            ->join('products', 'products.id', 'product_variations.product_id')
                                            ->where('product_variations.size_status', 1)
                                            ->where('product_variations.size_id', $size->id);
                                        if ($request->search != '') {
                                            $products_ids = \App\Models\Product::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id');
                                            $data = $data->whereIn('product_variations.product_id', $products_ids);
                                        }
                                        if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                            $data = $data->whereIn('product_variations.color_id', request()->get('colors'));
                                        }
                                        $data = $data->where('products.status', 1)->where('single_price_quantity', '!=', '');
                                        
                                        $attribute_count = count($data->groupBy('products.id')->get());
                                        
                                    @endphp
                                    ({{ $attribute_count }})
                                </label>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    </div>

    @foreach ($selectedaatrs as $daatr)
        <div class="product-widget-type product-widget">
            <h4 class="product-widget-title">{{ $daatr->name }}</h4>
            <ul class="product-widget-filter product-categories">
                @if ($daatr->attribute_values)
                    @foreach ($daatr->attribute_values as $value)
                        @if ($value->value != '')
                            <li>
                                <label class="container_category">
                                    @php
                                        $checked = '';
                                        if (!empty(request()->get('attributes')) && count(request()->get('attributes')) > 0) {
                                            $checked = in_array($value->id, request()->get('attributes')) ? 'checked' : '';
                                        }
                                    @endphp
                                    <input class="filter" id="attribute-{{ $daatr->id }}"
                                        data-name="{{ $daatr->id }}" data-id="{{ $value->id }}"
                                        {{ $checked }} type="checkbox">
                                    {{ $value->value }}
                                    <span class="checkmark"></span>
                                    @php
                                        $products_ids = new \App\Models\Product();
                                        $products_ids = $products_ids->leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id');
                                        
                                        if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                            $products_ids = $products_ids->whereIn('product_variations.color_id', request()->get('colors'));
                                        }
                                        if (!empty(request()->get('sizes')) && count(request()->get('sizes')) > 0) {
                                            $products_ids = $products_ids->whereIn('product_variations.size_id', request()->get('sizes'));
                                        }
                                        
                                        $above = request()->get('min_price');
                                        $below = request()->get('max_price');
                                        
                                        if ($above !== 'no' && $below !== 'no') {
                                            $products_ids = $products_ids->whereBetween('product_variations.single_sales_price', [$above, $below]);
                                        } elseif ($above !== 'no' && $below === 'no') {
                                            $products_ids = $products_ids->where('product_variations.single_sales_price', '>', $above);
                                        } elseif ($above === 'no' && $below !== 'no') {
                                            $products_ids = $products_ids->where('product_variations.single_sales_price', '<', $below);
                                        }
                                        $products_ids = $products_ids->where('products.status', 1);
                                        
                                        $products_ids = $products_ids->where('product_variations.size_status', 1);
                                        if ($cat_id !== 0) {
                                            $products_ids = $products_ids->where(function ($query) use ($cat_id) {
                                                $query
                                                    ->where('products.category_id', $cat_id)
                                                    ->orWhere('products.sub_category_id', $cat_id)
                                                    ->orWhere('products.sub_category_child_id', $cat_id);
                                            });
                                        }
                                        $products_ids = $products_ids->groupBy('products.id');
                                        // $products_ids = $products_ids->get();
                                        $products_ids = $products_ids->pluck('products.id');
                                        
                                        $attribute_count = \App\Models\ProductAttribute::whereIn('product_id', $products_ids)
                                            ->where('attribute_value_id', $value->id)
                                            ->count();
                                    @endphp
                                    ({{ $attribute_count }})
                                </label>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    @endforeach
