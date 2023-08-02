<?php

use App\Models\Post;
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



/*
|--------------------------------------------------------------------------
|DATABASE RAW SQL QUERIES -- CRUD
|--------------------------------------------------------------------------

*/


//1.Inserting into the database
// Route::get('/insert',function(){

//     DB::insert('insert into posts(title,content) values(?,?)',['PHP ','making quick money']);
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
// Route::get('delete',function(){

//     $deleted = DB::delete('delete from posts where id = ?',[1]);
//     return $deleted;
// });




/*
|--------------------------------------------------------------------------
| ELOQUENT - ORM (Object Relational Mapping) in Laravel CRUD operations
|--------------------------------------------------------------------------
*/

/*############################################################################################# 
###############################################################################################*/

//1. RETRIEVING USING ELOQUENT OR MODEL

//1.this for retrieving everything from the post table for each row
 

Route::get('/read',function(){

    $post = Post::all();

    foreach ($post as $post){

        return $post->title;
    }

});

//2. this is for retrieving only the title of the second id 

Route::get('/read',function(){

    $post = Post::find(2);
    return $post->title;
});


//3.Retrieving with conditions or constraints 
Route::get('findwhere',function(){
    $posts = Post::where('id',4)->orderBy('id','desc')->take(1)->get();
    return $posts;
});

/*############################################################################################# 
###############################################################################################*/
//2. INSERTING USING MODEL

// INSERTING A NEW RECORD USING MODEL OR ELOQUENT 
Route::get('/basic_insert',function(){
    $post = new Post();
    $post-> title = 'Laravel is fun';
    $post-> content = 'Enjoy it!';
    $post->save();

});

// INSERTING IN A SPECIFIC LOCATION AND DELETING THE EXISTING ONE USING MODEL OR ELOQUENT 
Route::get('/basic_insert2',function(){
    $post = Post::find(2);
    $post-> title = 'id 2 changed using eloquent';
    $post-> content = 'New Content 2 updated and changed using eloquent';
    $post->save();

});

// MASS ASSIGNMENT OPERATOR USING CREATE IN  ELOQUENT OR MODEL 
// THIS IS TO INSERT USING MASS ASSIGNMENT but you need to say 
// protected fillable in the POST model to give permission for mass assignment
Route::get('/create',function(){
    Post::create(['title'=>'Mass Assignment with create method again ','content'=>'I\' am learning a lot again']);
});


/*############################################################################################# 
###############################################################################################*/

// UPDATING USING MODEL using the update method

Route::get('/update',function(){
    Post::where('id',3)->where('is_admin',0)->update(['title'=>'NEW PHP TITLE','content'=>'I love laravel']);
});

/*############################################################################################# 
###############################################################################################*/

// DELETING USING ELOQUENT 
//1. one way to delete() method
Route::get('/delete',function(){
    $post = Post::find(4);
    $post->delete();
});

//2. second way--> destroy() method
Route::get('/destroy',function(){
    //Post::destroy(3); --this is to destroy one 
    Post::destroy([5,6]); // this is how to delete multiple records if you know the id numbers
});

//3. SoftDeleting / Trashing
// this is where you can delete an item but it is not fully deleted you can still retrieve it
//here you need to first go to the model and import the SoftDeletes package and use it

Route::get('/softdelete',function(){

    Post::find(8)->delete();
});

//4. Retrieving trashed items 

Route::get('/read_softdelete',function(){

   
    //$post = Post::withTrashed()->where('id',9)->get(); // returns only the specified trashed item
    $post = Post::onlyTrashed()->where('is_admin',0)->get(); // returns all the trashed items
    return $post;
});

//5. restoring trashed items 
Route::get('/restore',function(){
    Post::withTrashed()->where('is_admin',0)->restore();
});

//6. Deleting  the trashed  item permanenttly using the forceDelete() method

Route::get('/forcedelete',function(){

    Post::onlyTrashed()->where('is_admin',0)->forceDelete();    
});