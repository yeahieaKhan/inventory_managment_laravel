<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserContorller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVarificationMiddleware;
use App\Http\Middleware\TokenVerificationMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOtpCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset', [UserController::class, 'ResetPassword'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware([TokenVarificationMiddleware::class]);


Route::get('/logout', [UserController::class, 'UserLogout']);
//pages
Route::get('/', [HomeController::class, 'HomePage']);
Route::get('/login', [UserController::class, 'UserLoginPage']);
Route::get('/userRegistaion', [UserController::class, 'RegistationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOTPPage', [UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([TokenVarificationMiddleware::class]);

// category page
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage']);
// Customer page
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/invoicePage', [InvoiceController::class, 'InvoicePage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/salePage', [InvoiceController::class, 'SalePage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/reportPage', [ReportController::class, 'ReportPage'])->middleware([TokenVarificationMiddleware::class]);


    




// category API
Route::get('/categoryList', [CategoryController::class, 'CategoryList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/create-category', [CategoryController::class, 'CategoryCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/create-delete', [CategoryController::class, 'CategoryDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/create-update', [CategoryController::class, 'CategoryUpdate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/category-by-id', [CategoryController::class, 'CategoryByID'])->middleware([TokenVarificationMiddleware::class]);




// customer api


Route::post('/customer-create', [CustomerController::class, 'CreateCustomer'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/customer-list', [CustomerController::class, 'CustomerList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-delete', [CustomerController::class, 'CustomerDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-update', [CustomerController::class, 'CustomerUpdate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerByID'])->middleware([TokenVarificationMiddleware::class]);



// product api 

Route::post('/product-create', [ProductController::class, 'ProductCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/product-list', [ProductController::class, 'ProductList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/product-delete', [ProductController::class, 'DeleteProduct'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/product-update', [ProductController::class, 'UpdateProduct'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/product-by-id', [ProductController::class, 'ProductByID'])->middleware([TokenVarificationMiddleware::class]);







// invoice api

Route::post('/create-invoice', [InvoiceController::class, 'invoiceCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/select-invoice', [InvoiceController::class, 'SelecetInvoice'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/detail-invoice', [InvoiceController::class, 'InvoiceDetails'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/delete-invoice', [InvoiceController::class, 'invoiceDelete'])->middleware([TokenVarificationMiddleware::class]);


Route::post('/sales-report', [ReportController::class, 'SalesReport'])->middleware([TokenVarificationMiddleware::class]);

// repost summapy 
Route::get('/summary', [DashboardController::class, 'Summary'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/sales-report/{FormDate}/{ToDate}', [ReportController::class, 'SalesReport'])->middleware([TokenVarificationMiddleware::class]);
