<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });



// email start
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
// email end



Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\IndexController::class, 'frontendIndex']);



//user part start
Route::group(['prefix' =>'user/','middleware' => ['auth', 'is_user','verified']], function(){
    Route::get('dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    //profile
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [UserController::class, 'userProfileUpdate']);
    Route::post('changepassword', [UserController::class, 'changeUserPassword']);
    Route::put('image/{id}', [UserController::class, 'userImageUpload']);
    //  profile end

    //  fund request

    // Route::get('fund-request', [FundraiserController::class, 'fundRequest'])->name('fundrequest');
    Route::post('fund-request', [FundraiserController::class, 'fundRequestStore']);

    // fundraiser profile
    Route::get('fundraiser-profile', [FundraiserController::class, 'profile'])->name('fundraiser.profile');
    Route::get('fundraiser-academic-profile', [FundraiserController::class, 'academicProfile'])->name('fundraiser.academic-profile');
    Route::put('fundraiser-profile/{id}', [FundraiserController::class, 'updateProfile']);
    Route::post('fundraiser-academic-profile', [FundraiserController::class, 'addAcaProfile']);
    Route::post('class-schedule', [FundraiserController::class, 'addClassSchedule']);
    Route::get('class-schedule/{id}', [FundraiserController::class, 'scheduleDelete'])->name('schedule.destroy');
    Route::post('transcript', [FundraiserController::class, 'addTranscript']);
    Route::get('transcript/{id}', [FundraiserController::class, 'transcriptDelete'])->name('transcript.destroy');


    Route::get('fundraisering', [FundraiserController::class, 'myFundraisering'])->name('fundraisering');
    Route::post('fundraisering', [FundraiserController::class, 'FundraiseringStore']);

    // show all fund request
    Route::get('fundrequest', [FundraiserController::class, 'getFundrequest'])->name('fundrequest');
    Route::get('fundrequest/{id}/edit',[FundraiserController::class, 'fundRequestedit']);
    Route::put('fundrequest/{id}', [FundraiserController::class, 'updatefundRequest']);
    Route::get('fundrequest/{id}', [FundraiserController::class, 'fundRequestDelete'])->name('fundrequest.destroy');

    // favourite fundraiser
    Route::get('myfavourite-fundraiser', [FundraiserController::class, 'getFavFundraiser'])->name('favourite.show');

    // donation i made
    Route::get('mydonation', [FundraiserController::class, 'getDonationImade'])->name('mydonation');

    // fundraiser withdraw
    Route::get('withdraw', [TransactionController::class, 'withdraw'])->name('fundraiser.withdraw');
    Route::get('withdraw/{id}', [TransactionController::class, 'fundWithdraw'])->name('fundraiser.fundwithdraw');
    Route::post('withdraw', [TransactionController::class, 'cashout'])->name('withdraw.cashout');

    // password change
    Route::get('account-setting', [ProfileController::class, 'getAccountSetting'])->name('fundraiser.account');
    Route::post('account-setting', [ProfileController::class, 'changeUserPassword']);

    // doron profile
    Route::get('donor-profile', [DonorController::class, 'donorprofile'])->name('donor.profile');
    Route::put('donor-profile/{id}', [DonorController::class, 'updateProfile']);


});
//user part end







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\IndexController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\IndexController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\IndexController::class, 'saveContact']);
Route::get('/all-fundraiser', [App\Http\Controllers\FundraiserController::class, 'allFundraiser'])->name('all-fundraiser');
Route::get('/single-fundraiser/{id}', [App\Http\Controllers\FundraiserController::class, 'singleFundraiser'])->name('single-fundraiser');
Route::get('/donation/{id}', [App\Http\Controllers\FundraiserController::class, 'donation'])->name('donation');


Route::post('/comment', [App\Http\Controllers\CommentController::class, 'store']);
Route::post('/follow', [App\Http\Controllers\NotificationController::class, 'storeFollow']);
Route::get('/follow/{id}', [App\Http\Controllers\NotificationController::class, 'unFollow']);
//favourite added
Route::post('favourite', [App\Http\Controllers\NotificationController::class, 'favouriteStore']);

// strip
Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

// search
Route::get('/fundraiser-search', [IndexController::class, 'fundraisersearch'])->name('fundraiser.search');
