<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Reference extends Main
{
    public function showReferences()
    {
        // check permission
        if(Session::get(config('config.session')) == config('config.password'))
        {
            $show = DB::table('posts')->where('active',1)->get();
            $images = DB::table('images')->where('active',1)->get();
            return array($show,$images);
        } else {
            return false;
        }
    }

    public function removeReference($postID)
    {
        // check permission
        if(Session::get(config('config.session')) == config('config.password'))
        {
            // change active state
            $show = DB::table('posts')->where('postID',$postID)->update(['active'=>0]);
            $images = DB::table('images')->where('postID',$postID)->update(['active'=>0]);
            return true;
        } else {
            return false;
        }
    }

    public function isSold($postID,$stav)
    {
        // check permission
        if(Session::get(config('config.session')) == config('config.password'))
        {
            // change sold state
            $show = DB::table('posts')->update(['sold'=>$stav]);
            return true;
        } else {
            return false;
        }
    }

    public function addNewForm()
    {
        // check permission
        if(Session::get(config('config.session')) == config('config.password')) return true;
        else return false;
    }

    public function addNew($request)
    {
        // check permission
        if(Session::get(config('config.session')) == config('config.password'))
        {
            $add = DB::table('posts')
                ->insert([
                    'shortSubject'=>$request->shortSubject,
                    'longSubject'=>$request->longSubject,
                    'description'=>$request->description,
                    'visualisationLink'=>$request->visualisationLink,
                    'sold'=>0,
                    'active'=>1
                ]);
            return true;
        } else {
            return false;
        }
    }

}
