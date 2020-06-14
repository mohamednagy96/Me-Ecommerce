<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable =[ 'name','abbr','locale','direction','active'];

    protected $cast=['active'=>'boolean'];
  
    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function scopeSelection($query){
        return $query->select('abbr','name','direction','active');
    }

    public function getActive(){
       return  $this->active == 1 ? 'مفعل' : 'غير مفعل' ;
    }

    // public function setActiveAttribute($val){
    //     if(!isset($this->attributes['active'])){
    //         $this->attributes['active']=0;
    //      }
    // }
}
