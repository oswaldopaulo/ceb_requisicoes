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


        $t = DB::connection('oracle')->table('vi_apontamentos')
           // ->select('ceb_apontamentos.*',
          //      (DB::raw("(SELECT nom_funcionario FROM funcionario u1 WHERE u1.num_matricula = ceb_apontamentos.cod_fun1 and cod_empresa='04') AS nom_funcionario1")),
         //       (DB::raw("(SELECT nom_funcionario FROM funcionario u2 WHERE u2.num_matricula = ceb_apontamentos.cod_fun2 and cod_empresa='04') AS nom_funcionario2"))

         //   )
        ->where('empresa', '04');

        if (Auth::user()->tipo != 1) $t->where('ativo', '=', 'S');

        if(!Request::input("all"))  $t->take(500);
       // $t->orderBy('id', 'DESC');
        $t = $t->orderBy('data_producao_filtro', "DESC")->get();

        //dd($t);
        return view('apontamentos/index')->with(['t' => $t]);
    }


    function tools($id)
    {

//        $r = DB::connection('oracle')->table('ceb_requisicoes')
//            ->where(['id' => $id])
//            ->first();

        $funcionarios2 = [];

        $ti = DB::connection('oracle')->table('ceb_apontamentos_tools')
            ->where(['id_rec' => $id])
            ->get();

        $func = DB::connection('oracle')->table('ceb_apontamentos_tools_func')
            ->where(['id_rec' => $id])
            ->get();

        foreach ($func as $f){
            array_push($funcionarios2, trim($f->num_matricula));
        }


        return view('apontamentos/tools')->with(['id' => $id, 'ti' => $ti,'funcionarios2'=> $funcionarios2]);

    }


    function toolsInsertFunc(){



        DB::connection('oracle')->table('ceb_apontamentos_tools_func')->where('id_rec',Request::input("id2"))->delete();

        if(Request::input("funcionarios")  && Request::input("id2")){




            foreach (Request::input("funcionarios") as $func){
                DB::connection('oracle')->table('ceb_apontamentos_tools_func')->insert([
                    'id_rec'=>Request::input("id2"),
                    'num_matricula'=>$func,
                ]);
            }
        }

        return redirect()->back()->with(['msg'=>'Funcionários gravados']);
    }

    function toolsInsert(ApontamentosRequest  $r)
    {


        $id = self::getIdTools() + 1;


        DB::beginTransaction();

        try {
            DB::connection('oracle')->table('ceb_apontamentos_tools')->insert([
                'id' => $id,
                'id_rec' => Request::input('id'),
                'cod_item' => Request::input('cod_item'),
                'descricao' => Request::input('den_item'),
                'num_aviso_rec' => Request::input('num_aviso_rec'),
                'lote' => Request::input('lote'),
                'inicio' => str_replace('T', ' ', Request::input('inicio')),
                'fim' => str_replace('T', ' ', Request::input('fim')),


            ]);


            DB::commit();


        } catch (\Exception $e) {
            DB::rollback();
            Log::critical($e);


            return $e;


        }


        return redirect()->back()->with('msg','Registro adicionado');
    }

    function getIdTools()
    {

        return DB::connection('oracle')->table('ceb_apontamentos_tools')
                ->max('id') + 0;


    }


}
