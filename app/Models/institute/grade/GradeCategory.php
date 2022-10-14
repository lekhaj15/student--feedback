<?php

namespace App\Models\institute\grade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradeCategory extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','category_name', 'created_at', 'updated_at',
    ];



    public function scopegetTableName(): string
    {
        return $this->getTable();
    }


}
