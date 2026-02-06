<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model{

use HasFactory;

protected $fillable = [
    'name',
    'slug',
    'description',
    'is_active',
];
public function tags()
 {
        return $this->belongs(Product::class);
  }
}