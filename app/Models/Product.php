<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function addeduser(){
        return $this->belongsTo(User::class,'added_by','id');
    }

    public function deleteduser(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function reviews(){
        return $this->hasMany(ProductReview::class,'product_id','id');
    }
}
