<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;

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

Route::get("/", function () {
    return view("frontend.index");
});

// Controller for all admin route methods
Route::controller(AdminController::class)->group(function () {
    Route::get("/admin/logout", "destroy")->name("admin.logout");
    Route::get("/admin/profile", "profile")->name("admin.profile");
    Route::get("/edit/profile", "edit")->name("edit.profile");

    Route::post("/store/profile", "StoreProfile")->name("store.profile");

    Route::get("/change/password", "ChangePassword")->name("change.password");
    Route::post("/update/password", "UpdatePassword")->name("update.password");
});

// Controller for Home Slide Setup Routes
Route::controller(HomeSliderController::class)->group(function () {
    Route::get("/home/slide", "HomeSlider")->name("home.slide");

    Route::post("/update/slide", "UpdateSlider")->name("update.slider");
});

// Controller For the About Page Setup Routes
Route::controller(AboutController::class)->group(function () {
    Route::get("/about/page", "AboutPage")->name("about.page");
    Route::get("/about", "HomeAbout")->name("home.about");
    // Multi Image Route
    Route::get("/about/multi-image", "MultiImage")->name("multi.image");
    Route::get("/all/multi-image", "AllMultiImage")->name("all.multi.image");
    Route::get("/edit/multi-image/{id}", "EditMultiImage")->name(
        "edit.multi.image"
    );
    Route::get("/delete/multi-image/{id}", "DeleteMultiImage")->name(
        "delete.multi.image"
    );

    Route::post("/about/update", "UpdateAbout")->name("update.about");
    Route::post("/store/multi-image", "StoreImages")->name("store.multi.image");
    Route::post("/update/multi-image", "UpdateImages")->name(
        "update.multi.image"
    );
});

// Route for all Portfolio Methods
Route::controller(PortfolioController::class)->group(function () {
    Route::get("/portfolio/all", "PortfolioPage")->name("portfolio.page");
    Route::get("/portfolio/add", "AddPortfolio")->name("add.portfolio");
    Route::get("/portfolio/edit/{id}", "EditPortfolio")->name("edit.portfolio");

    Route::post("/portfolio/store", "StorePortfolio")->name("store.portfolio");
    Route::post("/portfolio/update", "UpdatePortfolio")->name(
        "update.portfolio"
    );
});

// Dashboard Route
Route::get("/dashboard", function () {
    return view("admin.index");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

require __DIR__ . "/auth.php";
