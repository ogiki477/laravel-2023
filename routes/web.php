<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MyController;

// Resource Route
//Route::resource('post',PostController::class);
// Custom Routes

Route::get('/home',[PostController::class,'show_my_view']);

Route::get('post/{id}/{name}/{password}',[PostController::class,'show_post']);

Route::get('/My',[MyController::class,'MyControllerFunction']);

Route::get('posted/{id}/{password}/{name}',[MyController::class,'show_post']);

//routes for testing the blade layouts @section and @extends
Route::get('/index',[MyController::class,'index']);
Route::get('/contact',[PostController::class,'contact']);


// Database Raw SQL Queries 

//1.Inserting into the database
// Route::get('/insert',function(){

//     DB::insert('insert into posts(title,content) values(?,?)',['PHP with laravel','Laravel is for making quick money']);
// });



// 2.Reading from the database (Retrieving from the database)
// Route::get('/read', function(){
//     $result = DB::select('select * from posts where id = ?',[1]);

//    foreach ($result as $post ) {
//         //return $post->content;
//         return $post->title;
//     }

// });

//3.UPDATING the database 

// Route::get('/update',function(){

//     $updated = DB::update('update posts set title = "Updated_title" where id = ?',[1]);
//     return $updated;
// });

//4.DELETE 
Route::get('delete',function(){

    $deleted = DB::delete('delete from posts where id = ?',[1]);
    return $deleted;
});