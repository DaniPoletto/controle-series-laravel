<?php
namespace App\repositories;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request) : Series
    {
        return DB::transaction(function () use ($request){
            $serie = Series::create([
               'nome' => $request->nome,
               'cover' => $request->coverPath,
            ]);
            
            $seasons = [];
            for ($i=1; $i <= $request->seasonsQty; $i++) { 
               $seasons[] = [
                  'series_id' => $serie->id,
                  'number' => $i,
               ];
            }
            Season::insert($seasons);
      
            $episodes = [];
            foreach ($serie->seasons as $season) {
               for ($j=1; $j <= $request->episodesPerSeason; $j++) { 
                  $episodes[] = [
                     'season_id' => $season->id,
                     'number' => $j
                  ];
               } 
            }
            Episode::insert($episodes);
   
            return $serie;
         });
   
    }
}