<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'division_id', 'district_id', 'upazila_id', 'language', 'photo', 'cv'];

    public function setLanguageAttribute($value)
    {
        $this->attributes['language'] = json_encode($value);
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class );
    }

    public function trainings()
    {
        return $this->hasMany(Training::class );
    }

}
