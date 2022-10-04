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
      $series = Serie::query()->orderBy('nome')->get();
      $mensagemSucesso = session('mensagem.sucesso');
      // $mensagemSucesso = $request->session()->get('mensagem.sucesso');
      // $request->session()->forget('mensagem.sucesso');

      // $series = Serie::all();
      
      // $series = DB::select('SELECT nome FROM series;');

      //dump and die
      // dd($series);

      // $series = [
      //    'Brooklyn 99',
      //    'Super Store',
      //    'Todo mundo odeia o Chris'
      // ];
     
      // return view('listar-series', [
      //    'series' => $series
      // ]);

      //é o mesmo que 
      // return view('listar-series', compact('series'));

      //é o mesmo que 
      return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
   }

   public function create()
   {
      return view('series.create');
   }

   public function store(SeriesFormRequest $request) 
   {
      // $request->validate([
      //    'nome' => ['required', 'min:3']
      // ]);
      $serie = Serie::create($request->all());
      // session(['mensagem.sucesso' => 'Série adicionada com sucesso']);
      // $request->session()->flash('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso");

      // $nomeSerie = $request->input('nome');

      // $serie = new Serie();
      // $serie->nome = $nomeSerie;
      // $serie->save();

      //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]); 
      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso',"Série '{$serie->nome}' adicionada com sucesso");
   }

   public function destroy(Serie $series, Request $request) {
      $series->delete();
      // $request->session()->put('mensagem.sucesso', 'Série Removida com sucesso.');
      // $request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' Removida com sucesso.");
      return redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso.");
   }

   public function edit(Serie $series)
   {
      return view('series.edit')->with('serie', $series);
   }

   public function update(Serie $series, SeriesFormRequest $request)
   {
      // $series->nome = $request->nome;

      $series->fill($request->all());
      $series->save();

      return  redirect()
               ->route('series.index')
               ->with('mensagem.sucesso', "Série '{$series->nome}' editada com sucesso.");
   }
}
