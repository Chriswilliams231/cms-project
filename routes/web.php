<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\ServiceController;

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
// Home Page for the frontend
Route::get("/", function () {
    return view("frontend.index");
})->name("home");

// Controller for all admin route methods
Route::middleware(["auth"])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get("/admin/logout", "destroy")->name("admin.logout");
        Route::get("/admin/profile", "profile")->name("admin.profile");
        Route::get("/edit/profile", "edit")->name("edit.profile");
        Route::get("/change/password", "ChangePassword")->name(
            "change.password"
        );

        // All POST Methods
        Route::post("/store/profile", "StoreProfile")->name("store.profile");
        Route::post("/update/password", "UpdatePassword")->name(
            "update.password"
        );
    });
});

// Controller for Home Slide Setup Routes
Route::middleware(["auth"])->group(function () {
    Route::controller(HomeSliderController::class)->group(function () {
        Route::get("/home/slide", "HomeSlider")->name("home.slide");

        // All POST Methods
        Route::post("/update/slide", "UpdateSlider")->name("update.slider");
    });
});

// Controller For the About Page Setup Routes
Route::controller(AboutController::class)->group(function () {
    Route::get("/about/page", "AboutPage")
        ->middleware("auth")
        ->name("about.page");

    Route::get("/about", "HomeAbout")->name("home.about");
    // Multi Image Routes
    Route::get("/about/multi-image", "MultiImage")
        ->middleware("auth")
        ->name("multi.image");

    Route::get("/all/multi-image", "AllMultiImage")
        ->middleware("auth")
        ->name("all.multi.image");

    Route::get("/edit/multi-image/{id}", "EditMultiImage")
        ->middleware("auth")
        ->name("edit.multi.image");

    Route::get("/delete/multi-image/{id}", "DeleteMultiImage")->name(
        "delete.multi.image"
    );

    // All POST Methods
    Route::post("/about/update", "UpdateAbout")->name("update.about");
    Route::post("/store/multi-image", "StoreImages")->name("store.multi.image");
    Route::post("/update/multi-image", "UpdateImages")->name(
        "update.multi.image"
    );
});

// Route for all Portfolio Methods
Route::controller(PortfolioController::class)->group(function () {
    Route::get("/portfolio/all", "PortfolioPage")
        ->middleware("auth")
        ->name("portfolio.page");

    Route::get("/portfolio/add", "AddPortfolio")
        ->middleware("auth")
        ->name("add.portfolio");

    Route::get("/portfolio/edit/{id}", "EditPortfolio")
        ->middleware("auth")
        ->name("edit.portfolio");

    Route::get("/portfolio/delete/{id}", "DeletePortfolio")->name(
        "delete.portfolio"
    );
    Route::get("/portfolio/details/{id}", "PortfolioDetails")->name(
        "portfolio.details"
    );
    Route::get("/portfolio", "HomePortfolio")->name("home.portfolio");

    // All POST Methods
    Route::post("/portfolio/store", "StorePortfolio")->name("store.portfolio");
    Route::post("/portfolio/store-message", "PortfolioMessage")->name(
        "portfolio.message"
    );
    Route::post("/portfolio/update", "UpdatePortfolio")->name(
        "update.portfolio"
    );
});

// Routes for all Blog Category Methods
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get("/blog/category/all", "BlogCategoryAll")
        ->middleware("auth")
        ->name("all.blog.category");

    Route::get("/blog/category/add", "AddBlogCategory")
        ->middleware("auth")
        ->name("add.blog.category");

    Route::get("/blog/category/edit/{id}", "EditBlogCategory")
        ->middleware("auth")
        ->name("edit.blog.category");

    Route::get("/blog/category/delete/{id}", "DeleteBlogCategory")->name(
        "delete.blog.category"
    );

    // All POST Methods
    Route::post("/store/blog-category", "StoreBlogCategory")->name(
        "store.blog.category"
    );
    Route::post("/blog/category/update/{id}", "UpdateBlogCategory")->name(
        "update.blog.category"
    );
});

// Controller for Blog Routes
Route::controller(BlogController::class)->group(function () {
    Route::get("/blogs/all", "AllBlog")
        ->middleware("auth")
        ->name("all.blog");

    Route::get("/blogs/add", "AddBlog")
        ->middleware("auth")
        ->name("add.blog");

    Route::get("/blogs/edit/{id}", "EditBlog")
        ->middleware("auth")
        ->name("edit.blog");

    Route::get("/delete/blog/{id}", "DeleteBlog")->name("delete.blog");

    // All POST Methods
    Route::post("/store/blog", "StoreBlog")->name("store.blog");
    Route::post("/update/blog", "UpdateBlog")->name("update.blog");

    // Frontend Routes
    Route::get("/blog/details/{id}", "BlogDetails")->name("blog.details");
    Route::get("/category/blog/{id}", "CategoryBlog")->name("category.blog");
    Route::get("/blog", "HomeBlog")->name("home.blog");
});

// Controller for All Footer Routes
Route::middleware(["auth"])->group(function () {
    Route::controller(FooterController::class)->group(function () {
        Route::get("/footer/setup", "FooterSetup")->name("footer.setup");

        // All POST Methods
        Route::post("/footer/update", "UpdateFooter")->name("update.footer");
    });
});

// Controller for All Contact Routes
Route::controller(ContactController::class)->group(function () {
    Route::get("/contact", "Contact")->name("contact.me");
    Route::get("/contact/message", "ContactMessage")
        ->middleware("auth")
        ->name("contact.message");

    Route::get("/contact/delete/{id}", "DeleteContact")->name("delete.contact");

    // All POST Methods
    Route::post("/store/message", "StoreMessage")->name("store.message");
});
Route::controller(ServiceController::class)->group(function () {
    Route::get("/service/all", "AllService")->name("service.all");
});

// Dashboard Route
Route::get("/dashboard", function () {
    return view("admin.index");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

// Route::middleware("auth")->group(function () {
//     Route::get("/profile", [ProfileController::class, "edit"])->name(
//         "profile.edit"
//     );
//     Route::patch("/profile", [ProfileController::class, "update"])->name(
//         "profile.update"
//     );
//     Route::delete("/profile", [ProfileController::class, "destroy"])->name(
//         "profile.destroy"
//     );
// });

require __DIR__ . "/auth.php";
