<?php

namespace App\Services\Html;

class HtmlServiceProvider extends \Illuminate\Html\HtmlServiceProvider
{
    /**
     * Register the form builder instance.
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });

        $this->app->bindShared('html', function ($app) {
            $html = new HtmlBuilder($app['url']);

            return $html;
        });
    }
}
