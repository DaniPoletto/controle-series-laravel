<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    //quais campos são permitidos pra mass assingment
    //ignora tudo o que não estiver no array 
    protected $fillable = ['nome'];
}
