@php
$curr_route = request()->segment(2);
$curr_route2 = request()->segment(3);
$attribute_routes = ['colors', 'brands', 'sizes', 'attributes', 'attribute-values', 'map-attributes', 'fit', 'sleeve', 'neck', 'craft', 'collection', 'sale'];
$product_routes = ['products', 'bulk-product', 'media-library', 'product-category'];
$order_routes = ['orders', 'bulk-orders','wholesale_orders'];
$reports_routes = ['orders','products','wholesale_orders'];
$setting_routes = ['page', 'company-detail', 'social-media'];
$user_routes = ['permissions', 'roles', 'users'];
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link p-2 text-center">
        <img onerror="handleError(this);"src="{{asset("file/$setting->logo")}}" alt="{{ trans('panel.site_title') }}"
            style="height: 40px;" />
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact text-sm" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ $curr_route == 'dashboard' ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $curr_route == 'media' ? 'active' : '' }}"
                        href="{{ route('admin.media') }}">
                        <i class="fas fa-fw fa-camera nav-icon"></i>
                        <p>
                            Media
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ in_array($curr_route, $user_routes) ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ in_array($curr_route, $user_routes) ? 'active' : '' }}"
                            href="#">
                            <i class="fa-fw nav-icon fas fa-users"></i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="nav-link {{ $curr_route == 'permissions' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt"></i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ $curr_route == 'roles' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ $curr_route == 'users' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user"></i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{-- @can('category_management_access')
                    <li class="nav-item">
                        <a class="nav-link {{ $curr_route == 'categories' ? 'active' : '' }}"
                            href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-fw fa-coins nav-icon"></i>
                            <p>
                                {{ trans('cruds.category.title') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ ($curr_route == 'categories') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ ($curr_route == 'categories') ? 'active' : '' }}" href="#">
                            <i class="fa-fw nav-icon fas fa-coins">

                            </i>
                            <p>
                                {{ trans('cruds.categoryManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cubes"></i>
                                        <p>
                                            {{ trans('cruds.category.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
                @can('attribute_management_access')
                    <li class="nav-item has-treeview {{ in_array($curr_route, $attribute_routes) ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle {{ in_array($curr_route, $attribute_routes) ? 'active' : '' }}"
                            href="#">
                            <i class="fa-fw nav-icon fab fa-adn"></i>
                            <p>
                                {{ trans('cruds.attributeManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('attribute_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.attributes.index') }}"
                                        class="nav-link {{ $curr_route == 'attributes' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-bezier-curve"></i>
                                        <p>
                                            {{ trans('cruds.attribute.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            {{-- @can('attribute_value_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.attribute-values.index') }}"
                                        class="nav-link {{ $curr_route == 'attribute-values' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-boxes"></i>
                                        <p>
                                            {{ trans('cruds.attributeValue.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan --}}
                            @can('color_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.colors.index') }}"
                                        class="nav-link {{ $curr_route == 'colors' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-fill-drip"></i>
                                        <p>
                                            {{ trans('cruds.color.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('brand_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.index') }}"
                                        class="nav-link {{ $curr_route == 'brands' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            {{ trans('cruds.brand.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('size_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.sizes.index') }}"
                                        class="nav-link {{ $curr_route == 'sizes' ? 'active' : '' }}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>
                                            {{ trans('cruds.size.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('map_attribute_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.map-attributes.index') }}"
                                        class="nav-link {{ $curr_route == 'map-attributes' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-link"></i>
                                        <p>
                                            {{ trans('cruds.mapattribute.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('category_access')
                    <li class="nav-item">
                        <a class="nav-link {{ $curr_route == 'categories' ? 'active' : '' }}"
                            href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-fw fa-coins nav-icon"></i>
                            <p>
                                {{ trans('cruds.category.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link {{ $curr_route == 'weight' ? 'active' : '' }}"
                        href="{{ route('admin.weight.index') }}">
                        <i class="fas fa-fw fa-weight nav-icon"></i>
                        <p>
                            Weight Range
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $curr_route == 'shipping' ? 'active' : '' }}"
                        href="{{ route('admin.shipping.index') }}">
                        <i class="fas fa-fw fa-ship nav-icon"></i>
                        <p>
                            Shipping
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $curr_route == 'contactus' ? 'active' : '' }}"
                        href="{{ route('admin.contactus.index') }}">
                        <i class="fas fa-fw fa-envelope nav-icon"></i>
                        <p>
                            ContactUs Enquiries
                        </p>
                    </a>
                </li>
                @can('product_management_access')
                    <li class="nav-item has-treeview {{ in_array($curr_route, $product_routes) ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fab fa-product-hunt">

                            </i>
                            <p>
                                {{ trans('cruds.productManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a class="nav-link {{ $curr_route == 'products' ? 'active' : '' }}"
                                        href="{{ route('admin.products.index') }}?type=all">
                                        <i class="fab fa-product-hunt nav-icon"></i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                @can('product_management_access')
                    <li class="nav-item has-treeview {{ in_array($curr_route, $order_routes) ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-truck">

                            </i>
                            <p>
                                {{ trans('cruds.orderManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a class="nav-link {{ $curr_route == 'orders' ? 'active' : '' }}"
                                        href="{{ route('admin.orders.index') }}">
                                        <i class="fa-fw nav-icon fas fa-archive"></i>
                                        <p>
                                            Orders
                                        </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link {{ $curr_route == 'wholesale_orders' ? 'active' : '' }}"
                                        href="{{ route('admin.orders.wholesale_orders') }}">
                                        <i class="fa-fw nav-icon fas fa-archive"></i>
                                        <p>
                                            Wholesale Orders
                                        </p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                        <a class="nav-link {{ $curr_route == 'bulk-orders' ? 'active' : '' }}"
                                            href="{{ route('admin.orders.bulk') }}">
                                            <i class="fa-fw nav-icon fa fa-car"></i>
                                            <p>
                                                Bulk Orders
                                            </p>
                                        </a>
                                    </li> -->
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('coupon_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.transactions.index') }}"
                            class="nav-link {{ request()->is('backoffice/transactions') || request()->is('backoffice/transactions/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-credit-card"></i>
                            <p>
                                Transaction
                            </p>
                        </a>
                    </li>
                @endcan


                @can('coupon_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.coupons.index') }}"
                            class="nav-link {{ request()->is('admin/coupons') || request()->is('admin/coupons/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-barcode"></i>
                            <p>
                                {{ trans('cruds.coupon.title') }}
                            </p>
                        </a>
                    </li>
                @endcan





                @can('master_access')
                    <!-- <li class="nav-item">
                        <a href="{{ route('admin.home.banners.index') }}"
                            class="nav-link {{ request()->is('admin/home/banners') || request()->is('admin/home/banners/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-map-marked-alt"></i>
                            <p>
                                Home Banners Management
                            </p>
                        </a>
                    </li> -->
                    <li class="nav-item has-treeview {{ request()->is('admin/sliders*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-bookmark">

                            </i>
                            <p>
                                {{ trans('cruds.master.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('slider_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.sliders.index') }}"
                                        class="nav-link {{ request()->is('admin/sliders') || request()->is('admin/sliders/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.slider.title') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.video-add.index') }}"
                                        class="nav-link {{ $curr_route == 'video-add' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fa fa-video">

                                        </i>
                                        <p>
                                            Video home slider
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.htext.index') }}"
                                        class="nav-link {{ $curr_route == 'htext' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fa fa-file">
                                        </i>
                                        <p>
                                            Header Text
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.trendsliders.index') }}"
                                        class="nav-link {{ request()->is('admin/trendsliders') || request()->is('admin/trendsliders/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">
                                        </i>
                                        <p>
                                            Trending Sliders
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.country.index') }}"
                                        class="nav-link {{ $curr_route == 'country' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>Countries</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.state.index') }}"
                                        class="nav-link {{ $curr_route == 'state' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>States</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.city.index') }}"
                                        class="nav-link {{ $curr_route == 'city' ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>Cities</p>
                                    </a>
                                </li>
                            @endcan
                            @can('social_profile_type_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.social-profile-types.index') }}"
                                        class="nav-link {{ request()->is('admin/social-profile-types') || request()->is('admin/social-profile-types/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.socialProfileType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('menu_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.menus.index') }}"
                                        class="nav-link {{ request()->is('admin/menus') || request()->is('admin/menus/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.menu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('blog_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.blogs.index') }}"
                                        class="nav-link {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.blog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('cms_page_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.cms-pages.index') }}"
                                        class="nav-link {{ request()->is('admin/cms-pages') || request()->is('admin/cms-pages/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.cmsPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('testimonial_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.testimonials.index') }}"
                                        class="nav-link {{ request()->is('admin/testimonials') || request()->is('admin/testimonials/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.testimonial.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <li class="nav-item has-treeview {{ in_array($curr_route2, $reports_routes) ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-truck">

                        </i>
                        <p>
                            Report
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link {{ $curr_route2 == 'orders' ? 'active' : '' }}"
                                href="{{ route('admin.reports.orders') }}">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Orders Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $curr_route2 == 'wholesale_orders' ? 'active' : '' }}"
                                href="{{ route('admin.reports.wholesale_orders') }}">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Wholesale Orders Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $curr_route2 == 'products' ? 'active' : '' }}"
                                href="{{ route('admin.reports.products') }}">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Products Report
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('user_social_profile_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.user-social-profiles.index') }}"
                            class="nav-link {{ request()->is('admin/user-social-profiles') || request()->is('admin/user-social-profiles/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-user-secret">

                            </i>
                            <p>
                                {{ trans('cruds.userSocialProfile.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                
               <!--  <li class="nav-item">
                    <a href="{{ route('admin.wholesale_user.index') }}"
                        class="nav-link {{ request()->is('admin/wholesale_user') || request()->is('admin/wholesale_user/*') ? 'active' : '' }}">
                        <i class="fa-fw nav-icon fas fa-user-secret">

                        </i>
                        <p>
                            Wholesale User
                        </p>
                    </a>
                </li> -->

                @can('store_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.stores.index') }}"
                            class="nav-link {{ request()->is('admin/stores') || request()->is('admin/stores/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-store">

                            </i>
                            <p>
                                {{ trans('cruds.store.title') }}
                            </p>
                        </a>
                    </li>
                @endcan

                @can('newsletter_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.newsletters.index') }}"
                            class="nav-link {{ request()->is('admin/newsletters') || request()->is('admin/newsletters/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon far fa-envelope">

                            </i>
                            <p>
                                {{ trans('cruds.newsletter.title') }}
                            </p>
                        </a>
                    </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}"
                        class="nav-link {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : '' }}">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.setting.title') }}
                        </p>
                    </a>
                </li>
                @can('footer_access')
                    <?php $segment =  Request::segment(1); ?>
                    <!--
                        add-footer
                        add-footer-link
                        footer-cms
                    -->
                    <li class="nav-item has-treeview <?php echo ($segment == 'add-footer' || $segment == 'add-footer-link' || $segment == 'footer-cms' || $segment == 'add-footer-cms') ? 'menu-open' : ' ' ;  ?>">
                        <a class="nav-link nav-dropdown-toggle <?php echo ($segment == 'add-footer' || $segment == 'add-footer-link' || $segment == 'footer-cms' || $segment == 'add-footer-cms') ? 'active' : ' ' ;  ?>"
                            href="#">
                            <i class="fa-fw nav-icon fas fa-copyright"></i>
                            <p>
                                {{ trans('cruds.Footer.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('add-footer') }}"
                                        class="nav-link <?php echo ($segment == 'add-footer') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Add Footer
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('add-footer-link') }}"
                                        class="nav-link <?php echo ($segment == 'add-footer-link') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Add Footer Link
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('footer-cms') }}"
                                        class="nav-link <?php echo ($segment == 'footer-cms' || $segment == 'add-footer-cms') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Footer CMS
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            
                           
                        </ul>
                    </li>
                @endcan
                @can('product_management_access')
                    {{-- <li class="nav-item has-treeview {{ request()->is('admin/products*') ? 'menu-open' : '' }} {{ request()->is('admin/product-images*') ? 'menu-open' : '' }} {{ request()->is('admin/product-variations*') ? 'menu-open' : '' }} {{ request()->is('admin/product-attributes*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fab fa-product-hunt">

                            </i>
                            <p>
                                {{ trans('cruds.productManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_image_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-images.index') }}"
                                        class="nav-link {{ request()->is('admin/product-images') || request()->is('admin/product-images/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>
                                            {{ trans('cruds.productImage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_variation_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-variations.index') }}"
                                        class="nav-link {{ request()->is('admin/product-variations') || request()->is('admin/product-variations/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>
                                            {{ trans('cruds.productVariation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_attribute_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.product-attributes.index') }}"
                                        class="nav-link {{ request()->is('admin/product-attributes') || request()->is('admin/product-attributes/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>
                                            {{ trans('cruds.productAttribute.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li> --}}
                @endcan
                @can('faq_management_access')
                    {{-- <li
                        class="nav-item has-treeview {{ request()->is('admin/faq-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/faq-questions*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.faq-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.faq-questions.index') }}"
                                        class="nav-link {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-question"></i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li> --}}
                @endcan
                {{-- @can('profile_password_edit')
                    <li
                        class="nav-item {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            <p>
                                {{ trans('global.change_password') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
