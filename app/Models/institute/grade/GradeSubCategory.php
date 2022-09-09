<?php

namespace App\Models\institute\grade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradeSubCategory extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','category_id','subcategory_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
