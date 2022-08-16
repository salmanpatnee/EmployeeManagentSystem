<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'name'
    ];

    protected $with = ['states'];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('country_code', 'like', $term)
                ->orWhere('name', 'like', $term);
        });
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
