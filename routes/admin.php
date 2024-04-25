<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->name("admin.")->group(function(){
    Route::middleware(['auth:admin'])->group(function(){
        Route::view("home","admin.pages.home")->name("home");
        // Categories
        Route::view("categories","admin.pages.categories")->name("categories");
        // Books 
        Route::view("books","admin.pages.books")->name("books");
        Route::post("create/book",[AjaxController::class,'createBook'])->name("create_book");

        // Sellers
        Route::view("sellers","admin.pages.sellers")->name("sellers");

        // Auth 
        Route::post("logout",[AdminController::class,'logout'])->name("logout");
        
        // Notification
        Route::view("notification","admin.pages.notification")->name("notification");

        Route::view("customers","admin.pages.customers")->name("customers");
        
    });
});

Route::prefix("sellers")->name("sellers.")->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::view("home","admin.pages.home")->name("home");
        // Categories
        Route::view("categories","admin.pages.categories")->name("categories");
        // Books 
        Route::view("books","admin.pages.books")->name("books");

        Route::post("create/customer",[AjaxController::class,'creatCustomer'])->name("create_customer");

        Route::view("history","sellers.pages.history")->name("history");

        Route::view("carts","sellers.pages.cart")->name("cart");


    });
});



Route::middleware(['guest:admin'])->group(function(){
    Route::view("/login/admin","admin.pages.auth.login")->name("admin.login");
});





