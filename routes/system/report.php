<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\NewsController;
use App\Http\Controllers\Reports\ReportController;
use App\Http\Controllers\Reports\ReportTypeController;

Route::get('/report/edit{id}', [ReportController::class, 'edit'])->name('report_edit.list');

Route::get('/news/{id}', [NewsController::class, 'getFileContents'])->name('news_edit.list');

Route::group(['prefix' => 'system'], function () {
    Route::get('/type', [ReportTypeController::class, 'index'])->name('type.list');
    Route::post('/type/save', [ReportTypeController::class, 'store'])->name('type.save');
    Route::get('/type/edit/{id}', [ReportTypeController::class, 'edit'])->name('type.edit');
    Route::post('/type/update', [ReportTypeController::class, 'update'])->name('type.update');
    Route::post('/type/delete', [ReportTypeController::class, 'destroy'])->name('type.destroy');

    // send and preview reports
    Route::get('/report', [ReportController::class, 'index'])->name('report.list');
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/save', [ReportController::class, 'store'])->name('report.save');
    Route::get('/report/edit/{id}', [ReportController::class, 'create'])->name('report.edit');
    Route::post('/report/update', [ReportController::class, 'update'])->name('report.update');
    Route::post('/report/delete', [ReportController::class, 'destroy'])->name('report.destroy');


    // send and preview news
    Route::post('/news/upload', [NewsController::class, 'upload'])->name('news.upload');

    Route::get('/news', [NewsController::class, 'index'])->name('news.list');
    Route::post('/news/save', [NewsController::class, 'store'])->name('news.save');
    Route::post('/news/update', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news/delete', [NewsController::class, 'destroy'])->name('news.destroy');
});
