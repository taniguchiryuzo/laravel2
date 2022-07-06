<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    
     // Relationship
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'recipe_id', 'id');
    }
}
