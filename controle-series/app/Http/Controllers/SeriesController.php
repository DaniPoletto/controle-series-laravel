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
      return view('series.index')->with('series', $series);
   }

   public function create()
   {
      return view('series.create');
   }

   public function store(Request $request) 
   {
      Serie::create($request->all());

      // $nomeSerie = $request->input('nome');

      // $serie = new Serie();
      // $serie->nome = $nomeSerie;
      // $serie->save();

      //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]); 
      return redirect()->route('series.index');
   }

   public function destroy(Request $request) {
      Serie::destroy($request->series);
      return redirect()->route('series.index');
   }
}
