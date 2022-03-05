<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Request as PostRequest;
use \App\User;
use \App\Task;
use \App\Profile;
use \DB;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('highlow', function () {
            return $this->where('importance','1')->where('urgency','3');
        });

        Builder::macro('highmid', function () {
            return $this->where('importance','1')->where('urgency','2');
        });

        Builder::macro('highhigh', function () {
            return $this->where('importance','1')->where('urgency','1');
        });

        Builder::macro('midlow', function () {
            return $this->where('importance','2')->where('urgency','3');
        });

        Builder::macro('midmid', function () {
            return $this->where('importance','2')->where('urgency','2');
        });

        Builder::macro('midhigh', function () {
            return $this->where('importance','2')->where('urgency','1');
        });

        Builder::macro('lowlow', function () {
            return $this->where('importance','3')->where('urgency','3');
        });

        Builder::macro('lowmid', function () {
            return $this->where('importance','3')->where('urgency','2');
        });

        Builder::macro('lowhigh', function () {
            return $this->where('importance','3')->where('urgency','1');
        });
        
        Builder::macro('public', function () {
            return $this->where('private','public');
        });

        Builder::macro('private', function () {
            return $this->where('private','private');
        });

        Builder::macro('deadline', function () {
            return $this->where('deadline','!=',null);
        });

        Collection::macro('users',function(){
            $userId = $this->pluck('userId');
            return User::find($userId);
        });

        Collection::macro('exceptMe',function(){
            return $this->where('id','!=',\Auth::id());
        });

        Collection::macro('exceptMembers',function(){
            $ids = $this->users()->pluck('id');
            return User::where('id','!=',$ids);
        });

        Collection::macro('collectionMembers',function(){
            $teamIds = $this->pluck('id');
            $userIds = DB::table('teamsUsers')->where('teamId',$teamIds)->pluck('userId');
            return User::find($userIds);
        });

        Collection::macro('collectionTasks',function(){
            $teamIds = $this->pluck('id');
            $taskIds = DB::table('tasks')->where('teamId',$teamIds)->pluck('id');
            return Task::find($taskIds);
        });

    }
}
