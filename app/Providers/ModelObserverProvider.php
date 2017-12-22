<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Event;
use App\Models\Material;
use App\Models\Account;
use App\Models\Fan;
use App\Models\FanGroup;
use App\Models\Reply;
use Illuminate\Support\ServiceProvider;

class ModelObserverProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        User::observe('App\Observers\UserObserver');
        Reply::observe('App\Observers\ReplyObserver');
        Event::observe('App\Observers\EventObserver');
        Material::observe('App\Observers\MaterialObserver');
        Account::observe('App\Observers\AccountObserver');
        FanGroup::observe('App\Observers\FanGroupObserver');
        Fan::observe('App\Observers\FanObserver');
    }

    public function register()
    {
        # code...
    }
}
