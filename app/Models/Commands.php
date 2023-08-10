<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commands extends Model
{
    use HasFactory;

    protected $fillable = ['flyingFrom', 'flyingTo', 'airline','departureTime','arrivalTime','class','subclass'];
}
