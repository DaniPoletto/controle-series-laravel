<?php

namespace App\Http\Controllers;

use App\Models\Series;
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
      $serie = Series::create($request->all());
      for ($i=1; $i <= $request->seasonsQty; $i++) { 
         $season = $serie->seasons()->create([
            'number' => $i
         ]);

         for ($j=1; $j <= $request->episodesPerSeason; $j++) { 
            $season->episodes()->create([
               'number' => $j
            ]);
         }
      }
      
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
