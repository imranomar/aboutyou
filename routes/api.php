<?php

use App\Cts;
use Illuminate\Http\Request;
use App\Http\Middleware\AuthBasic;
use App\User;
use Illuminate\Hashing\BcryptHasher;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('AuthBasic')->post('/multiply', 'MatrixContoller@multiply')->name('mul');
Route::post('/toletters', 'MatrixContoller@intToLetters')->name('intToLetters');
Route::post('register', function (Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'password' => 'required|confirmed|min:8',
        'email' => 'email|required|unique:users',
    ]);

    //if validation fails
    if ($validator->fails())
    {
        return response(json_encode(array(
            'error' => true,
            'message' => $validator->errors()->all()
        )),Cts::HTTP_UNPROCESSABLE_ENTITY);
    };

    $user = new User();

    //adding values to the users
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));

    //save the user to database
    $user->save();

    //unsetting the password so that it will not be returned
    unset($user->password);

    //returning the registered user
    return array('error' => false, 'user' => $user);
});
