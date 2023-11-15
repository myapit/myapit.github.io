    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hai', function () {
    return 'Hello World';
});

Route::resource('staffs', StaffController::class);
//Route::get('/staffs', [StaffController::class, 'index']);

//Route::get('/staffs', 'App\Http\Controllers\StaffController@index');
//Route::get('/staffs', [StaffController::class,'index']);