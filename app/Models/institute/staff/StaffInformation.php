<?php

namespace App\Models\institute\staff;

use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StaffInformation extends  Authenticatable implements JWTSubject
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id', 'institute_id','staff_id','category_id','subcategory_id','staff_name',
        'staff_email','staff_phone','staff_dob','staff_password','role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
    public function categoryInformation(): HasOne
    {
        return $this->hasOne(GradeCategory::class, 'id', 'category_id');
    }

    public function subcategoryInformation(): HasOne
    {
        return $this->hasOne(GradeSubCategory::class, 'id', 'subcategory_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
