<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
   public function index(Request $request)
   {
      $series = Series::all();
      //acessando o escopo local
      // $series = Series::active();
      $mensagemSucesso = session('mensagem.sucesso');

      return view('series.index')
         ->with('series', $series)
         ->with('mensagemSucesso', $mensagemSucesso);
   }

   public function create()
   {
      return view('series.create');
   }

   public function store(SeriesFormRequest $request) 
   {
      $serie = null;
      //executa tudo o que está dentro e commita no banco
      DB::transaction(function () use ($request, &$serie){
         $serie = Series::create($request->all());
         
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
      }, 5);//tentar 5 vezes

          // for ($i=1; $i <= $request->seasonsQty; $i++) { 
         //    $season = $serie->seasons()->create([
         //       'number' => $i
         //    ]);
   
         //    for ($j=1; $j <= $request->episodesPerSeason; $j++) { 
         //       $season->episodes()->create([
         //          'number' => $j
         //       ]);
         //    }
         // }

      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso");
   }

   public function destroy(Series $series, Request $request) {
      $series->delete();
      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso.");
   }

   public function edit(Series $series)
   {
      return view('series.edit')->with('serie', $series);
   }

   public function update(Series $series, SeriesFormRequest $request)
   {
      $series->fill($request->all());
      $series->save();

      return  redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' editada com sucesso.");
   }
}
