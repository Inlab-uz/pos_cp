<?php

use App\Http\Controllers\Blade\BranchController;
use App\Http\Controllers\Blade\CashierController;
use App\Http\Controllers\Blade\CategoryController;
use App\Http\Controllers\Blade\MenagerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Import_Export_Controller;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\HomeController;
use App\Http\Controllers\Blade\ApiUserController;
use App\Http\Controllers\Blade\CompanyController;

/*
|--------------------------------------------------------------------------
| Blade (front-end) Routes
|--------------------------------------------------------------------------
|
| Here is we write all routes which are related to web pages
| like UserManagement interfaces, Diagrams and others
|
*/

// Default laravel auth routes
Auth::routes();
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

// Welcome page
Route::get('/', function (){
    return redirect()->route('home');
})->name('welcome');

// Web pages
Route::group(['middleware' => 'auth'],function (){
//    GETALLORDERS
    Route::get('/all/orders',[App\Http\Controllers\Blade\DashboardController::class,'dashboard'])->name('dashboard');
    // Import
    Route::get('/import/index',[App\Http\Controllers\ImportController::class,'index'])->name('importIndex');
    Route::get('/import/create',[ImportController::class,'create'])->name('importCreate');
    Route::post('/import/store',[ImportController::class,'store'])->name('importStore');
    Route::get('/import/edit',[ImportController::class,'edit'])->name('importEdit');
    // Company
    Route::get('/company/index',[CompanyController::class,'index'])->name('companyIndex');
    Route::get('/company/create',[CompanyController::class,'create'])->name('companyCreate');
    Route::post('/company/store',[CompanyController::class,'store'])->name('companyStore');
    Route::get('/company/img',[CompanyController::class,'img'])->name('companyImg');
    Route::get('/company/edit/{id}',[CompanyController::class,'edit'])->name('companyEdit');
    Route::post('/company/update/{id}',[CompanyController::class,'update'])->name('companyUpdate');
    Route::get('/company/view/{id}',[CompanyController::class,'view'])->name('companyView');
    // Branch
    Route::get('/branch/index',[BranchController::class,'index'])->name('branchIndex');
    Route::get('/branch/create',[BranchController::class,'create'])->name('branchCreate');
    Route::post('/branch/store',[BranchController::class,'store'])->name('branchStore');
    Route::get('/branch/edit/{id}',[BranchController::class,'edit'])->name('branchEdit');
    Route::post('/branch/update/{id}',[BranchController::class,'update'])->name('branchUpdate');
    Route::get('/branch/view/{id}',[BranchController::class,'view'])->name('branchView');
//    MENEGER
    Route::get('/meneger/index',[MenagerController::class,'index'])->name('menegerIndex');
    Route::get('/meneger/create',[MenagerController::class,'create'])->name('menegerCreate');
    Route::post('/meneger/store',[MenagerController::class,'store'])->name('menegerStore');
    Route::get('/meneger/edit/{id}',[MenagerController::class,'edit'])->name('menegerEdit');
    Route::post('/meneger/update/{id}',[MenagerController::class,'update'])->name('menegerUpdate');
    Route::any('/meneger/delete/{id}',[MenagerController::class,'destroy'])->name('managerDelete');
//    MENGER END
//    =======================================
//    CASHIER
    Route::get('/cashier/index',[CashierController::class,'index'])->name('cashierIndex');
    Route::get('/cashier/create',[CashierController::class,'create'])->name('cashierCreate');
    Route::post('/cashier/store',[CashierController::class,'store'])->name('cashierStore');
    Route::get('/cashier/edit/{id}',[CashierController::class,'edit'])->name('cashierEdit');
    Route::post('/cashier/update/{id}',[CashierController::class,'update'])->name('cashierUpdate');
    Route::any('/cashier/delete/{id}',[CashierController::class,'destroy'])->name('cashierDelete');
//    CASHIER END
    Route::post('/import/barcode',[ImportController::class,'getbarcode'])->name('getBarCode');
    // there should be graphics, diagrams about total conditions
    Route::get('/home', [HomeController::class,'index'])->name('home');

    // Users
    Route::get('/users',[UserController::class,'index'])->name('userIndex');
    Route::get('/user/add',[UserController::class,'add'])->name('userAdd');
    Route::post('/user/create',[UserController::class,'create'])->name('userCreate');
    Route::get('/user/{id}/edit',[UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('userDestroy');
    Route::get('/user/theme-set/{id}',[UserController::class,'setTheme'])->name('userSetTheme');

    // Permissions
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissionIndex');
    Route::get('/permission/add',[PermissionController::class,'add'])->name('permissionAdd');
    Route::post('/permission/create',[PermissionController::class,'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit',[PermissionController::class,'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('permissionDestroy');

    // Roles
    Route::get('/roles',[RoleController::class,'index'])->name('roleIndex');
    Route::get('/role/add',[RoleController::class,'add'])->name('roleAdd');
    Route::post('/role/create',[RoleController::class,'create'])->name('roleCreate');
    Route::get('/role/{role_id}/edit',[RoleController::class,'edit'])->name('roleEdit');
    Route::post('/role/update/{role_id}',[RoleController::class,'update'])->name('roleUpdate');
    Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('roleDestroy');

    // ApiUsers
    Route::get('/api-users',[ApiUserController::class,'index'])->name('api-userIndex');
    Route::get('/api-user/add',[ApiUserController::class,'add'])->name('api-userAdd');
    Route::post('/api-user/create',[ApiUserController::class,'create'])->name('api-userCreate');
    Route::get('/api-user/show/{id}',[ApiUserController::class,'show'])->name('api-userShow');
    Route::get('/api-user/{id}/edit',[ApiUserController::class,'edit'])->name('api-userEdit');
    Route::post('/api-user/update/{id}',[ApiUserController::class,'update'])->name('api-userUpdate');
    Route::delete('/api-user/delete/{id}',[ApiUserController::class,'destroy'])->name('api-userDestroy');
    Route::delete('/api-user-token/delete/{id}',[ApiUserController::class,'destroyToken'])->name('api-tokenDestroy');

    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/add', [CategoryController::class, 'add']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/category/img/{resource}', [CategoryController::class, 'img']);
    Route::get('/category/view/{id}', [CategoryController::class, 'view']);

    Route::resource('products', ProductController::class);
    Route::get('product/delete/{product}', [ProductController::class, 'delete'])->name('productDelete');

    Route::get('import_export', [Import_Export_Controller::class, 'importExport']);
    Route::post('import_excel', [Import_Export_Controller::class, 'import']);
    Route::get('export_excel', [Import_Export_Controller::class, 'export']);

    Route::resource('orders', OrderController::class);

    Route::post('/order/create', [OrderController::class, 'create'])->name('order.create');



    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::any('/cart/delete/{product_id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cart/empty', [CartController::class, 'empty']);

    Route::get('/v2cart', [CartController::class, 'v2index'])->name('cart.v2index');

});

// Change language session condition
Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});

Route::get('/generate-barcode', [\App\Http\Controllers\HomeController::class, 'barcodeTest'])->name('generate.barcode');
Route::get('/generate-barcode', [\App\Http\Controllers\HomeController::class, 'barcodeTest'])->name('generate.barcode');

/*
|--------------------------------------------------------------------------
| This is the end of Blade (front-end) Routes
|-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\
*/
