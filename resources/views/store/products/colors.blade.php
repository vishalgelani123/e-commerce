@php
$colors = \App\Models\Color::where('status', '1')->get();
@endphp
@if (count($colors) > 0 && $match !== null)
    @foreach ($colors as $color)
        @if ($cat_id !== 0 && $match)
            @if (in_array($color->id, $match->colors) && $match->is_color === 1)
                <li class="active">
                    @php
                        $checked = '';
                        if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                            $checked = in_array($color->id, request()->get('colors')) ? 'checked' : '';
                        }
                    @endphp
                    <input type="checkbox" class="filter color_{{ $color->id }}" id="color-{{ $color->id }}"
                        data-name="{{ $color->name }}" {{ $checked }} data-id="{{ $color->id }}"><label
                        for="color-{{ $color->id }}" style="cursor:pointer">{{ $color->name }}<span>
                            (<?php
                            
                            $data = \DB::table('product_variations')
                                ->join('products', 'products.id', 'product_variations.product_id')
                                ->where('product_variations.color_id', $color->id)
                                ->where('products.status', 1)
                                ->where('product_variations.size_status', 1)
                                ->where('product_variations.single_price_quantity', '!=', '');
                            
                            if ($cat_id !== 0) {
                                $data = $data->where(function ($query) use ($cat_id) {
                                    $query
                                        ->where('products.category_id', $cat_id)
                                        ->orWhere('products.sub_category_id', $cat_id)
                                        ->orWhere('products.sub_category_child_id', $cat_id);
                                });
                            }
                            
                            $colorcount = $data->groupBy('product_variations.product_id')->get();
                            
                            if ($colorcount) {
                                echo count($colorcount);
                            } else {
                                echo 0;
                            }
                            ?>)
                        </span></label>
                </li>
            @endif
        @else
            <li class="active">
                @php
                    $checked = '';
                    if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                        $checked = in_array($color->id, request()->get('colors')) ? 'checked' : '';
                    }
                @endphp
                <input type="checkbox" class="filter" id="color-{{ $color->id }}"
                    data-name="{{ $color->name }}" data-id="{{ $color->id }}"><label for="color-{{ $color->id }}"
                    style="cursor:pointer" {{ $checked }}>{{ $color->name }}

                    <span>(
                        <?php
                        $data = DB::table('product_variations')
                            ->join('products', 'products.id', 'product_variations.product_id')
                            ->where('product_variations.color_id', $color->id)
                            ->where('products.status', 1)
                            ->where('product_variations.size_status', 1)
                            ->where('single_price_quantity', '!=', '');
                        if (request()->get('q') != '') {
                            $products_ids = \App\Models\Product::where('name', 'LIKE', '%' . request()->get('q') . '%')->pluck('id');
                            $data = $data->whereIn('product_variations.product_id', $products_ids);
                        }
                        echo count($data->groupBy('products.id')->get());
                        ?>
                        )</span>
                </label>
            </li>
        @endif
    @endforeach
@endif
