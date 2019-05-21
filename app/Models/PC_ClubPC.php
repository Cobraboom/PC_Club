<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PC_ClubPC extends Model
{
    use SoftDeletes;

    protected $fillable = [
            'PC_Name',
            'PC_Info'
    ];
}
