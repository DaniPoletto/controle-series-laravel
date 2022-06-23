<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
   public function index(Request $request)
   {
      $series = [
         'Brooklyn 99',
         'Super Store',
         'Todo mundo odeia o Chris'
      ];
     
      return view('listar-series', [
         'series' => $series
      ]);

      //é o mesmo que 
      // return view('listar-series', compact('series'));
   }
}
