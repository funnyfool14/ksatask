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


Route::get('/','UserController@top')->name('users.top');

Route::group(['middleware'=>['auth']],function(){
    Route::resource('users','UserController');
    Route::get('search','UserController@search')->name('users.search');
    Route::get('user/private/{id}','UserController@private')->name('users.private');
    Route::get('user/deadline/{id}','UserController@deadline')->name('users.deadline');
    Route::get('user/{id}/teams','UserController@teams')->name('users.teams');
    Route::get('user/{id}/personnel','UserController@personnel')->name('users.personnel');
    Route::get('user/{id}/promote','UserController@prePromote')->name('users.prePromote');
    Route::get('user/{id}/demote','UserController@preDemote')->name('users.preDemote');
    Route::post('user/{id}/promote','UserController@promote')->name('users.promote');
    Route::post('user/{id}/demote','UserController@demote')->name('users.demote');
    Route::get('user/{id}/retirement','UserController@preRetirement')->name('users.preRetirement');
    Route::post('user/{id}/retirement','UserController@retirement')->name('users.retirement');

    Route::resource('companies','CompanyController');
    Route::get('companiesBelong','CompanyController@choice')->name('companies.choice');
    Route::post('companiesBelong','CompanyController@belong')->name('companies.belong');

    Route::resource('projects','ProjectController');
    Route::get('project_teams/{id}','ProjectController@teams')->name('projects.teams');
    Route::get('project/members/{id}','ProjectController@members')->name('projects.members');
    Route::get('project/{project}/user/{user}','ProjectController@remove')->name('projects.remove');
    //Route::get('remove','ProjectController@remove')->name('projects.remove');
    Route::get('project/{project}/removeUser/{user}','ProjectController@memberDelete')->name('projects.memberDelete');

    Route::get('project/{id}/newTeam','TeamController@ready')->name('teams.ready');
    Route::post('project/{id}/newTeam','TeamController@leaderDecide')->name('teams.leaderDecide');
    Route::post('team/{id}/member','TeamController@memberPost')->name('teams.memberPost');
    Route::get('team/{teamId}/member/{userId}','TeamController@memberDelete')->name('teams.memberDelete');
    Route::get('project/{id}/teams','TeamController@index')->name('teams.index');
    Route::get('team/{id}','TeamController@show')->name('teams.show');
    Route::get('team/{id}/deputyPick','TeamController@deputyChoice')->name('deputy.choice');
    Route::post('team/{id}/deputyPick','TeamController@deputyPick')->name('deputy.pick');
    Route::get('team/{id}/deputyKick','TeamController@deputyKick')->name('deputy.kick');
    Route::get('team/{team}/user/{user}','TeamController@remove')->name('teams.remove');
    Route::get('team/{id}/edit','TeamController@edit')->name('teams.edit');
    Route::put('team/{id}/edit','TeamController@update')->name('teams.update');

    Route::resource('tasks','TaskController');
    Route::get('team/{id}/taskCreate','TaskController@teamCreate')->name('tasks.teamCreate');
    Route::post('team/{id}/taskCreate','TaskController@teamstore')->name('tasks.teamStore');
    Route::put('team/{id}/taskUpdate','TaskController@teamUpdate')->name('tasks.teamUpdate');
    Route::post('inChargeOfTask/{id}/','TaskController@inCharge')->name('tasks.inCharge');
    Route::get('task/{task}/user/{user}','TaskController@remove')->name('tasks.remove');
    Route::get('task/{task}/delete}','TaskController@preDelete')->name('tasks.preDelete');
    Route::post('task/{task}/delete}','TaskController@delete')->name('tasks.delete');

    Route::resource('messages','MessageController');
    Route::get('messageTo/{user}','MessageController@write')->name('messages.write');
    Route::get('replyTo/{message}}','MessageController@reply')->name('messages.reply');
    Route::post('replyTo/{id}', 'MessageController@replyCheck')->name('messages.replyCheck');
    Route::post('send/{id}', 'MessageController@sendCheck')->name('messages.sendCheck');
    Route::get('send/{id}', 'MessageController@send')->name('messages.send');
    Route::get('unsent/{id}', 'MessageController@unsent')->name('messages.unsent');
    Route::get('test', 'MessageController@test');
});

Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

