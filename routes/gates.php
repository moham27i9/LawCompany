<?php

use Illuminate\Support\Facades\Gate;

Gate::define('isAdmin', function ($user) {
    return $user->role->name === 'admin';
});
