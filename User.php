<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class User extends Main
{
    public function login($password)
    {
        if($password == config('config.password')) {
            Session::put(config('config.session'),config('config.password'));
            return true;
        } else {
            return false;
        }
    }
}
