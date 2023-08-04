<?php

use Illuminate\Support\Facades\Route;

Route::get('/tests/{name}', function ($name) {
    return view("qrfeedz-backend::tests.{$name}");
});
