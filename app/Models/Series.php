<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;
    //quais campos são permitidos pra mass assingment
    //ignora tudo o que não estiver no array 
    protected $fillable = ['nome'];
    //sempre trazer as temporadas junto com a serie
    //protected $with = ['seasons'];

    // caso não siga o padrão, tbm posso definir
    // O padrão é a model Serie ser mapeada como series
    // protected $table = 'seriados';

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    //é executado qdo a model estiver inicializada
    protected static function booted()
    {
        //criando um escopo global que será aplicado a todas as querys da model
        //nome do escopo = ordered
        self::addGlobalScope('ordered', function(Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }

    //escopo local
    /**
     * public function scopeActive(Builder $query)
     * {
     *      return $query->where('active', true);
     * }
     */
}
