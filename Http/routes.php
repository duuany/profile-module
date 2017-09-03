<?php

Route::group([
    'middleware' => 'web',
    'prefix'     => 'profile',
    'namespace'  => 'Modules\Profile\Http\Controllers'
], function () {

    Route::get('{email}', 'ProfileController@show')->name('profile.show');
    Route::get('{email}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::get('{email}/create', 'ProfileController@create')->name('profile.create');

    Route::post('', 'ProfileController@store')->name('profile.store');
    Route::put('{profile}', 'ProfileController@update')->name('profile.update');

    Route::delete('{profile}', 'ProfileController@destroy')->name('profile.destroy');

});
