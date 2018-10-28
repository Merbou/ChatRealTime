<?php
use App\Message;
use App\Events\MessageSent;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/contacts','contactsController@get');

 Route::get('/Conversation/{id}','contactsController@getMessagesFor');

 Route::post('/Conversation/send','contactsController@send');

 Route::post('/boom','contactsController@boom');