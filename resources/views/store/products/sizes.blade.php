@php
$sizes = \App\Models\Size::where('status', '1')->get();
@endphp
@if (count($sizes) > 0 && $match !== null)
    @foreach ($sizes as $size)
        @if ($cat_id !== 0 && $match)
            @if (in_array($size->id, $match->sizes) && $match->is_size === 1)
                <li class="active">
                    @php
                        $checked = '';
                        if (!empty(request()->get('sizes')) && count(request()->get('sizes')) > 0) {
                            $checked = in_array($size->id, request()->get('sizes')) ? 'checked' : '';
                        }
                    @endphp
                    <input type="checkbox" class="filter size_{{ $size->id }}" id="size-{{ $size->id }}"
                        data-name="{{ $size->name }}" {{ $checked }} data-id="{{ $size->id }}"><label
                        for="size-{{ $size->id }}" style="cursor:pointer">{{ $size->name }}<span>
                            (<?php
                            
                            $data = \DB::table('product_variations')
                                ->join('products', 'products.id', 'product_variations.product_id')
                                ->where('product_variations.size_id', $size->id)
                                ->where('products.status', 1)
                                ->where('product_variations.size_status', 1)
                                ->where('product_variations.single_price_quantity', '!=', '');
                            if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                                $data = $data->whereIn('product_variations.color_id', request()->get('colors'));
                            }
                            if ($cat_id !== 0) {
                                $data->where(function ($query) use ($cat_id) {
                                    $query
                                        ->where('products.category_id', $cat_id)
                                        ->orWhere('products.sub_category_id', $cat_id)
                                        ->orWhere('products.sub_category_child_id', $cat_id);
                                });
                            }
                            
                            $sizecount = $data->groupBy('product_variations.product_id')->get();
                            
                            if ($sizecount) {
                                echo count($sizecount);
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
                    if (!empty(request()->get('sizes')) && count(request()->get('sizes')) > 0) {
                        $checked = in_array($size->id, request()->get('sizes')) ? 'checked' : '';
                    }
                @endphp
                <input type="checkbox" class="filter size_{{ $size->id }}" id="size-{{ $size->id }}"
                    data-name="{{ $size->name }}" data-id="{{ $size->id }}"><label for="size-{{ $size->id }}"
                    style="cursor:pointer" {{ $checked }}>{{ $size->name }}

                    <span>(
                        <?php
                        $data = DB::table('product_variations')
                            ->join('products', 'products.id', 'product_variations.product_id')
                            ->where('product_variations.size_id', $size->id)
                            ->where('products.status', 1)
                            ->where('product_variations.size_status', 1)
                            ->where('single_price_quantity', '!=', '');
                        if (request()->get('q') != '') {
                            $products_ids = \App\Models\Product::where('name', 'LIKE', '%' . request()->get('q') . '%')->pluck('id');
                            $data = $data->whereIn('product_variations.product_id', $products_ids);
                        }
                        if (!empty(request()->get('colors')) && count(request()->get('colors')) > 0) {
                            $data = $data->whereIn('product_variations.color_id', request()->get('colors'));
                        }
                        echo count($data->groupBy('products.id')->get());
                        ?>
                        )</span>
                </label>
            </li>
        @endif
    @endforeach
@endif
