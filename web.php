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

// все статьи
  Route::get('/post/all/{order?}/{dir?}', 'PostsController@getAll')
  ->where([
    'order' => '(id|title|date)',
    'dir' => '(asc|desc)',
  ]);

  // одна статья
  Route::get('/post/{id}', 'PostsController@getOne')
  ->where(['id' => '[\d]+']);

  // новая статья
  Route::get('/post/new', 'PostsController@newPost');

  // редактировать статью
  Route::match(['post', 'get'], '/post/edit/{id}', 'PostsController@editPost');

  // задача с других способов создания
  Route::get('/post/updateorcreate', 'PostsController@create');

  // удаление
  Route::get('/post/del/{id}', 'PostsController@delPost');
