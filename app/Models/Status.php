<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\True_;

class Status extends Model
{
    protected $fillable = ['body'];
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function scopeNotReply($query){
        return $query->whereNull('parent_id');
    }

    public function replies(){
        return $this->hasMany('App\Models\Status', 'parent_id');
    }

    public function likes(){
        return $this->morphMany('App\Models\Like', 'likeable');
    }
}
