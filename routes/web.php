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
        Route::get('/research-category', 'CategoryController@researchCategory')->name('admin.research.category');
        Route::post('/research-category/store', 'CategoryController@researchCategoryStore')->name('admin.research.category.store');
        Route::get('/research-category/edit/{id}', 'CategoryController@researchCategoryEdit')->name('admin.research.category.edit');
        Route::post('/research-category/update/{id}', 'CategoryController@researchCategoryUpdate')->name('admin.research.category.update');
        Route::delete('/research-category/delete/{id}', 'CategoryController@researchCategoryDelete')->name('admin.research.category.delete');

        //Most Recent
        Route::get('/most-recent', 'MostRecentController@index')->name('recent.index');
        Route::post('/most-recent', 'MostRecentController@store')->name('recent.store');
        Route::get('/most-recent/{id}/edit', 'MostRecentController@edit')->name('recent.edit');
        Route::patch('/most-recent/{id}', 'MostRecentController@update')->name('recent.update');
        Route::delete('/most-recent/{id}', 'MostRecentController@destroy')->name('recent.destroy');
        // Route::get('/news-portal', function () {

        //User
//        Route::get('/user', 'UserController@index')->name('user.index');
//        Route::get('/user/create', 'UserController@create')->name('user.create');
//        Route::post('/user/store', 'UserController@store')->name('user.store');
//        Route::get('/user/{id}', 'UserController@edit')->name('user.edit');
//        Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
//        Route::patch('/user/{id}', 'UserController@update')->name('user.update');
//        Route::delete('/user/{id} ', 'UserController@destroy')->name('user.destroy');

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

        Route::get('/offline-payments', 'OfflinePaymentController@index')->name('offline.payments');
        Route::get('/offline-payments/details/{invoice_id}', 'OfflinePaymentController@invoiceDetails')->name('offline.payments.details');
        Route::get('/offline-payments/approve/{invoice_id}', 'OfflinePaymentController@approvePayment')->name('offline.payments.approve');
        Route::get('/offline-payments/delete/{invoice_id}', 'OfflinePaymentController@deletePayment')->name('offline.payments.delete');

        //newspaper section
        Route::get('newspapers', 'NewspaperController@index')->name('newspapers');
        Route::get('newspapers/create', 'NewspaperController@create')->name('newspapers.create');
        Route::post('newspapers/store', 'NewspaperController@store')->name('newspapers.store');
        Route::get('newspapers/edit/{id}', 'NewspaperController@edit')->name('newspapers.edit');
        Route::post('newspapers/update/{id}', 'NewspaperController@update')->name('newspapers.update');

        //tutorial routes
        Route::group(['prefix' => 'trainings'], function(){
            Route::get('/','TutorialController@adminIndex')->name('tutorial.index');
            Route::get('/create','TutorialController@create')->name('tutorial.create');
            Route::get('/update-status/{id}', 'TutorialController@updateStatus')->name('tutorial.update.status');
            Route::get('/details/{id}', 'TutorialController@tutorialDetails')->name('tutorial.details');
            Route::post('/create','TutorialController@storeTutorial')->name('tutorials.create.post');
            Route::get('/create/category','TutorialController@categoryView')->name('tutorials.create.category');
            Route::post('/create/category','TutorialController@addCategory')->name('tutorials.create.category.post');
        });

        Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function(){
            Route::get('/', 'NewsletterController@index')->name('newsletter.index');
            Route::get('/create', 'NewsletterController@create')->name('newsletter.create');
            Route::post('/store', 'NewsletterController@store')->name('newsletter.store');
            Route::get('/edit/{id}', 'NewsletterController@edit')->name('newsletter.edit');
            Route::post('/update/{id}', 'NewsletterController@update')->name('newsletter.update');
            Route::get('/delete/{id}', 'NewsletterController@delete')->name('newsletter.delete');
        });

        Route::group(['prefix' => 'newsletter-category', 'namespace' => 'Newsletter'], function(){
            Route::get('/', 'NewsletterCategoryController@index')->name('nl_category.index');
            Route::post('/store', 'NewsletterCategoryController@store')->name('nl_category.store');
            Route::get('/edit/{id}', 'NewsletterCategoryController@edit')->name('nl_category.edit');
            Route::post('/update/{id}', 'NewsletterCategoryController@update')->name('nl_category.update');
            Route::get('/delete/{id}', 'NewsletterCategoryController@delete')->name('nl_category.delete');
        });

        Route::group(['prefix' => 'topnews' , 'namespace' => 'Topnews'], function (){
            Route::get('/', 'TopnewsController@index')->name('topnews.index');
            Route::get('/create', 'TopnewsController@create')->name('topnews.create');
            Route::post('/store', 'TopnewsController@store')->name('topnews.store');
            Route::get('/edit/{id}', 'TopnewsController@edit')->name('topnews.edit');
            Route::post('/update/{id}', 'TopnewsController@update')->name('topnews.update');
            Route::get('/delete/{id}', 'TopnewsController@delete')->name('topnews.delete');
        });
    });

    //Page
    // Route::resource('page', 'PageController')->except(['show']);
});

Route::group(['middleware' => ['auth', 'verified', 'canModifyUser'], 'prefix' => 'modify'], function (){
    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/{id}', 'UserController@edit')->name('user.edit');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/user/{id}', 'UserController@update')->name('user.update');
    Route::delete('/user/{id} ', 'UserController@destroy')->name('user.destroy');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
  Route::prefix('user')->group(function () {
      Route::post('survey/{surveyQuestion}', 'SurveyController@saveResponse')->name('save-response');
  });
});

Route::middleware(['auth', 'verified'])->group(function () {
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


    //for you filter
//    Route::get('news-for-you', 'NewsForYouController@index')->name('news.for.you');
//    Route::post('news-for-you', 'NewsForYouController@store')->name('news.for.you.post');

    Route::group(['prefix' => 'tutorials'], function (){
        Route::get('/payment/{tutorial_id}','TutorialController@makePayment')->name('tutorials.payment');
    });

    //drb payment routes
    Route::post('drb-payment-success', 'SslPaymentController@makePaymentOnSuccess')->name('drb.payment.success');
    Route::post('drb-payment-fail', 'SslPaymentController@handleFailedPayment')->name('drb.payment.fail');
});

//tutorial
Route::group(['prefix' => 'trainings'], function (){
    Route::get('/view/{category_id?}','TutorialController@index')->name('tutorials.view.index');
    Route::get('/{id}/details','TutorialController@showDetails')->name('tutorials.details');
    Route::get('/add-to-calendar/{id?}','TutorialController@addToCalendar')->name('tutorials.add.to.calendar');
});

//filtered news
Route::get('filtered-news', 'NewsForYouController@getFilteredNews')->name('filtered.news');


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
//Route::get('/news', 'NewsController@index')->name('news.index');
//Route::get('/single-news/{id}', 'NewsController@singleNews')->name('news.single');
//Route::get('/news/{category}', 'NewsController@newsByCategoty')->name('news.bycategoty');
//Route::get('/news/newspaper/{id}', 'NewsController@newsByNewspaper')->name('news.bynewspaper');

Route::group(['prefix' => 'newsletters', 'namespace' => 'Newsletter'], function (){
    Route::get('/{category_id?}', 'NewsletterFrontendController@index')->name('newsletters.index');
    Route::get('/single-newsletter/{id}', 'NewsletterFrontendController@getSingleNewsletter')->name('newsletters.single.newsletter');
    Route::get('/category/{last_newsletter_id}/{category_id?}/{publishing_date?}', 'NewsletterFrontendController@getNewsletterByCategory')->name('newsletters.by.category');
});

Route::get('/visualize', 'VisualizeController@index')->name('visualize.index');

//Route::get('/data-matrix', 'VisualizeController@dataMatrix')->name('visualize.data-matrix');
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

Route::get('/research-list', 'ResearchController@index')->name('research.list');
Route::get('/pricing', 'PricingController@index')->name('pricing');

Route::get('test-mail', function (){
    //testing supervisor and jobs
    \Illuminate\Support\Facades\Mail::to('testuser@gmail.com')->send(new \App\Mail\TestMail());
    return 'check job';
});

//Page
Route::get('{slug}', 'PageController@page')->name('page');



