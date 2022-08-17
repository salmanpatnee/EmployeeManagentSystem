<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'department_id',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'birthdate',
        'date_hired',
    ];

    protected $dates = [
        'birthdate',
        'date_hired'
    ];

    protected $with = ['department', 'country'];

    public function setBithhdateAttribute($value)
    {
        $birthDate = Carbon::parse($value);
        $this->attributes['birthdate'] = $birthDate->format('Y-m-d');
    }

    public function setDateHiredAttribute($value)
    {
        $date_hired = Carbon::parse($value);
        $this->attributes['date_hired'] = $date_hired->format('Y-m-d');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('first_name', 'like', $term)
                ->orWhere('middle_name', 'like', $term)
                ->orWhere('last_name', 'like', $term)
                ->orWhere('address', 'like', $term)
                ->orWhere('zip_code', 'like', $term);
        });
    }
}
