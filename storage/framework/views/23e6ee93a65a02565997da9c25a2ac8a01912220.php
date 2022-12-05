<?php
$curr_route = request()->segment(2);
$curr_route2 = request()->segment(3);
$attribute_routes = ['colors', 'brands', 'sizes', 'attributes', 'attribute-values', 'map-attributes', 'fit', 'sleeve', 'neck', 'craft', 'collection', 'sale'];
$product_routes = ['products', 'bulk-product', 'media-library', 'product-category'];
$order_routes = ['orders', 'bulk-orders','wholesale_orders'];
$reports_routes = ['orders','products','wholesale_orders'];
$setting_routes = ['page', 'company-detail', 'social-media'];
$user_routes = ['permissions', 'roles', 'users'];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link p-2 text-center">
        <img onerror="handleError(this);"src="<?php echo e(asset("file/$setting->logo")); ?>" alt="<?php echo e(trans('panel.site_title')); ?>"
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
                    <a class="nav-link <?php echo e($curr_route == 'dashboard' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.home')); ?>">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                        <p>
                            <?php echo e(trans('global.dashboard')); ?>

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($curr_route == 'media' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.media')); ?>">
                        <i class="fas fa-fw fa-camera nav-icon"></i>
                        <p>
                            Media
                        </p>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(in_array($curr_route, $user_routes) ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle <?php echo e(in_array($curr_route, $user_routes) ? 'active' : ''); ?>"
                            href="#">
                            <i class="fa-fw nav-icon fas fa-users"></i>
                            <p>
                                <?php echo e(trans('cruds.userManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.permissions.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'permissions' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt"></i>
                                        <p>
                                            <?php echo e(trans('cruds.permission.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.roles.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'roles' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            <?php echo e(trans('cruds.role.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.users.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'users' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-user"></i>
                                        <p>
                                            <?php echo e(trans('cruds.user.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attribute_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(in_array($curr_route, $attribute_routes) ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle <?php echo e(in_array($curr_route, $attribute_routes) ? 'active' : ''); ?>"
                            href="#">
                            <i class="fa-fw nav-icon fab fa-adn"></i>
                            <p>
                                <?php echo e(trans('cruds.attributeManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attribute_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.attributes.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'attributes' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-bezier-curve"></i>
                                        <p>
                                            <?php echo e(trans('cruds.attribute.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('color_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.colors.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'colors' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-fill-drip"></i>
                                        <p>
                                            <?php echo e(trans('cruds.color.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.brands.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'brands' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-briefcase"></i>
                                        <p>
                                            <?php echo e(trans('cruds.brand.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('size_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.sizes.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'sizes' ? 'active' : ''); ?>">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>
                                            <?php echo e(trans('cruds.size.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('map_attribute_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.map-attributes.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'map-attributes' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-link"></i>
                                        <p>
                                            <?php echo e(trans('cruds.mapattribute.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_access')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($curr_route == 'categories' ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.categories.index')); ?>">
                            <i class="fas fa-fw fa-coins nav-icon"></i>
                            <p>
                                <?php echo e(trans('cruds.category.title')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($curr_route == 'weight' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.weight.index')); ?>">
                        <i class="fas fa-fw fa-weight nav-icon"></i>
                        <p>
                            Weight Range
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($curr_route == 'shipping' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.shipping.index')); ?>">
                        <i class="fas fa-fw fa-ship nav-icon"></i>
                        <p>
                            Shipping
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($curr_route == 'contactus' ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.contactus.index')); ?>">
                        <i class="fas fa-fw fa-envelope nav-icon"></i>
                        <p>
                            ContactUs Enquiries
                        </p>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(in_array($curr_route, $product_routes) ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fab fa-product-hunt">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.productManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_access')): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e($curr_route == 'products' ? 'active' : ''); ?>"
                                        href="<?php echo e(route('admin.products.index')); ?>?type=all">
                                        <i class="fab fa-product-hunt nav-icon"></i>
                                        <p>
                                            <?php echo e(trans('cruds.product.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_management_access')): ?>
                    <li class="nav-item has-treeview <?php echo e(in_array($curr_route, $order_routes) ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-truck">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.orderManagement.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_access')): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e($curr_route == 'orders' ? 'active' : ''); ?>"
                                        href="<?php echo e(route('admin.orders.index')); ?>">
                                        <i class="fa-fw nav-icon fas fa-archive"></i>
                                        <p>
                                            Orders
                                        </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link <?php echo e($curr_route == 'wholesale_orders' ? 'active' : ''); ?>"
                                        href="<?php echo e(route('admin.orders.wholesale_orders')); ?>">
                                        <i class="fa-fw nav-icon fas fa-archive"></i>
                                        <p>
                                            Wholesale Orders
                                        </p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                        <a class="nav-link <?php echo e($curr_route == 'bulk-orders' ? 'active' : ''); ?>"
                                            href="<?php echo e(route('admin.orders.bulk')); ?>">
                                            <i class="fa-fw nav-icon fa fa-car"></i>
                                            <p>
                                                Bulk Orders
                                            </p>
                                        </a>
                                    </li> -->
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon_access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.transactions.index')); ?>"
                            class="nav-link <?php echo e(request()->is('backoffice/transactions') || request()->is('backoffice/transactions/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon fas fa-credit-card"></i>
                            <p>
                                Transaction
                            </p>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon_access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.coupons.index')); ?>"
                            class="nav-link <?php echo e(request()->is('admin/coupons') || request()->is('admin/coupons/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon fas fa-barcode"></i>
                            <p>
                                <?php echo e(trans('cruds.coupon.title')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>





                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_access')): ?>
                    <!-- <li class="nav-item">
                        <a href="<?php echo e(route('admin.home.banners.index')); ?>"
                            class="nav-link <?php echo e(request()->is('admin/home/banners') || request()->is('admin/home/banners/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon fas fa-map-marked-alt"></i>
                            <p>
                                Home Banners Management
                            </p>
                        </a>
                    </li> -->
                    <li class="nav-item has-treeview <?php echo e(request()->is('admin/sliders*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-bookmark">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.master.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.sliders.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/sliders') || request()->is('admin/sliders/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.slider.title')); ?>

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.video-add.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'video-add' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fa fa-video">

                                        </i>
                                        <p>
                                            Video home slider
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.htext.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'htext' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fa fa-file">
                                        </i>
                                        <p>
                                            Header Text
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.trendsliders.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/trendsliders') || request()->is('admin/trendsliders/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">
                                        </i>
                                        <p>
                                            Trending Sliders
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.country.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'country' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>Countries</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.state.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'state' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>States</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.city.index')); ?>"
                                        class="nav-link <?php echo e($curr_route == 'city' ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs"></i>
                                        <p>Cities</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('social_profile_type_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.social-profile-types.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/social-profile-types') || request()->is('admin/social-profile-types/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.socialProfileType.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.menus.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/menus') || request()->is('admin/menus/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.menu.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.blogs.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.blog.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cms_page_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.cms-pages.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/cms-pages') || request()->is('admin/cms-pages/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.cmsPage.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('testimonial_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin.testimonials.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('admin/testimonials') || request()->is('admin/testimonials/*') ? 'active' : ''); ?>">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            <?php echo e(trans('cruds.testimonial.title')); ?>

                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item has-treeview <?php echo e(in_array($curr_route2, $reports_routes) ? 'menu-open' : ''); ?>">
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
                            <a class="nav-link <?php echo e($curr_route2 == 'orders' ? 'active' : ''); ?>"
                                href="<?php echo e(route('admin.reports.orders')); ?>">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Orders Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e($curr_route2 == 'wholesale_orders' ? 'active' : ''); ?>"
                                href="<?php echo e(route('admin.reports.wholesale_orders')); ?>">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Wholesale Orders Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e($curr_route2 == 'products' ? 'active' : ''); ?>"
                                href="<?php echo e(route('admin.reports.products')); ?>">
                                <i class="fa-fw nav-icon fas fa-archive"></i>
                                <p>
                                    Products Report
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_social_profile_access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.user-social-profiles.index')); ?>"
                            class="nav-link <?php echo e(request()->is('admin/user-social-profiles') || request()->is('admin/user-social-profiles/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon fas fa-user-secret">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.userSocialProfile.title')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                
               <!--  <li class="nav-item">
                    <a href="<?php echo e(route('admin.wholesale_user.index')); ?>"
                        class="nav-link <?php echo e(request()->is('admin/wholesale_user') || request()->is('admin/wholesale_user/*') ? 'active' : ''); ?>">
                        <i class="fa-fw nav-icon fas fa-user-secret">

                        </i>
                        <p>
                            Wholesale User
                        </p>
                    </a>
                </li> -->

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('store_access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.stores.index')); ?>"
                            class="nav-link <?php echo e(request()->is('admin/stores') || request()->is('admin/stores/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon fas fa-store">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.store.title')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('newsletter_access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.newsletters.index')); ?>"
                            class="nav-link <?php echo e(request()->is('admin/newsletters') || request()->is('admin/newsletters/*') ? 'active' : ''); ?>">
                            <i class="fa-fw nav-icon far fa-envelope">

                            </i>
                            <p>
                                <?php echo e(trans('cruds.newsletter.title')); ?>

                            </p>
                        </a>
                    </li>
                <?php endif; ?>


                <li class="nav-item">
                    <a href="<?php echo e(route('admin.settings')); ?>"
                        class="nav-link <?php echo e(request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : ''); ?>">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            <?php echo e(trans('cruds.setting.title')); ?>

                        </p>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('footer_access')): ?>
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
                                <?php echo e(trans('cruds.Footer.title')); ?>

                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-footer')); ?>"
                                        class="nav-link <?php echo ($segment == 'add-footer') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Add Footer
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-footer-link')); ?>"
                                        class="nav-link <?php echo ($segment == 'add-footer-link') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Add Footer Link
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('footer-cms')); ?>"
                                        class="nav-link <?php echo ($segment == 'footer-cms' || $segment == 'add-footer-cms') ? 'active' : ' ' ;  ?>">
                                        <i class="fa-fw nav-icon fas fa-copyright"></i>
                                        <p>
                                            Footer CMS
                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                           
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_management_access')): ?>
                    
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq_management_access')): ?>
                    
                <?php endif; ?>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH E:\laragon\www\adaajaipur\resources\views/partials/menu.blade.php ENDPATH**/ ?>