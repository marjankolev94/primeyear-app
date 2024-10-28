<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeYear extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'day'];
}
