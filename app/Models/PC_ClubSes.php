<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PC_ClubSes extends Model
{
    use SoftDeletes;

    protected $fillable =[
            'id_pc',
            'user_id',
            'time_start',
            'time_end',
        ];
}
