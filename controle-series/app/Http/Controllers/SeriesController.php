<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

   public function store(Request $request) 
   {
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
               ->with('mensagem.sucesso', "Série '{$series->nome}' Removida com sucesso.");
   }
}
