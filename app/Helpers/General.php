<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;

function get_langauges(){
    \App\Models\Language::active()->get();

function get_defualt_lang(){
    return Config::get('app.locale');
    }

function uploadImage($folder,$image){
    $image->store('/',$folder);
    $filename= $image->hashName();
    $path='images/'.$folder.'/'.$filename;
    return $path;
}
}