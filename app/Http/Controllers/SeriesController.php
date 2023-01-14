<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
   public function index(Request $request)
   {
      $series = Serie::all();
      //acessando o escopo local
      // $series = Serie::active();
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
      $serie = Serie::create($request->all());
      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso");
   }

   public function destroy(Serie $series, Request $request) {
      $series->delete();
      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso.");
   }

   public function edit(Serie $series)
   {
      dd($series->temporadas);
      return view('series.edit')->with('serie', $series);
   }

   public function update(Serie $series, SeriesFormRequest $request)
   {
      $series->fill($request->all());
      $series->save();

      return  redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' editada com sucesso.");
   }
}
