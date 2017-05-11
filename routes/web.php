<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::pattern('id', '([0-9]+)');
Route::pattern('slug', '(.)+');

Route::group(['prefix' => ''], function(){
	Route::get('/', ['as' => 'public.index.index', 'uses' => 'IndexController@index']);
	Route::get('/{slug}-{id}', ['as' => 'public.news.cat', 'uses' => 'NewsController@cat']);
	Route::get('/{slug}-{id}.html', ['as' => 'public.news.detail', 'uses' => 'NewsController@detail']);

	
	Route::post('/comment/{id}', ['as' => 'public.news.comment', 'uses' => 'NewsController@comment']);
	Route::get('/comment/{id}', ['as' => 'public.news.comment', 'uses' => 'NewsController@getComment']);
	
	Route::post('/reply/{id}', ['as' => 'public.news.reply', 'uses' => 'NewsController@reply']);

	Route::get('/lien-he', ['as' => 'public.contact.index', 'uses' => 'ContactController@index']);
	Route::post('/lien-he', ['as' => 'public.contact.index', 'uses' => 'ContactController@postContact']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'qtri', 'middleware' => 'auth'], function() {
	/*Index*/
	Route::get('/', ['as' => 'admin.index.index', 'uses' => 'IndexController@index']);

	/*Contact*/
	Route::group(['prefix' => 'contacts', 'middleware' => 'role:smod'], function(){
		Route::get('', ['as' => 'admin.contacts.index', 'uses' => 'ContactsController@index']);
		Route::get('sent', ['as' => 'admin.contacts.sent', 'uses' => 'ContactsController@sent']);
		Route::get('important', ['as' => 'admin.contacts.important', 'uses' => 'ContactsController@imp']);
		Route::get('trash', ['as' => 'admin.contacts.recyclebin', 'uses' => 'ContactsController@recyclebin']);

		Route::get('add', ['as' => 'admin.contacts.add', 'uses' => 'ContactsController@getAdd']);
		Route::post('add', ['as' => 'admin.contacts.add', 'uses' => 'ContactsController@postAdd']);
		
		Route::get('readmail/{id}', ['as' => 'admin.contacts.readmail','uses' => 'ContactsController@readmail']);
		Route::get('unread/{id}', ['as' => 'admin.contacts.unread','uses' => 'ContactsController@unread']);
		Route::get('read/{id}', ['as' => 'admin.contacts.read','uses' => 'ContactsController@read']);
		Route::post('read/{id}', ['as' => 'admin.contacts.reply','uses' => 'ContactsController@reply']);

		Route::get('del/{id}', ['as' => 'admin.contacts.del','uses' => 'ContactsController@del']);
		Route::get('delmail/{id}', ['as' => 'admin.contacts.delmail','uses' => 'ContactsController@delmail']);
		Route::get('deltemp/{id}', ['as' => 'admin.contacts.deltemp','uses' => 'ContactsController@deltemp']);
		Route::get('undeltemp/{id}', ['as' => 'admin.contacts.undeltemp','uses' => 'ContactsController@undeltemp']);
		
		Route::post('delmore', ['as' => 'admin.contacts.delmore','uses' => 'ContactsController@delmore']);
		Route::get('delmore', ['as' => 'admin.contacts.delmore','uses' => 'ContactsController@index']);

		Route::post('delmoremail', ['as' => 'admin.contacts.delmoremail','uses' => 'ContactsController@delMoreMail']);
		Route::get('delmoremail', ['as' => 'admin.contacts.delmoremail','uses' => 'ContactsController@index']);
		
		Route::post('permanentlyDeleted', ['as' => 'admin.contacts.permanentlyDeleted','uses' => 'ContactsController@permanentlyDeleted']);
		Route::get('permanentlyDeleted', ['as' => 'admin.contacts.permanentlyDeleted','uses' => 'ContactsController@recyclebin']);

		Route::post('change-imp', ['as' => 'admin.contacts.imp', 'uses' => 'ContactsController@changeImp']);
		Route::get('change-imp', ['as' => 'admin.contacts.imp', 'uses' => 'ContactsController@index']);
	});

	/*Category*/
	Route::group(['prefix' => 'cats', 'middleware' => 'role:smod'], function(){
		Route::get('index', ['as' => 'admin.cats.index', 'uses' => 'CatsController@index']);
		Route::get('add', ['as' => 'admin.cats.add', 'uses' => 'CatsController@getAdd']);
		Route::post('add', ['as' => 'admin.cats.add', 'uses' => 'CatsController@postAdd']);
		Route::get('edit/{id}', ['as' => 'admin.cats.edit', 'uses' => 'CatsController@getEdit']);
		Route::post('edit/{id}', ['as' => 'admin.cats.edit', 'uses' => 'CatsController@postEdit']);
		Route::get('del/{id}', ['as' => 'admin.cats.del', 'uses' => 'CatsController@del']);
	});
	
	/*Users*/
	Route::group(['prefix' => 'users', 'middleware' => 'role:admin'], function(){
		Route::get('', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
		Route::get('add', ['as' => 'admin.users.add', 'uses' => 'UsersController@getAdd']);
		Route::post('add', ['as' => 'admin.users.add', 'uses' => 'UsersController@postAdd']);
		Route::get('del/{id}', ['as' => 'admin.users.del', 'uses' => 'UsersController@del']);
	});

	/*Users Edit*/
	Route::group(['prefix' => 'users'], function(){
		Route::get('edit/{id}', ['as' => 'admin.users.edit', 'uses' => 'UsersController@getEdit']);
		Route::post('edit/{id}', ['as' => 'admin.users.edit', 'uses' => 'UsersController@postEdit']);
	});

	/*News*/
	Route::group(['prefix' => 'news'], function(){
		Route::get('', ['as' => 'admin.news.index', 'uses' => 'NewsController@index']);
		Route::get('add', ['as' => 'admin.news.add', 'uses' => 'NewsController@getAdd']);
		Route::post('add', ['as' => 'admin.news.add', 'uses' => 'NewsController@postAdd']);
		Route::get('edit/{id}', ['as' => 'admin.news.edit', 'uses' => 'NewsController@getEdit']);
		Route::post('edit/{id}', ['as' => 'admin.news.edit', 'uses' => 'NewsController@postEdit']);
		Route::get('del/{id}', ['as' => 'admin.news.del', 'uses' => 'NewsController@del']);
		Route::post('delmore', ['as' => 'admin.news.delmore', 'uses' => 'NewsController@delMore']);
		
		Route::post('change-active', ['as' => 'admin.news.active', 'uses' => 'NewsController@changeActive']);
		Route::get('change-active', ['as' => 'admin.news.active', 'uses' => 'NewsController@index']);
		Route::get('change-slide', ['as' => 'admin.news.slide', 'uses' => 'NewsController@index']);
		Route::post('change-slide', ['as' => 'admin.news.slide', 'uses' => 'NewsController@changeSlide']);
		
		Route::get('search', ['as' => 'admin.news.search', 'uses' => 'NewsController@search']);
	});

	/*Comment*/
		Route::group(['prefix' => 'comments'], function(){
		Route::get('', ['as' => 'admin.comments.index', 'uses' => 'CommentsController@index']);
		Route::get('del/{id}', ['as' => 'admin.comments.del', 'uses' => 'CommentsController@del']);
		Route::get('delmore', ['as' => 'admin.comments.delmore', 'uses' => 'CommentsController@getdelMore']);
		Route::post('delmore', ['as' => 'admin.comments.delmore', 'uses' => 'CommentsController@delMore']);
		Route::get('change-active', ['as' => 'admin.comments.active', 'uses' => 'CommentsController@changeActive']);
	});

	/*Setting*/
		Route::group(['prefix' => 'setting', 'middleware' => 'role:admin'], function(){
		Route::get('', ['as' => 'admin.setting.index', 'uses' => 'SettingController@index']);
		Route::post('', ['as' => 'admin.setting.add', 'uses' => 'SettingController@postAdd']);
	});

});	

/*Auth*/
Route::group(['namespace' => 'Auth'], function() {
	Route::get('login', ['as'  => 'admin.auth.login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'admin.auth.login', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'admin.auth.logout', 'uses' => 'AuthController@logout']);
});
