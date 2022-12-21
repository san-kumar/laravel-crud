<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('_parentrouteurlwithvars_', App\Http\Controllers\_controller_::class, [/*_asroute_*/]);
    //@softdelete
    Route::put('_routeurlwithvars_/restore', [App\Http\Controllers\_controller_::class, 'restore'])->name('_route_.restore');
    Route::delete('_routeurlwithvars_/purge', [App\Http\Controllers\_controller_::class, 'purge'])->name('_route_.purge');
    //@endsoftdelete
});
