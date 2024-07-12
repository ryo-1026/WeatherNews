<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weather;

class Prefecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function weathers()
    {
        return $this->hasMany(Weather::class);
    }
}
