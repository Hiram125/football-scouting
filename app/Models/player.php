<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','age','position','club',
        'pace','shooting','passing','dribbling','strength','comments',
        'matches','goals','assists','minutes_played'
    ];
}