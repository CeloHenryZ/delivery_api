<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $table = "categories";
    public $primaryKey = "id";

    public $fillable = [
        "category_name",
        "category_image",
        "isActive"
    ];
}
