<?php

namespace App\Models\institute\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','subject_name','category_id','subcategory_id', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
