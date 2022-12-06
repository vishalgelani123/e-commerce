<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CountryController as BackountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\MapAttributeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqQuestionController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TliderController;
use App\Http\Controllers\Admin\SocialProfileTypeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserSocialProfileController;
use App\Http\Controllers\Admin\WholesaleUserController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\CurrierCompanyController as Currier;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\EmailModuleController;
use App\Http\Controllers\Admin\WeightController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ContactusController as ContactBackController;
use App\Http\Controllers\Admin\VideoAddController;
use App\Http\Controllers\Admin\HtextController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FooterlinkController;
use App\Models\CmsPage;

// Auth routes

Route::get('/', [FrontendController::class, 'index']);
Route::group(['prefix' => 'secure_admin'], function () {
    Auth::routes(['register' => false]);
});
Route::get('/secure_admin', function () {
    return redirect()->route('login');
});

Route::get('/add-footer', [FooterController::class, 'index'])->name('add-footer');
Route::get('/add-footer-link', [FooterlinkController::class, 'index'])->name('add-footer-link');

$cmses = CmsPage::all();
foreach ($cmses as $cms) {
    Route::get($cms->url, [CmsFront::class, 'index']);
}
Route::post('footer/update/{id}', [FooterController::class, 'updateData'])->name('footer.updateData');
Route::get('footer/edit/{id}', [FooterController::class, 'edit'])->name('footer.edit');
Route::get('footerlink/edit/{id}', [FooterlinkController::class, 'edit'])->name('footerlink.edit');
Route::post('footer/status/update', [FooterController::class, 'update_status'])
    ->name('footer.status.update');
Route::post('footerlink/update/{id}', [FooterlinkController::class, 'updateData'])->name('footerlink.updateData');
// footer cms
Route::get('/footer-cms', [FooterlinkController::class, 'index'])->name('footer-cms');
Route::post('admin/footercms/store', [FooterlinkController::class, 'storecms'])->name('admin.footercms.store');
Route::get('/add-footer-cms', [FooterlinkController::class, 'add_footer_cms'])->name('add-footer-cms');
Route::post('footer-cms-store', [FooterlinkController::class, 'footer_cms_store']);

Route::group(['prefix' => 'secure_admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('media', [MediaController::class, 'index'])->name('media');
    Route::post('media', [MediaController::class, 'index'])->name('media.search');
    Route::post('media/store', [MediaController::class, 'store'])->name('media.store');
    Route::post('media/pop', [MediaController::class, 'popstore'])->name('media.popstore');
    Route::post('media/resize', [MediaController::class, 'resize'])->name('media.resize');
    Route::post('media/delete', [MediaController::class, 'destroy'])->name('media.delete');
    Route::get('media/view/{id}', [MediaController::class, 'view'])->name('media.view');

    // Email Module;
    Route::get('emailmodule', [EmailModuleController::class, 'index'])->name('emailmodule');
    Route::get('emailmodule/{id}', [EmailModuleController::class, 'edit'])->name('emailmodule.edit');
    Route::post('emailmodule/{id}', [EmailModuleController::class, 'update'])->name('emailmodule.update');
    Route::post('emailmodule/upload', [EmailModuleController::class, 'storeCKEditorImages'])->name('emailmodule.storeCKEditorImages');

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'store'])->name('setting.store');
    Route::get('configs', [ConfigController::class, 'index'])->name('configs');
    Route::post('configs', [ConfigController::class, 'store'])->name('configs.store');

    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])
        ->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])
        ->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    Route::resource('referrals', ReferralController::class);

    Route::delete('country/destroy', [BackountryController::class, 'massDestroy'])
        ->name('country.massDestroy');
    Route::get('country/import', [BackountryController::class, 'import'])->name('country.import');
    Route::put('country/storecsv', [BackountryController::class, 'storecsv'])->name('country.storecsv');
    Route::resource('country', BackountryController::class);


    Route::delete('state/destroy', [StateController::class, 'massDestroy'])
        ->name('state.massDestroy');
    Route::resource('state', StateController::class);

    Route::delete('city/destroy', [CityController::class, 'massDestroy'])
        ->name('city.massDestroy');
    Route::resource('city', CityController::class);
    Route::resource('referrals', ReferralController::class);

    Route::get('references', [ReferralController::class, 'reference'])->name('references.index');
    Route::get('wallets', [ReferralController::class, 'wallets'])->name('wallets.index');
    Route::get('wallet/{id}', [ReferralController::class, 'edit_wallet'])->name('wallets.edit');
    Route::post('wallet/update', [ReferralController::class, 'update_wallet'])->name('wallets.update');
    // Faq Category
    Route::delete('faq-categories/destroy', [FaqCategoryController::class, 'massDestroy'])
        ->name('faq-categories.massDestroy');
    Route::post('faq-categories/media', [FaqCategoryController::class, 'storeMedia'])
        ->name('faq-categories.storeMedia');
    Route::post('faq-categories/ckmedia', [FaqCategoryController::class, 'storeCKEditorImages'])
        ->name('faq-categories.storeCKEditorImages');
    Route::resource('faq-categories', FaqCategoryController::class);

    // Faq Question
    Route::delete('faq-questions/destroy', [FaqQuestionController::class, 'massDestroy'])
        ->name('faq-questions.massDestroy');
    Route::resource('faq-questions', FaqQuestionController::class);

    // Category
    Route::get('subcategories/{id}', [CategoryController::class, 'getSubCategories'])->name('subcategories.index');
    Route::get('subcategories/create/{id}', [CategoryController::class, 'createSubCategories'])->name('subcategories.create');
    Route::post('category/sub_categories', [CategoryController::class, 'subCategories'])->name('category.subCategories');
    Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])
        ->name('categories.massDestroy');
    Route::post('categories/media', [CategoryController::class, 'storeMedia'])
        ->name('categories.storeMedia');
    Route::post('categories/ckmedia', [CategoryController::class, 'storeCKEditorImages'])
        ->name('categories.storeCKEditorImages');
    Route::post('categories/status/update', [CategoryController::class, 'update_status'])
        ->name('categories.status.update');

    Route::resource('categories', CategoryController::class);

    // Route::post('weight/store',[WeightController::class, 'store'])->name('weight.store');
    Route::get('/weight/{id}/destroy', [WeightController::class, 'deleteweight'])->name('weight.delete');
    Route::resource('weight', WeightController::class);

    // Route::post('shipping/store',[ShippingController::class, 'store'])->name('shipping.store');
    Route::post('shipping/import', [ShippingController::class, 'import'])->name('shipping.import');
    Route::delete('shipping/destroy', [ShippingController::class, 'massDestroy'])->name('shipping.massDestroy');
    Route::resource('shipping', ShippingController::class);

    Route::resource('contactus', ContactBackController::class);

    // Orders
    Route::resource('orders', OrderController::class);
    Route::get('wholesale_orders', [OrderController::class, 'wholesale_orders'])->name('orders.wholesale_orders');
    Route::patch('orders/status/{id}', [OrderController::class, 'update_status']);
    Route::delete('orders/delete/{id}', [OrderController::class, 'delete']);
    Route::get('orders/view/{id}', [OrderController::class, 'view']);
    Route::get('orders/invoice/{orderid}', [OrderController::class, 'download']);
    Route::get('bulk-orders', [OrderController::class, 'bulkOrders'])->name('orders.bulk');
    Route::post('bulk-orders', [OrderController::class, 'bulkStore'])->name('orders.bulk.store');
    Route::get('bulk-order/{id}', [OrderController::class, 'bulkEdit'])->name('orders.bulk.edit');
    Route::put('bulk-orders', [OrderController::class, 'bulkUpdate'])->name('orders.bulk.update');
    Route::delete('bulk-orders', [OrderController::class, 'bulkDestroy'])->name('orders.bulk.delete');


    // shipment
    Route::get('shipments', [ShipmentController::class, 'index'])->name('shipments');
    Route::get('shipments/edit/{id}', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::post('shipments/update', [ShipmentController::class, 'update'])->name('shipments.update');

    // currier company
    Route::get('currier-companies', [Currier::class, 'index'])->name('currier-companies');
    Route::get('currier-companies/create', [Currier::class, 'create'])->name('currier-companies.create');
    Route::post('currier-companies/store', [Currier::class, 'store'])->name('currier-companies.store');
    Route::get('currier-companies/edit/{id}', [Currier::class, 'edit'])->name('currier-companies.edit');
    Route::post('currier-companies/update', [Currier::class, 'update'])->name('currier-companies.update');
    Route::delete('currier-companies/delete/{id}', [Currier::class, 'destroy'])->name('currier-companies.destroy');

    // Transaction
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/{id}', [TransactionController::class, 'show']);
    Route::get('refunds', [TransactionController::class, 'refunds'])->name('refunds.index');

    // Map Attribute
    Route::resource('map-attributes', MapAttributeController::class);

    Route::post('map-attributes/size/update', [MapAttributeController::class, 'update_size'])->name('map-attributes.size.update');
    Route::post('map-attributes/color/update', [MapAttributeController::class, 'update_color'])->name('map-attributes.color.update');
    Route::post('map-attributes/brand/update', [MapAttributeController::class, 'update_brand'])->name('map-attributes.brand.update');
    Route::post('map-attributes/attribute/update', [MapAttributeController::class, 'update_attribute'])->name('map-attributes.attribute.update');
    Route::post('map-attributes/active/update', [MapAttributeController::class, 'update_active'])->name('map-attributes.active.update');
    Route::get('map-attributes/subcategory/{id}', [MapAttributeController::class, 'get_subcategory'])->name('map-attributes.subcategory');

    // Attribute
    Route::delete('attributes/destroy', [AttributeController::class, 'massDestroy'])
        ->name('attributes.massDestroy');

    Route::post('attributes/status/update', [AttributeController::class, 'update_status'])
        ->name('attributes.status.update');

    Route::post('attributes/media', [AttributeController::class, 'storeMedia'])
        ->name('attributes.storeMedia');
    Route::post('attributes/ckmedia', [AttributeController::class, 'storeCKEditorImages'])
        ->name('attributes.storeCKEditorImages');
    Route::resource('attributes', AttributeController::class);
    Route::post('attributes/can_delete', [AttributeController::class, 'is_delete'])->name('attributes.can_delete');

    // Attribute Value
    Route::delete('attribute-values/destroy', [AttributeValueController::class, 'massDestroy'])
        ->name('attribute-values.massDestroy');
    Route::resource('attribute-values', AttributeValueController::class);

    // Color
    Route::delete('colors/destroy', [ColorController::class, 'massDestroy'])
        ->name('colors.massDestroy');
    Route::post('color/status/update', [ColorController::class, 'update_status'])
        ->name('color.status.update');
    Route::resource('colors', ColorController::class);

    // Brand
    Route::delete('brands/destroy', [BrandController::class, 'massDestroy'])
        ->name('brands.massDestroy');
    Route::post('brands/media', [BrandController::class, 'storeMedia'])
        ->name('brands.storeMedia');
    Route::post('brands/ckmedia', [BrandController::class, 'storeCKEditorImages'])
        ->name('brands.storeCKEditorImages');
    Route::post('brand/status/update', [BrandController::class, 'update_status'])
        ->name('brand.status.update');
    Route::resource('brands', BrandController::class);

    // Size
    Route::delete('sizes/destroy', [SizeController::class, 'massDestroy'])
        ->name('sizes.massDestroy');
    Route::post('size/status/update', [SizeController::class, 'update_status'])
        ->name('size.status.update');
    Route::resource('sizes', SizeController::class);

    // Product
    Route::delete('products/destroy', [ProductController::class, 'massDestroy'])
        ->name('products.massDestroy');
    Route::post('products/media', [ProductController::class, 'storeMedia'])
        ->name('products.storeMedia');
    Route::post('products/ckmedia', [ProductController::class, 'storeCKEditorImages'])
        ->name('products.storeCKEditorImages');
    Route::resource('products', ProductController::class);
    Route::post('products/upload', [ProductController::class, 'upload'])->name('products.upload');
    Route::get('products/sample/download', [ProductController::class, 'sample'])->name('products.sample.download');

    Route::get('products/checksku/{sku}', [ProductController::class, 'sku_code'])->name('products.check.sku');
    Route::post('product/attributes', [ProductController::class, 'mappedAttributes'])
        ->name('product.attributes');
    Route::post('product/child_attributes', [ProductController::class, 'mappedChildAttributes'])
        ->name('product.childattributes');
    Route::get('product/attributes/copy', [ProductController::class, 'mappedAttributescopy'])
        ->name('product.attributes.copy');
    Route::post('product/status/update', [ProductController::class, 'update_status'])
        ->name('product.status.update');
    Route::post('product/update/new/{id}', [ProductController::class, 'update'])
        ->name('product.new.update');

    Route::post('product/getpartials', [ProductController::class, 'getpartials']);
    Route::post('product/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('product/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('product/storeimport', [ProductController::class, 'storeimport'])->name('products.storeimport');

    // get category
    Route::post('products/map/subcategory', [ProductController::class, 'subCategories'])
        ->name('product.map.subcategories');
    Route::post('products/map/childcategory', [ProductController::class, 'childCategories'])
        ->name('product.map.childcategories');

    // Product Image
    Route::delete('product-images/destroy', [ProductImageController::class, 'massDestroy'])
        ->name('product-images.massDestroy');
    Route::post('product-images/media', [ProductImageController::class, 'storeMedia'])
        ->name('product-images.storeMedia');
    Route::post('product-images/image/destroy', [ProductImageController::class, 'destroyImage'])
        ->name('product-images.destroy.new');
    Route::post('product-images/ckmedia', [ProductImageController::class, 'storeCKEditorImages'])
        ->name('product-images.storeCKEditorImages');
    Route::resource('product-images', ProductImageController::class);

    Route::get('product/sendimg', [ProductController::class, 'sendimg']);

    // Product Variation
    Route::delete('product-variations/destroy', [ProductVariationController::class, 'massDestroy'])
        ->name('product-variations.massDestroy');
    Route::post('product-variations/media', [ProductVariationController::class, 'storeMedia'])
        ->name('product-variations.storeMedia');
    Route::post('product-variations/ckmedia', [ProductVariationController::class, 'storeCKEditorImages'])
        ->name('product-variations.storeCKEditorImages');
    Route::resource('product-variations', ProductVariationController::class);

    // Product Attribute
    Route::delete('product-attributes/destroy', [ProductAttributeController::class, 'massDestroy'])
        ->name('product-attributes.massDestroy');
    Route::resource('product-attributes', ProductAttributeController::class);


    // Coupon
    Route::delete('coupons/destroy', [CouponController::class, 'massDestroy'])->name('coupons.massDestroy');
    Route::post('coupons/media', [CouponController::class, 'storeMedia'])->name('coupons.storeMedia');
    Route::post('coupons/ckmedia', [CouponController::class, 'storeCKEditorImages'])->name('coupons.storeCKEditorImages');
    Route::post('coupon/status/update', [CouponController::class, 'update_status'])
        ->name('coupon.status.update');
    Route::resource('coupons', CouponController::class);


    //Banners Home
    Route::get('home/banners', [SliderController::class, 'homeBestsellerBanners'])->name('home.banners.index');
    Route::get('home/banners/edit/{id}', [SliderController::class, 'homeBestsellerBannersEdit'])->name('home.banners.edit');
    Route::get('home/banners/newarrival/edit/{id}', [SliderController::class, 'homeNewArrivalsEdit'])->name('home.new.banners.edit');
    Route::get('home/banners/exclusive/edit/{id}', [SliderController::class, 'homeExclusivesEdit'])->name('home.exclusive.banners.edit');
    Route::post('home/banners/update/{id}', [SliderController::class, 'homeBestsellerBannersUpdate'])->name('home.banners.update');
    Route::post('home/banners/newarrival/update/{id}', [SliderController::class, 'homeNewArrivalUpdate'])->name('home.arrival.banners.update');
    Route::post('home/banners/exclusive/update/{id}', [SliderController::class, 'homeExclusiveUpdate'])->name('home.exclusive.banners.update');

    // Route::get('bestsellerbanner',[SliderController::class, 'best_seller_banner'])->name('bestsellerbanner.index');

    // new arrival banner
    Route::get('newarrivalbanners', [SliderController::class, 'new_arrival_banner'])->name('newarrivalbanners.index');
    Route::get('newarrivalbanners/{id}', [SliderController::class, 'new_arrival_banner_edit'])->name('newarrivalbanners.edit');
    Route::post('newarrivalbanners/{id}', [SliderController::class, 'new_arrival_banner_update'])->name('newarrivalbanners.update');


    // best seller banner
    Route::get('bestsellerbanners', [SliderController::class, 'best_seller_banner'])->name('bestsellerbanners.index');
    Route::get('bestsellerbanners/{id}', [SliderController::class, 'best_seller_banner_edit'])->name('bestsellerbanners.edit');
    Route::post('bestsellerbanners/{id}', [SliderController::class, 'best_seller_banner_update'])->name('bestsellerbanners.update');


    // best seller banner
    Route::get('latestbanners', [SliderController::class, 'latest_banner'])->name('latestbanners.index');
    Route::get('latestbanners/{id}', [SliderController::class, 'latest_banner_edit'])->name('latestbanners.edit');
    Route::post('latestbanners/{id}', [SliderController::class, 'latest_banner_update'])->name('latestbanners.update');


    Route::delete('videoAdd/destroy', [VideoAddController::class, 'massDestroy'])->name('videoAdd.massDestroy');
    Route::post('videoAdd/media', [VideoAddController::class, 'storeMedia'])->name('videoAdd.storeMedia');
    Route::post('videoAdd/ckmedia', [VideoAddController::class, 'storeCKEditorImages'])->name('videoAdd.storeCKEditorImages');
    Route::post('videoAdd/status/update', [VideoAddController::class, 'update_status'])->name('videoAdd.status.update');

    Route::resource('video-add', VideoAddController::class);

    Route::delete('htext/destroy', [HtextController::class, 'massDestroy'])->name('htext.massDestroy');
    Route::post('htext/media', [HtextController::class, 'storeMedia'])->name('htext.storeMedia');
    Route::post('htext/ckmedia', [HtextController::class, 'storeCKEditorImages'])->name('htext.storeCKEditorImages');
    Route::post('htext/status/update', [HtextController::class, 'update_status'])->name('htext.status.update');
    Route::get('/htext/{id}/destroy', [HtextController::class, 'destroy'])->name('htext.delete');
    Route::resource('htext', HtextController::class);

    // Slider
    Route::delete('sliders/destroy', [SliderController::class, 'massDestroy'])->name('sliders.massDestroy');
    Route::post('sliders/media', [SliderController::class, 'storeMedia'])->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', [SliderController::class, 'storeCKEditorImages'])->name('sliders.storeCKEditorImages');
    Route::post('slider/status/update', [SliderController::class, 'update_status'])
        ->name('slider.status.update');
    Route::resource('sliders', SliderController::class);

    //Trends Slider
    Route::delete('trendsliders/destroy', [TliderController::class, 'massDestroy'])->name('trendsliders.massDestroy');
    Route::post('trendsliders/media', [TliderController::class, 'storeMedia'])->name('trendsliders.storeMedia');
    Route::post('trendsliders/ckmedia', [TliderController::class, 'storeCKEditorImages'])->name('trendsliders.storeCKEditorImages');
    Route::post('trendsliders/status/update', [TliderController::class, 'update_status'])
        ->name('trendsliders.status.update');
    Route::resource('trendsliders', TliderController::class);

    // Social Profile Type
    Route::delete('social-profile-types/destroy', [SocialProfileTypeController::class, 'massDestroy'])->name('social-profile-types.massDestroy');
    Route::post('social-profile-types/media', [SocialProfileTypeController::class, 'storeMedia'])->name('social-profile-types.storeMedia');
    Route::post('social-profile-types/ckmedia', [SocialProfileTypeController::class, 'storeCKEditorImages'])->name('social-profile-types.storeCKEditorImages');
    Route::post('social/status/update', [SocialProfileTypeController::class, 'update_status'])
        ->name('social.status.update');
    Route::resource('social-profile-types', SocialProfileTypeController::class);

    // User Social Profile
    Route::delete('user-social-profiles/destroy', [UserSocialProfileController::class, 'massDestroy'])->name('user-social-profiles.massDestroy');
    Route::post('social-profiles/status/update', [UserSocialProfileController::class, 'update_status'])
        ->name('social-profiles.status.update');
    Route::resource('user-social-profiles', UserSocialProfileController::class);
    Route::resource('wholesale_user', WholesaleUserController::class);
    Route::post('wholesale_user/status/update', [WholesaleUserController::class, 'update_status'])
        ->name('wholesale_user.status.update');

    // Store
    Route::delete('stores/destroy', [StoreController::class, 'massDestroy'])->name('stores.massDestroy');
    Route::resource('stores', StoreController::class);

    // Cms Page
    Route::get('cms-pages/arrange', [CmsPageController::class, 'arrange'])->name('cms-pages.arrange');
    Route::post('cms-pages/title/update', [CmsPageController::class, 'update_title'])->name('cms-pages.title.update');
    Route::delete('cms-pages/destroy', [CmsPageController::class, 'massDestroy'])->name('cms-pages.massDestroy');
    Route::post('cms-pages/media', [CmsPageController::class, 'storeMedia'])->name('cms-pages.storeMedia');

    Route::post('cms-pages/status/update', [CmsPageController::class, 'update_status'])
        ->name('cms-pages.status.update');
    Route::post('cms-pages/ckmedia', [CmsPageController::class, 'storeCKEditorImages'])->name('cms-pages.storeCKEditorImages');
    Route::resource('cms-pages', CmsPageController::class);

    // Page sorting
    Route::post('shopage', [CmsPageController::class, 'shop_store'])->name('shopage.store');
    Route::delete('shopage', [CmsPageController::class, 'shop_remove'])->name('shopage.delete');
    Route::post('shopage/sequence', [CmsPageController::class, 'shop_seq'])->name('shopage.sequence');
    Route::post('customerpage', [CmsPageController::class, 'customer_store'])->name('customerpage.store');
    Route::delete('customerpage', [CmsPageController::class, 'customer_remove'])->name('customerpage.delete');
    Route::post('customerpage/sequence', [CmsPageController::class, 'cust_seq'])->name('customerpage.sequence');


    Route::post('policypage', [CmsPageController::class, 'policy_store'])->name('policypage.store');
    Route::delete('policypage', [CmsPageController::class, 'policy_remove'])->name('policypage.delete');
    Route::post('policypage/sequence', [CmsPageController::class, 'policy_seq'])->name('policypage.sequence');


    // Testimonial
    Route::delete('testimonials/destroy', [TestimonialController::class, 'massDestroy'])->name('testimonials.massDestroy');
    Route::post('testimonials/media', [TestimonialController::class, 'storeMedia'])->name('testimonials.storeMedia');
    Route::post('testimonials/status/update', [TestimonialController::class, 'update_status'])
        ->name('testimonials.status.update');
    Route::post('testimonials/ckmedia', [TestimonialController::class, 'storeCKEditorImages'])->name('testimonials.storeCKEditorImages');
    Route::resource('testimonials', TestimonialController::class);

    // Newsletter
    Route::delete('newsletters/destroy', [NewsletterController::class, 'massDestroy'])->name('newsletters.massDestroy');
    Route::post('newsletters/status/update', [NewsletterController::class, 'update_status'])
        ->name('newsletters.status.update');
    Route::resource('newsletters', NewsletterController::class);

    // Menu
    Route::delete('menus/destroy', [MenuController::class, 'massDestroy'])->name('menus.massDestroy');
    Route::post('menu/status/update', [MenuController::class, 'update_status'])
        ->name('menu.status.update');
    Route::resource('menus', MenuController::class);

    // Blog
    Route::delete('blogs/destroy', [BlogController::class, 'massDestroy'])->name('blogs.massDestroy');
    Route::post('blogs/media', [BlogController::class, 'storeMedia'])->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', [BlogController::class, 'storeCKEditorImages'])->name('blogs.storeCKEditorImages');
    Route::post('blog/status/update', [BlogController::class, 'update_status'])
        ->name('blog.status.update');
    Route::resource('blogs', BlogController::class);

    // Reports
    Route::get('reports/sales', [ReportCOntroller::class, 'sales'])->name('reports.sales');
    Route::get('reports/orders', [ReportCOntroller::class, 'orders'])->name('reports.orders');
    Route::get('reports/wholesale_orders', [ReportCOntroller::class, 'wholesale_orders'])->name('reports.wholesale_orders');
    Route::get('reports/products', [ReportCOntroller::class, 'products'])->name('reports.products');
    Route::get('reports/payments', [ReportCOntroller::class, 'payments'])->name('reports.payments');
});
Route::group(['prefix' => 'secure_admin/profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    Route::get('password', [ChangePasswordController::class, 'edit'])
        ->name('password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])
        ->name('password.update');
    Route::post('profile', [ChangePasswordController::class, 'updateProfile'])
        ->name('password.updateProfile');
    Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])
        ->name('password.destroyProfile');
});

// Clear cache
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Application cache cleared';
});


