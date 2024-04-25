<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'name','active'
    ];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('name','like',$term);
        }); 
    }

  
}
