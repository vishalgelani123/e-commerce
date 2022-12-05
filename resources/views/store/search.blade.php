@include('frontend-view.includes.header')
<style>
    .colour-colorDisplay {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 3px;
        border: 1px solid #cccccc;
        margin-left: 7px;
    }

    .scrollable-menu {
        height: auto;
        max-height: 300px;
        overflow-x: hidden;
    }

</style>
<!--=====================================================
                           Header Section End
        =========================================================-->
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
            <div class="container-custom">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{ url('/') }}" rel="home"><span
                                        itemprop="name">Home</span></a></li>
                            <li class="breadcrumb-item trail-end"><span itemprop="name">Products</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="container-custom">
            <div class="page-header text-center">
                <h1 class="page-title"><?php echo $title; ?></h1>
            </div>
            <!--  <div class="product-banner-image">-->
            <!--    <img onerror="handleError(this);"src="images/banner-cat.jpg" alt="">-->
            <!--</div>-->
            <div class="product-cat-page">
                <div class="content-box">
                    <div class="product-sortby-filter">
                        <div class="filters">
                            <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Category</button>
                                <div class="filter-dropdown-menu dropdown-menu scrollable-menu">
                                    <ul class="layer-filter category-filter">
                                        @if ($categories->count() > 0 && $catid === 0)
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ url('/') }}/{{ $category->slug }}">
                                                        <span class="label_txt">{{ $category->name }}</span>
                                                        <span class="count_txt">
                                                            {{-- (<?php
                                                            $catcount = \App\Models\Product::where('category_id', $category->id)->get();
                                                            if ($catcount) {
                                                                echo $catcount->count();
                                                            } else {
                                                                echo 0;
                                                            }
                                                            ?>) --}}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            @foreach ($allcategories as $all)
                                                @if ($all->parent_id === $catid)
                                                    <?php
                                                    $products_ids = new \App\Models\Product();
                                                    $products_ids = $products_ids->leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id');
                                                    
                                                    $products_ids = $products_ids->where('products.status', 1);
                                                    $products_ids = $products_ids->where('product_variations.size_status', 1);
                                                    $cat_id = $all->id;
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
                                                    
                                                    // $catcount = \App\Models\Product::where('sub_category_id', $all->id)
                                                    //     ->orWhere('sub_category_child_id', $all->id)
                                                    //     ->get();
                                                    if ($attribute_count) { 
                                                    ?>
                                                         <li>
                                                            <a href="{{ url('/') }}/{{ $all->slug }}">
                                                                <span class="label_txt">{{ $all->name }}</span>
                                                                <span class="count_txt">
                                                                    ({{ $attribute_count }})
                                                                </span>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Color</button>
                                <div class="filter-dropdown-menu dropdown-menu scrollable-menu">
                                    <ul class="layer-filter color-filter product_attributes_colors">
                                        @if ($colors->count() > 0 && $match !== null)
                                            @if ($match !== null)
                                                @foreach ($colors as $scolor)
                                                    <?php
                                                    //echo $scolor->id."<br>";
                                                    ?>
                                                    @if ($catid !== 0)
                                                        @if (in_array($scolor->id, $match->colors) && $match->is_color === 1)
                                                            <li class="active">
                                                                <input type="checkbox"
                                                                    class="filter color_{{ $scolor->id }}"
                                                                    id="color-{{ $scolor->id }}"
                                                                    data-name="{{ $scolor->name }}"
                                                                    data-id="{{ $scolor->id }}">
                                                                <span data-colorhex="{{ $scolor->value }}"
                                                                    class="colour-label colour-colorDisplay"
                                                                    style="background-color: {{ $scolor->value }};"></span>
                                                                <label for="color-{{ $scolor->id }}"
                                                                    style="cursor:pointer">{{ $scolor->name }}
                                                                    <span>(
                                                                        <?php
                                                                        $data = DB::table('product_variations')
                                                                            ->join('products', 'products.id', 'product_variations.product_id')
                                                                            ->where('product_variations.color_id', $scolor->id)
                                                                            ->where('products.status', 1)
                                                                            ->where('product_variations.size_status', 1)
                                                                            ->where('single_price_quantity', '!=', '');
                                                                        $category = \App\Models\Category::where('slug', $categorysearch)->first();
                                                                        if ($catid !== 0) {
                                                                            $data->where(function ($query) use ($category) {
                                                                                $query
                                                                                    ->where('products.category_id', $category->id)
                                                                                    ->orWhere('products.sub_category_id', $category->id)
                                                                                    ->orWhere('products.sub_category_child_id', $category->id);
                                                                            });
                                                                        }
                                                                        echo count($data->groupBy('products.id')->get());
                                                                        ?>
                                                                        )</span>
                                                                </label>
                                                                <!-- <input class="color-option" name="color" value="" style="background: #000000;" type="button">
                                            <label for=""> Black (8) </label> -->
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li class="active">
                                                            <input type="checkbox"
                                                                class="filter color_{{ $scolor->id }}"
                                                                id="color-{{ $scolor->id }}"
                                                                data-name="{{ $scolor->name }}"
                                                                data-id="{{ $scolor->id }}">
                                                            <span data-colorhex="{{ $scolor->value }}"
                                                                class="colour-label colour-colorDisplay"
                                                                style="background-color: {{ $scolor->value }};"></span>
                                                            <label for="color-{{ $scolor->id }}"
                                                                style="cursor:pointer">{{ $scolor->name }}
                                                                <span>(
                                                                    <?php
                                                                    $data = DB::table('product_variations')
                                                                        ->join('products', 'products.id', 'product_variations.product_id')
                                                                        ->where('product_variations.color_id', $scolor->id)
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
                                                            <!-- <input class="color-option" name="color" value="" style="background: #000000;" type="button">
                                            <label for=""> Black (8) </label> -->
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Size</button>
                                <div class="filter-dropdown-menu dropdown-menu scrollable-menu">
                                    <ul class="layer-filter color-filter product_attributes_sizes">
                                        @if ($sizes->count() > 0)
                                            @foreach ($sizes as $size)
                                                @if ($catid !== 0 && $match)
                                                    @if (in_array($size->id, $match->sizes) && $match->is_size === 1)
                                                        <li class="active">
                                                            <input type="checkbox"
                                                                class="filter size_{{ $size->id }}"
                                                                id="size-{{ $size->id }}"
                                                                data-name="{{ $size->name }}"
                                                                data-id="{{ $size->id }}"><label
                                                                for="size-{{ $size->id }}"
                                                                style="cursor:pointer">{{ $size->name }}<span>
                                                                    (<?php
                                                                    
                                                                    $data = \DB::table('product_variations')
                                                                        ->join('products', 'products.id', 'product_variations.product_id')
                                                                        ->where('product_variations.size_id', $size->id)
                                                                        ->where('products.status', 1)
                                                                        ->where('product_variations.size_status', 1)
                                                                        ->where('product_variations.single_price_quantity', '!=', '');
                                                                    
                                                                    if ($catid !== 0) {
                                                                        $data->where(function ($query) use ($catid) {
                                                                            $query
                                                                                ->where('products.category_id', $catid)
                                                                                ->orWhere('products.sub_category_id', $catid)
                                                                                ->orWhere('products.sub_category_child_id', $catid);
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
                                                        <input type="checkbox" class="filter size_{{ $size->id }}"
                                                            id="size-{{ $size->id }}"
                                                            data-name="{{ $size->name }}"
                                                            data-id="{{ $size->id }}"><label
                                                            for="size-{{ $size->id }}"
                                                            style="cursor:pointer">{{ $size->name }}

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
                                                                echo count($data->groupBy('products.id')->get());
                                                                ?>
                                                                )</span>
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Price</button>
                                <div class="filter-dropdown-menu dropdown-menu">
                                    <ul class="layer-filter color-filter">
                                        <li class="active">
                                            <input class="type-option" name="type" value="" type="checkbox">
                                            <label for=""> All</label>
                                        </li>
                                        <li>
                                            <input class="type-option" name="type" value="" type="checkbox">
                                            <label for=""> 1-500</label>
                                        </li>
                                        <li>
                                            <input class="type-option" name="type" value="" type="checkbox">
                                            <label for=""> 500-1000</label>
                                        </li>
                                        <li>
                                            <input class="type-option" name="type" value="" type="checkbox">
                                            <label for=""> 1001-2000</label>
                                        </li>
                                        <li>
                                            <input class="type-option" name="type" value="" type="checkbox">
                                            <label for=""> Above 2000</label>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="filter-toggle">
                                <div class="showall-filter">
                                    <button class="filter-open"><i class="fas fa-sliders-h"></i> More Filter
                                    </button>
                                    <button class="filter-hide d-none"><i class="fas fa-sliders-h"></i> Hide Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="sortby">
                            <p class="product-count"><span class="product_counts">0</span> Items</p>
                            <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Sort
                                    By</button>
                                <div class="filter-dropdown-menu dropdown-menu">
                                    <ul class="layer-filter sort-filter">
                                        <li>
                                            <input name="orderby" id="popularity" value="cs" type="radio">
                                            <label for="popularity"> Popularity </label>
                                        </li>
                                        <!-- <li>
                                            <input name="orderby" id="date" value="" type="radio">
                                            <label for="date"> Latest </label>
                                        </li> -->
                                        <li>
                                            <input name="orderby" id="price" value="pasc" type="radio">
                                            <label for="price"> Price: low to high </label>
                                        </li>
                                        <li>
                                            <input name="orderby" id="price-desc" value="pdesc" type="radio">
                                            <label for="price-desc"> Price: high to low </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-display-mode">
                                <div class="view_grid">
                                    <button type="button" value="2" id="grid2"><span></span><span></span></button>

                                    <button type="button" value="3"
                                        class="grid3"><span></span><span></span><span></span></button>

                                    <button type="button" value="4"
                                        class="grid4 active"><span></span><span></span><span></span><span></span></button>

                                    <button type="button" value="5"
                                        class="grid5 "><span></span><span></span><span></span><span></span><span></span></button>

                                </div>
                                <!--<span id="grid_large" class="active"><a href="javascript:void(0);"
                                        title="4 Column"><i class="fas fa-th"></i></a></span>
                                <span id="grid"><a href="javascript:void(0);" title="3 Column"><i
                                            class="fas fa-th-large"></i></a></span>-->
                            </div>
                        </div>
                    </div>
                    <!-- product-sortby-filter -->
                    <div class="row flex-row-reverse">
                        <div class="content-area col product_list_page">

                            <!-- <div class="pagination">
                                <ul class="page-numbers">
                                  <li><a class="prev page-numbers" href="#">←</a></li>
                                  <li><a class="page-numbers" href="#">1</a></li>
                                  <li><span aria-current="page" class="page-numbers current">2</span></li>
                                  <li><a class="page-numbers" href="#">3</a></li>
                                  <li><a class="next page-numbers" href="#">→</a></li>
                              </ul>
                            </div> -->
                        </div>
                        <!--content-area-->
                        <div class="filter-sidebar product-sidebar-area">
                            <h3 class="filter-sidebar-heading">
                                Filter By
                                <span class="filter-sidebar-close"><i class="fas fa-times"></i></span>
                            </h3>
                            <div class="product-widget-type product-widget open">
                                <h4 class="product-widget-title open">Category </h4>
                                <ul class="product-widget-filter product-categories">
                                    @if ($categories->count() > 0 && $catid === 0)
                                        @foreach ($categories as $category)
                                            <li><a href="{{ url('/') }}/{{ $category->slug }}">{{ $category->name }}
                                                    <?php
                                                    // $catcount = \App\Models\Product::where('sub_category_id', $all->id)->orWhere('sub_category_child_id', $all->id)->get();
                                                    // if($catcount){
                                                    //     echo $catcount->count();
                                                    // }
                                                    // else{
                                                    //     echo 0;
                                                    // }
                                                    ?>
                                                </a></li>
                                        @endforeach
                                    @else
                                        @foreach ($allcategories as $all)
                                            @if ($all->parent_id === $catid)
                                            <?php
                                                        $products_ids = new \App\Models\Product();
                                                        $products_ids = $products_ids->leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id');
                                                        
                                                        $products_ids = $products_ids->where('products.status', 1);
                                                        $products_ids = $products_ids->where('product_variations.size_status', 1);
                                                        $cat_id = $all->id;
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
                                                        
                                                        // $catcount = \App\Models\Product::where('sub_category_id', $all->id)
                                                        //     ->orWhere('sub_category_child_id', $all->id)
                                                        //     ->get();
                                                        if ($attribute_count) {
                                                        ?>
                                                        <li><a href="{{ url('/') }}/{{ $all->slug }}">{{ $all->name }}
                                                            ({{ $attribute_count }})
                                                        </a></li>
                                                        <?php
                                                        }
                                                        ?>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="product-widget-type product-widget open">
                                <h4 class="product-widget-title open">Price </h4>
                                <div class="product-widget-filter price-filter">
                                    <div id="slider-range"></div>
                                    <div class="price-range">
                                        <label for="amount">Range:</label>
                                        <input type="text" id="amount" readonly>
                                        <input type="hidden" id="above-price" oninput="validity.valid||(value='0');"
                                            class="form-control">
                                        <input type="hidden" id="below-price" oninput="validity.valid||(value='1000');"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="product_attributes_filter">

                                @if ($attributes->count() > 0)

                                    @if ($catid !== 0)
                                        @if ($attributes->count() > 0)
                                            <?php $matches = \App\Models\MapAttribute::where('category_id', 'like', '%' . $catid)
                                                ->orWhere('sub_category_id', 'like', '%' . $catid)
                                                ->orWhere('sub_category_child_id', 'like', '%' . $catid)
                                                ->first(); ?>
                                            @foreach ($selectedaatrs as $daatr)
                                                <div class="product-widget-type product-widget">
                                                    <h4 class="product-widget-title">{{ $daatr->name }}</h4>
                                                    <ul class="product-widget-filter product-categories">
                                                        @if ($daatr->attribute_values)
                                                            @foreach ($daatr->attribute_values as $value)
                                                                @if ($value->value != '')
                                                                    <li>
                                                                        <label class="container_category">
                                                                            <input class="filter"
                                                                                id="attribute-{{ $daatr->id }}"
                                                                                data-name="{{ $daatr->id }}"
                                                                                data-id="{{ $value->id }}"
                                                                                type="checkbox"> {{ $value->value }}
                                                                            <span class="checkmark"></span>
                                                                            @php
                                                                                $products_ids = \App\Models\Product::where('sub_category_id', $catid)
                                                                                    ->where('status', 1)
                                                                                    ->get()
                                                                                    ->pluck('id');
                                                                                
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
                                        @endif
                                    @else
                                        @if ($attributes->count() > 0)
                                            @foreach ($attributes as $attr)
                                                <div class="product-widget-type product-widget">
                                                    <h4 class="product-widget-title">{{ $attr->name }}</h4>
                                                    <ul class="product-widget-filter product-categories">
                                                        @if ($attr->attribute_values)
                                                            @foreach ($attr->attribute_values as $value)
                                                                <li>
                                                                    <label class="container_category">
                                                                        <input class="filter"
                                                                            id="attribute-{{ $attr->id }}"
                                                                            data-name="{{ $attr->id }}"
                                                                            data-id="{{ $value->id }}"
                                                                            type="checkbox">
                                                                        {{ $value->value }}
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif

                                @endif
                            </div>
                        </div>
                        <!--sidebar-section-->
                    </div>
                    <!--row-->
                </div>
            </div>
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>
<!--=====================================================
                        Site Section End
         =========================================================-->
<script>
    var sortby = 'no';
    var colors = [];
    var sizes = [];
    var attributes = [];
    var prices = [];
    var min_price = 'no';
    var max_price = 'no';
    var page = 1;
    var homecategory = "{!! $categorysearch !!}";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const search = urlParams.get('q') !== null ? urlParams.get('q') : 'no';

    var category = "";

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            $(document).find('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            page = $(this).attr('href').split('page=')[1];
            getData(page);
        });
    });

    $(document).on('change', 'input[name="orderby"]', function() {
        sortby = $(this).val();
        getData(1);
    });

    $(document).on('change', '[id^="color-"]', function() {
        colors = [];

        if (!$(this).is(':checked')) {
            var data_id = $(this).attr('data-id');
            $('.color_' + data_id).prop("checked", false);
        }
        $('[id^="color-"]').each(function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr('data-id');
                colors.push(id);
            }
        });
        getData(1);
    });

    $(document).on('change', '[id^="size-"]', function() {
        sizes = [];
        if (!$(this).is(':checked')) {
            var data_id = $(this).attr('data-id');
            $('.size_' + data_id).prop("checked", false);
        }
        $('[id^="size-"]').each(function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr('data-id');
                sizes.push(id);
            }
        });
        getData(1);
    });

    $(document).on('change', '[id^="attribute-"]', function() {
        attributes = [];
        $('[id^="attribute-"]').each(function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                attributes.push(id);
            }
        });
        getData(1);
    });

    function convertToSlug(Text) {
        return Text.toLowerCase().replace(/ /g, '-');
    }

    function getData(page) {
        category = homecategory;

        var mystr = (sortby !== 'no' ? '&sordby=' + sortby : '') + (search !== 'no' ? '&q=' + search : '') + (colors
            .length > 0 ? '&colors=' + colors : '') + (sizes.length > 0 ? '&sizes=' + sizes : '') + (prices.length >
            0 ? '&prices=' + prices : '') + (attributes.length > 0 ? '&attributes=' + attributes : '') + (
            min_price !== 'no' ? '&min_price=' + min_price : '') + (max_price !== 'no' ? '&max_price=' + max_price :
            '');
        if (mystr.length > 0) {
            mystr = mystr.substring(1);
        }

        var durl = "{{ url('/') }}" + '/' + category + (mystr.length > 0 ? '?' + mystr : '');

        history.pushState({}, null, durl);
        new_url = "{{ url('/') }}" + `/${category}`;
        $.ajax({
            url: new_url,
            type: 'get',
            datatype: 'html',
            data: {
                category: category,
                page: page,
                sortby: sortby,
                colors: colors,
                sizes: sizes,
                attributes: attributes,
                prices: prices,
                min_price: min_price,
                max_price: max_price,
                search: search
            },
            beforeSend: function() {
                overlay.show();
            },
            success: function(data) {

                $(document).find('.product_counts').html(data.count);
                $('.product_list_page').empty().html(data.data);
                $('.product_attributes_filter').empty().html(data.attributes);
                $('.product_attributes_sizes').empty().html(data.sizes);
                $('.product_attributes_colors').empty().html(data.colors);
                overlay.hide();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        getData(1);
    });
</script>
@include('frontend-view.includes.footer')
