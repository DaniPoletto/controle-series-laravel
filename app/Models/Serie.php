<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serie extends Model
{
    use HasFactory;
    //quais campos são permitidos pra mass assingment
    //ignora tudo o que não estiver no array 
    protected $fillable = ['nome'];

    // caso não siga o padrão, tbm posso definir
    // O padrão é a model Serie ser mapeada como series
    // protected $table = 'seriados';

    public function temporadas()
    {
        return $this->hasMany(Season::class, 'series_id');
    }
}
