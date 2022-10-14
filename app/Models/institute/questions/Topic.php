<?php

namespace App\Models\institute\questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Topic extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','topic_name','topic_role','category_id','subcategory_id', 'created_at', 'updated_at',
    ];



    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
