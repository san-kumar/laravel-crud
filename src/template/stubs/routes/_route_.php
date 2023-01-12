<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\_controller_;

Route::middleware(['auth'])->group(function () {
    Route::resource('_parentrouteurlwithvars_', _controller_::class, [/*_asroute_*/]);
    //@softdelete
    Route::put('_routeurlwithvars_/restore', [_controller_::class, 'restore'])->name('_route_.restore');
    Route::delete('_routeurlwithvars_/purge', [_controller_::class, 'purge'])->name('_route_.purge');
    //@endsoftdelete
});
