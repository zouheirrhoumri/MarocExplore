<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'accommodation_location',
    ];

    public function itinerary()
    {
        return $this->belongsTo(Iteneraries::class);
    }
}
