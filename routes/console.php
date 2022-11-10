<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('dani', function() {
    $contents = "<?php
    namespace App\Http\Controllers;

    use App\Models\Serie;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    
    class DaniController extends Controller
    {
        
    }";

    $files = new Filesystem();
    $files->put("app/Http/Controllers/teste.php", $contents);
});
