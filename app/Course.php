<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [
        'id','created_at','updated_at',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getRouteKeyName(){
        return 'slug';
    }
    public function users() {
        return $this->belongsToMany('App\User');
    }

    public static function urlVideo($url){
        $url = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$url);
        return $url;
    }
}
