<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Entity;

class Entity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'api',
        'description',
        'link',
        'category_id',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
