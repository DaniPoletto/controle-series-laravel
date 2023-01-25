<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        $seasons = $series->seasons()->with('episodes')->get();

        //caso recebesse parametro inteiro
        //$seasons = Season::query()
        //  ->where()
        //  ->('series_id', $series)
        //  ->get();

        //ou buscando junto os episodios
        //$seasons = Season::query()
        //  ->with('episodes')
        //  ->('series_id', $series)
        //  ->get();

        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);
    }
}
