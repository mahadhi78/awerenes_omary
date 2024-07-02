<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\FaqsController;
use App\Http\Controllers\Course\LessonController;
use App\Http\Controllers\Course\ModuleController;
use App\Http\Controllers\Course\CourrseController;
use App\Http\Controllers\Phishing\CompaignController;
use App\Http\Controllers\Phishing\PhishingController;
use App\Http\Controllers\Phishing\TemplateController;


Route::get('/course/preview/{id}', [CourrseController::class, 'coursePreview'])->name('course.preview');

Route::get('/module/preview/{id}', [ModuleController::class, 'modulePreview'])->name('module.preview');
Route::get('/faqs/preview/{id}', [FaqsController::class, 'preview'])->name('faqs.preview');

Route::post('/phishing/{temp_name}/{user_id}', [PhishingController::class, 'storePhished'])->name('phishing.storePhished');
// ->where('temp_name', '\d{4}(?:\/|\-|\_)(?:\d{2,10})')


Route::group(['prefix' => 'system'], function () {
    Route::get('/course', [CourrseController::class, 'index'])->name('course.list');
    Route::post('/course/save', [CourrseController::class, 'store'])->name('course.save');
    Route::get('/course/edit/{id}', [CourrseController::class, 'edit'])->name('course.edit');
    Route::post('/course/update', [CourrseController::class, 'update'])->name('course.update');
    Route::post('/course/delete', [CourrseController::class, 'destroy'])->name('course.destroy');


    /// modules
    Route::get('/module', [ModuleController::class, 'index'])->name('module.list');
    Route::post('/module/save', [ModuleController::class, 'store'])->name('module.save');
    Route::get('/module/edit/{id}', [ModuleController::class, 'edit'])->name('module.edit');
    Route::post('/module/update', [ModuleController::class, 'update'])->name('module.update');
    Route::post('/module/delete', [ModuleController::class, 'destroy'])->name('module.destroy');


    /// lessons
    Route::get('/lesson', [LessonController::class, 'index'])->name('lesson.list');
    Route::get('/lesson/create', [LessonController::class, 'create'])->name('lesson.create');
    Route::post('/lesson/save', [LessonController::class, 'store'])->name('lesson.save');
    Route::get('/lesson/edit/{id}', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::post('/lesson/update', [LessonController::class, 'update'])->name('lesson.update');
    Route::post('/lesson/delete', [LessonController::class, 'destroy'])->name('lesson.destroy');

    // phishing
    Route::get('/phishing', [PhishingController::class, 'index'])->name('phishing.list');
    Route::get('/phishing/post', [PhishingController::class, 'create'])->name('phishing.create');
    Route::post('/phishing/save', [PhishingController::class, 'store'])->name('phishing.save');



    //compaign
    Route::get('/compaign', [CompaignController::class, 'index'])->name('compaign.list');
    Route::post('/compaign/save', [CompaignController::class, 'store'])->name('compaign.save');
    Route::get('/compaign/edit', [CompaignController::class, 'edit'])->name('compaign.edit');
    Route::post('/compaign/update', [CompaignController::class, 'update'])->name('compaign.update');
    Route::post('/compaign/delete', [CompaignController::class, 'destroy'])->name('compaign.destroy');

    //template
    Route::post('/template/save', [TemplateController::class, 'store'])->name('template.save');
    Route::get('/template/edit', [TemplateController::class, 'edit'])->name('template.edit');
    Route::post('/template/update', [TemplateController::class, 'update'])->name('template.update');
    Route::post('/template/delete', [TemplateController::class, 'destroy'])->name('template.destroy');


    Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.list');
    Route::get('/faqs/create', [FaqsController::class, 'create'])->name('faqs.create');
    Route::post('/faqs/save', [FaqsController::class, 'store'])->name('faqs.save');
    Route::get('/faqs/edit', [FaqsController::class, 'edit'])->name('faqs.edit');
    Route::post('/faqs/update', [FaqsController::class, 'update'])->name('faqs.update');
    Route::post('/faqs/delete', [FaqsController::class, 'destroy'])->name('faqs.destroy');
});
Route::post('/upload/image', [TemplateController::class, 'uploadImage'])->name('upload.image');
