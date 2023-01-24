<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApontamentosRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApontamentosController extends Controller
{
    function index()
    {


        $t = DB::connection('oracle')->table('vi_apontamentos');
           // ->select('ceb_apontamentos.*',
          //      (DB::raw("(SELECT nom_funcionario FROM funcionario u1 WHERE u1.num_matricula = ceb_apontamentos.cod_fun1 and cod_empresa='04') AS nom_funcionario1")),
         //       (DB::raw("(SELECT nom_funcionario FROM funcionario u2 WHERE u2.num_matricula = ceb_apontamentos.cod_fun2 and cod_empresa='04') AS nom_funcionario2"))

         //   )
         //   ->where('cod_item', '!=', '000.000');
        if (Auth::user()->tipo != 1) $t->where('ativo', '=', 'S');

        if(!Request::input("all"))  $t->take(500);
       // $t->orderBy('id', 'DESC');
        $t = $t->get();

        //dd($t);
        return view('apontamentos/index')->with(['t' => $t]);
    }



}
