<?php

namespace App\Models\institute\Auth;

use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use App\Models\institute\staff\StaffInformation;
use App\Models\institute\student\StudentInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Institute extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable ;

//    protected $table = '';

    protected $fillable = [
        'id','full_name', 'email','role', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
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

    public function gradeCategoryInformation(): HasOne
    {
        return $this->hasOne(GradeCategory::class, 'institute_id', 'id');
    }
    public function gradeSubCategoryInformation(): HasOne
    {
        return $this->hasOne(GradeSubCategory::class, 'institute_id', 'id');
    }
    public function studentInformation(): HasOne
    {
        return $this->hasOne
        (StudentInformation::class, 'institute_id', 'id');
    }
    public function staffInformation(): HasMany
    {
        return $this->hasMany
        (StaffInformation::class, 'institute_id', 'id');
    }
}
