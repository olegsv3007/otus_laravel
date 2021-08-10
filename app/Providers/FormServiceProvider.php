<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Form;

class FormServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Form::component('bsText', 'form.text', ['name', 'title', 'value', 'attributes']);
        Form::component('bsPassword', 'form.password', ['name', 'title', 'attributes']);
        Form::component('bsButton', 'form.button', ['title', 'type', 'attributes']);
    }
}
