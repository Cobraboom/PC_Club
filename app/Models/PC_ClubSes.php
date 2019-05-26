<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PC_ClubSes extends Model
{
    use SoftDeletes;


     /**
      * Клиент сессии
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function user()
     {
         //Сессия принадлежит пользователю
         return $this -> belongsTo(User::class);
     }

    /**
      * PC сессии
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
    /*public function PC()
   {
       //PC принадлежит сессии
       return $this -> belongsTo(PC_ClubPC::class);
   }*/

    protected $fillable =[
            //'id',
            'id_pc',
            'user_id',
            'time_start',
            'time_end',
        ];
}
