<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');


Route::middleware(['auth','admin', 'verified'])->group(function () {

    Route::prefix('admin')->group(function () {
        //Menu
        Route::resource('menu', 'MenuController')->except(['show','create']);

        //Page
        Route::resource('page', 'PageController')->except(['create']);


        Route::get('/research', 'ResearchController@researchAdmin')->name('admin.research');
        Route::get('/research/statusEdit/{id}', 'ResearchController@adminEdit')->name('admin.research.admin.edit');
        Route::post('/research/statusUpdate/{id}', 'ResearchController@adminUpdate')->name('admin.research.admin.update');

        //Page
        //TODO:: Clean the route below. Only keep necessary route methods.
        Route::resource('page-item', 'PageItemController')->except(['create']);

        //Sector
        Route::resource('sector', 'SectorController')->except(['show','create']);

        //Company
        Route::resource('company', 'CompanyController')->except(['create']);

        //TODO::Fix typo
        //Announcment
        Route::resource('announcment', 'AnnouncmentController')->except(['show','create']);

        //SubscriptionPlan
        Route::resource('subscriptionplan', 'SubscriptionPlanController')->except(['show','create']);


         //Survey
        Route::resource('survey', 'SurveyController')->except(['create']);



        //SurveyQuestion
        Route::resource('surveyquestion', 'SurveyQuestionController')->except(['create']);

        //Configuration
        Route::get('/configuration', 'StaticContentController@index')->name('configuration.index');
        Route::get('/configuration/{id}/edit', 'StaticContentController@edit')->name('configuration.edit');
        Route::patch('/configuration/{id}','StaticContentController@update')->name('configuration.update');

        //SurveyAnswerOption
        Route::resource('surveyansweroption', 'SurveyAnswerOptionController')->except(['show', 'create']);

        //News
        Route::get('/news-portal', 'NewsController@newsPortal')->name('news.portal');
        Route::post('/news-portal', 'NewsController@newsStore')->name('news.store');
        Route::get('/news-portal/{id}/edit', 'NewsController@newsEdit')->name('news.edit');
        Route::patch('/news-portal/{id}', 'NewsController@newsUpdate')->name('news.update');
        Route::delete('/news-portal/{id}', 'NewsController@newsDestroy')->name('news.destroy');
        // Route::get('/news-portal', function () {
        //   return view('back-end.news.index');
        // });

        //category
        Route::resource('category', 'CategoryController')->except(['show','create']);

        // research category
        Route::get('/category', 'CategoryController@researchCategory')->name('admin.category');
        Route::post('/category/store', 'CategoryController@researchCategoryStore')->name('admin.category.store');

        //Most Recent
        Route::get('/most-recent', 'MostRecentController@index')->name('recent.index');
        Route::post('/most-recent', 'MostRecentController@store')->name('recent.store');
        Route::get('/most-recent/{id}/edit', 'MostRecentController@edit')->name('recent.edit');
        Route::patch('/most-recent/{id}', 'MostRecentController@update')->name('recent.update');
        Route::delete('/most-recent/{id}', 'MostRecentController@destroy')->name('recent.destroy');
        // Route::get('/news-portal', function () {

        //User
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::post('/user/store', 'UserController@store')->name('user.store');
        Route::get('/user/{id}', 'UserController@edit')->name('user.edit');
        Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
        Route::patch('/user/{id}', 'UserController@update')->name('user.update');
        Route::delete('/user/{id} ', 'UserController@destroy')->name('user.destroy');

        //Finance Info
        //TODO:: constrain routes
        Route::resource('finance-info', 'FinanceInfoController');


        Route::get('/stockinfo', 'StockInfoController@index')->name('stockinfo.index');

        Route::get('/stockinfo/bulk', 'StockInfoController@uploadBulk')->name('stockinfo.upload-bulk');
        Route::post('/stockinfo/bulk', 'StockInfoController@storeBulk')->name('stockinfo.store-bulk');

        //invoice
        Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
        Route::get('/stockinfo/data-matrix', 'StockInfoController@dataMatrix')->name('stockinfo.data-matrix');
        Route::post('/stockinfo', 'StockInfoController@process')->name('stockinfo.process');
    });

    //Page
    // Route::resource('page', 'PageController')->except(['show']);
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
  Route::prefix('user')->group(function () {
      Route::post('survey/{surveyQuestion}', 'SurveyController@saveResponse')->name('save-response');
  });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('subscriptionplan/success', 'SubscriptionPlanController@success')->name('subscriptionplan.success');
    Route::post('subscriptionplan/fail', 'SubscriptionPlanController@fail')->name('subscriptionplan.fail');

    //invoice
    Route::get('/invoice-user', 'InvoiceController@invoiceUser')->name('invoice.user');
    Route::get('/invoice/getuser', 'InvoiceController@getUser')->name('invoice.getuser');
    Route::get('/invoice/{id}', 'InvoiceController@invoiceShow')->name('invoice.show');
    Route::post('/invoice/postuser', 'InvoiceController@postUser')->name('invoice.postuser');

    Route::get('/research', 'ResearchController@researchUser')->name('research');
    Route::get('/research/create', 'ResearchController@create')->name('research.create');
    Route::post('/research/store', 'ResearchController@store')->name('research.store');

    Route::delete('/subscriber/{id}', 'InvoiceController@destroy')->name('subscriber.destroy');

    Route::get('/purchased-item', 'ResearchController@purchasedItem')->name('purchased.item');


    //download
    Route::post('download', 'DownloadController@store')->name('download.store');
});


Route::get('/', 'PublicPagesController@landing')->name('home');
Route::view('/sub', 'sub-layout')->name('sub');


//Financial Info
Route::get('/finance-info', 'FinanceInfoController@all')->name('finance-info-all');

//filter
Route::get('/filter', 'FinanceInfoController@financeFilter')->name('financefilter');

//search
Route::get('/search', 'PublicPagesController@search')->name('search');
Route::get('/newssearch', 'NewsController@newsSearch')->name('newssearch');

//mail
Route::post('/contact-us', 'PublicPagesController@contactUs')->name('contactus');
Route::post('/subscribe', 'PublicPagesController@subscribe')->name('subscribe');

//News
Route::get('/news', 'NewsController@index')->name('news.index');
Route::get('/single-news/{id}', 'NewsController@singleNews')->name('news.single');
Route::get('/news/{category}', 'NewsController@newsByCategoty')->name('news.bycategoty');
// Route::get('/news', function () {
//   return view('front-end.news.index');
// });
// Route::get('/single-news', function () {
//   return view('front-end.news.single-news');
// });

Route::get('/visualize', 'VisualizeController@index')->name('visualize.index');

Route::get('/data-matrix', 'VisualizeController@dataMatrix')->name('visualize.data-matrix');
Route::post('/subscribe-plan', 'SubscriptionPlanController@subscribePlan')->name('subscribe.plan');

Route::get('/terms-conditions', function () {
  return view('front-end.legal.terms');
});

Route::get('/refund-policy', function () {
  return view('front-end.legal.refund');
});

Route::get('/privacy-policy', function () {
  return view('front-end.legal.privacy');
});

//comment
Route::post('/comment', 'CommentController@store')->name('comment.store');
Route::get('/comment/{id}/edit', 'CommentController@edit')->name('comment.edit');
Route::patch('/comment/{id}', 'CommentController@update')->name('comment.update');
Route::patch('/commentadmin/{id}', 'CommentController@commentAdmin')->name('commentAdmin.update');
Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');

//Cart
Route::group(['prefix' => 'cart'], function() {
    Route::get('', 'CartController@index')->name('cart');
    Route::get('{id}', 'CartController@cart')->name('addtocart');
    Route::get('delete/{id}', 'CartController@delete')->name('cart.item.delete');
});
//Checkout
//Route::post('/checkout', 'CheckOutController@checkoutPage')->name('checkout');
Route::post('/checkout', 'CheckOutController@checkOut')->name('checkout');
Route::any('/payment-complete', 'CheckOutController@paymentComplete')->name('payment.complete');

Route::get('/research-list', 'ResearchController@index')->name('research.list');


//Page
Route::get('{slug}', 'PageController@page')->name('page');



