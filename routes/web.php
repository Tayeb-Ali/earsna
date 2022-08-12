<?php

use App\Http\Controllers\Admin\{
    AdvertisementController,
    BusinessFieldController,
    ClientController,
    FeatureController,
    PackageController,
    SubscriptionController,
};
use App\Http\Controllers\Client\{
    AvailableBookingTimeController,
    BookingController,
    BookingTimeController,
    CustomerController,
    OfferController,
    ServiceController,
    SupplierController,
};
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SettingController;
use App\Models\Admin\Client;
use App\Models\Client\Booking;
use App\Models\Hall;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', function () {
        return view('home');
    });
//        return Auth::check()
//            ? (request()->user()->isClient() ? redirect()->route('halls.index') : redirect()->route('admin.dashboard'))
//            : (redirect()->route('login'));
//    });

    Route::middleware(['auth'])->group(function () {
        // Admin Routes
        Route::get('/dashboard', [DashboardController::class, 'showAdminDashboard'])->name('admin.dashboard');

        Route::resource('features', FeatureController::class)->except(['show']);

        Route::resource('packages', PackageController::class)->except(['show']);

        Route::resource('clients', ClientController::class)->except(['show']);

        Route::get('clients/set', function (Request $request) {
            $request->validate(['client_id' => ['required', 'exists:clients,id']]);

            return back()->withClient(Client::findOrFail($request->client_id));
        });

        Route::resource('business-fields', BusinessFieldController::class)->except(['show']);

        Route::resource('subscriptions', SubscriptionController::class)->except(['show']);

        Route::resource('advertisements', AdvertisementController::class);

        // Client Routes
        Route::prefix('/halls/{hall}/')->name('halls.')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'showHallDashboard'])->name('dashboard');

            Route::resource('bookings', BookingController::class);

            Route::post('/bookings/{booking}/payment', [BookingController::class, 'makePayment'])
                ->name('bookings.payment');

            Route::get('/bookings/{booking}/pdf', function (Hall $hall, Booking $booking) {
                return Pdf::loadView('client.bookings.pdf', ['booking' => $booking])->download('client.bookings.pdf');
            })->name('bookings.pdf');

            Route::resource('booking-times', BookingTimeController::class);

            Route::resource('customers', CustomerController::class);

            Route::resource('suppliers', SupplierController::class);

            Route::resource('services', ServiceController::class);

            Route::resource('booking-times', BookingTimeController::class);

            Route::get('available-booking-times', AvailableBookingTimeController::class)->name('available-booking-times');

            Route::resource('offers', OfferController::class);

            Route::get('/settings', [SettingController::class, 'index'])->name('settings');

            Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');
        });

        // Admin And Client Routes
        Route::resource('halls', HallController::class)->except(['show']);

        Route::resource('users', UserController::class)->except(['show']);

        Route::resource('expenses', ExpenseController::class)->except(['show']);

        Route::resource('revenues', RevenueController::class)->except(['show']);

        Route::resource('reports', ReportController::class);

        Route::get('/reporst/{report}/pdf', function (Report $report) {
            return Pdf::loadView('reports.pdf', ['report' => $report])->download('reports.pdf');
        })->name('reports.pdf');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');

        Route::patch('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');

        Route::prefix('/profile')->group(function () {
            Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
            Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        });
    });

    require __DIR__ . '/auth.php';
});
