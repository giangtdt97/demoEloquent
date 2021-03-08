<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Product;
use App\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/createUser', function () {
    $faker = Faker\Factory::create();
    for ($i = 1; $i < 6; $i++) {
        DB::table('users')->insert([
            'name' => $faker->name(),
            'email' => $faker->safeEmail,
            'password' => bcrypt('123456')
        ]);
    }
});
Route::get('/create', function () {
$faker = Faker\Factory::create();
for ($i = 1; $i < 6; $i++) {
    DB::table('products')->insert([
        'title' => $faker->name(),
        'user_id' => $i,
        'created_at'=>now()
    ]);
}
});
Route::get('/show',function (){
    $users=User::with('products')->get();
    echo "User" .":"."Product"."<br/>";
    foreach ($users as $user){
        foreach ($user->products as $product)
        {
            echo $product->user->name.":". $product->title."<br/>";
        }
    }
});
Route::get('/show1',function (){
    $users=User::with('products')->whereIn('id',[1,2,5])->get();
    echo "User" .":"."Product"."<br/>";
    foreach ($users as $user){
        foreach ($user->products as $product)
        {
            echo $product->user->name.":". $product->title."<br/>";
        }
    }
});
Route::get('/show2',function (){
    $products=Product::with('user')->whereIn('user_id',[1,2,3])->latest('created_at', 'desc')->get();
    echo "User" .":"."Product"."<br/>";
    foreach ($products as $product ){
        echo $product->user->name.":". $product->title."<br/>";
    }
});
