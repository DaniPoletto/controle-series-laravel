<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
   public function index(Request $request)
   {
      //pega o id da url
      return $request->get('id');
      $series = [
         'Brooklyn 99',
         'Super Store',
         'Todo mundo odeia o Chris'
      ];

      $html = "<ul>";
      foreach ($series as $serie) {
         $html .= "<li>$serie</li>";
      }
      $html .="</ul>";
     
      return $html;
   }
}
