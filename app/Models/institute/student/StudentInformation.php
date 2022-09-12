<?php

namespace App\Models\institute\student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentInformation extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','student_id','category_id','subcategory_id','student_name','student_email',
        'student_phone','student_password','student_status'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
