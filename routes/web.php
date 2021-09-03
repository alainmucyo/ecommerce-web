<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//Route::get('/', "ProductHomeController@index")->name("welcome");
Route::get('/', "ProductHomeController@newIndex")->name("welcome");
Auth::routes();
Route::get("/currency/{currency}","CurrencyController@change")->name("currency.change");
Route::middleware('CheckRole')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get("/categories", "CategoryController@getCategory");
    Route::Apiresource("/api/category", "CategoryController");
    Route::get("/home-sections", "HomeSectionController@getHomeSection");
    Route::Apiresource("/api/home-section", "HomeSectionController");


    Route::get("/users/sellers", "UsersController@sellers");
    Route::put("/user/seller/{user}", "UsersController@acceptSeller");
    Route::delete("/user/seller/{user}", "UsersController@rejectSeller");
    Route::Apiresource("/api/users", "UsersController");
    Route::delete("api/user/{user}", "UsersController@destroy");


    Route::resource("/product", "ProductController")->middleware('auth');
    Route::put("/change-slider/{product}", "ProductController@changeSlider")->middleware('auth');


    Route::get("/seller/orders", "SellerOrdersController@index");
//    Route::get("/seller/orders/all", "SellerOrdersController@allOrders");
    Route::put("/order/product/delivered/{orderProduct}", "OrderController@productDeliver");
    Route::put("/order/delivered/{order}", "OrderController@orderDeliver");


    Route::get("/chatbox/seller", "ChatboxController@sellerChat");


    Route::get("/reports/products", "ReportsController@productReports");
    Route::get("/reports/customers", "ReportsController@customerReports");

    Route::post("/discount", "DiscountController@store");


    Route::prefix("admin")->group(function () {
//    Route::get("/{product}/homepage", "ProductController@homepage");
        Route::get("/users", "UsersController@users");
        Route::put("/{product}/homepage", "ProductController@homepage");
        Route::get("/products", "ProductController@adminList");
        Route::get("/deliver-fees", "DeliveryFeeController@index");
        Route::post("/api/delivery-fee", "DeliveryFeeController@store");
        Route::get("/api/delivery-fee", "DeliveryFeeController@loadFees");
        Route::put("/api/delivery-fee/{deliveryFee}", "DeliveryFeeController@update");
        Route::delete("/api/delivery-fee/{deliveryFee}", "DeliveryFeeController@destroy");
        Route::get("/sellers", "UsersController@sellersList");
        Route::put("/seller/disable/{user}", "UsersController@sellerDisable");
        Route::put("/seller/enable/{user}", "UsersController@sellerEnable");
        Route::get("/orders", "OrderController@adminOrders");
        Route::resource("ad-product", "AdProductController");
        Route::put("/seller/{user}/home", "UsersController@addOnHomepage");
        Route::resource("/currencies", "CurrencyExchangeController");
    });

    Route::post("/profile/{user}", "UsersController@profile")->middleware('auth');
    Route::get("/profile", "UsersController@getProfile")->middleware('auth');
});
Route::middleware('auth')->group(function () {
    Route::put("/cart/update", "CartController@update");
    Route::resource("/cart", "CartController");
    Route::get("/remove-all/cart", "CartController@removeAllCart");
    Route::post("/api/buy", "BuyController@buyMomo");
    Route::get("/checkout", "CartController@checkout");


    Route::get("/orders", "OrderController@index");
    Route::get("/order/{order}", "OrderController@show");
    Route::put("/order/order/{order}", "OrderController@orderReceived");
    Route::put("/order/product/{orderProduct}", "OrderController@productReceived");
    Route::get("/customer/order/{order}", "OrderController@customerShow");


    Route::get("/chatbox/customer", "ChatboxController@customerChat");
    Route::get("/chatbox/chatlist", "ChatboxController@chatList");
    Route::get("/chatbox/message/{chatter_id}", "ChatboxController@getMessages");
    Route::post("/chatbox/message", "ChatboxController@storeMessages");


    Route::get("/api/checkout", "CartController@apiCheckout");
    Route::get("/api/user-details", "UsersController@details");

    Route::get("/customer/profile", "UsersController@getCustomerProfile");
});
Route::get("/product/category/{category}", "ProductController@getByCategories");
Route::get("/product/image/{product}", "ProductController@image")->middleware('auth');
Route::post("/product/image/{product}", "ProductController@storeImages")->middleware('auth');
Route::get("/item/{slug}", "ItemController@show");

Route::get("/shop", "ItemController@index");
Route::get("/contact-us", function () {
    return view("home.contact-us");
});


Route::get("/api/delivery-fees", "DeliveryFeeController@loadFees");


Route::prefix("review")->group(function () {
    Route::post("/store", "ReviewController@store");
    Route::get("/{product}", "ReviewController@index");
});
Route::put("like/{product}", "LikeController@likeProduct");

Route::get('login', [

        'uses' => 'Auth\LoginController@showLoginForm',
    ]
)->name('login');
Route::post('login', [
    'uses' => 'Auth\LoginController@login',
    'middleware' => 'checkstatus',
]);
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get("/api/user", function () {
    $user = auth()->user();
    $user->type = $user->roles->first()->name;
    return response(["user" => $user]);
})->middleware("auth");


Route::post("/password_reset/change", "PasswordResetController@resetPassword")->name("password.change");
Route::get("/password_reset/{email}", "PasswordResetController@validatePasswordRequest");

Route::get("/update", function () {
    $role = \jeremykenedy\LaravelRoles\Models\Role::where("slug", "seller")->first();
    $users = $role->users;
    foreach ($users as $user) {
        $user->update(["shop_name" => $user->name]);
    }
    return "ok";
});
