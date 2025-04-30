<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeHistory extends Model
{
    use HasFactory;
    
    /*
    モデルのルートキーの取得
    @return string
    */
    public function getRouteKeyName() {
        return 'recipe_id';
    }

    protected $fillable = [
        'user_id',
        'recipe_id',
        'recipe_title',
        'recipe_url',
        'image_url',
        'recipe_material',
        'rank',
    ];

    protected $casts = [
        'recipe_material' => 'array',
    ];
}
