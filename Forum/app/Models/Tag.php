<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $filllable =[

        'title'
    ];

    public function category(){

        return $this->belongsToMany(Category::class);
    
    }


    public function topics(){

        return $this->belongsToMany(Topic::class,'topic_tag');
    
    }


}
