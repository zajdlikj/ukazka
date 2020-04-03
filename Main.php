<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Main extends Model
{
    public function index()
    {
        $posts = DB::table('posts')
            ->where('posts.active',1)
            ->leftjoin('images','images.postID','posts.postID')
            ->where('images.active',1)
            ->where('images.main',1)
            ->get();
        return $posts;
    }

    public function showReference($postID)
    {
        $show = DB::table('posts')->where('postID',$postID)->where('active',1)->get();
        $images = DB::table('images')->where('postID',$postID)->where('active',1)->get();
        return array($show,$images);
    }

}
