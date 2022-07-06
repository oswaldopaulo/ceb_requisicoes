<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RequisicoesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequisicoesController extends Controller
{
    function index()
    {


        $t = DB::connection('oracle')->table('ceb_requisicoes')
            ->select('ceb_requisicoes.*',
                (DB::raw("(SELECT nom_funcionario FROM funcionario u1 WHERE u1.num_matricula = ceb_requisicoes.cod_fun1 and cod_empresa='04') AS nom_funcionario1")),
                (DB::raw("(SELECT nom_funcionario FROM funcionario u2 WHERE u2.num_matricula = ceb_requisicoes.cod_fun2 and cod_empresa='04') AS nom_funcionario2"))

            )
            ->where('cod_item', '!=', '000.000');
        if (Auth::user()->tipo != 1) $t->where('ativo', '=', 'S');

        $t = $t->get();

        return view('requisicoes/index')->with(['t' => $t]);
    }


    function novo()
    {

        return view('requisicoes/novo');

    }

    function novomanual()
    {

        return view('requisicoes/novomanual');

    }


    function toolsInsert(RequisicoesRequest $r)
    {


        $id = self::getIdTools() + 1;


        DB::beginTransaction();

        try {
            DB::connection('oracle')->table('ceb_requisicoes_tools')->insert([
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


        return redirect()->back();
    }


    function insert(RequisicoesRequest $r)
    {

        $id = self::getId() + 1;
        $id_itens = self::getIdItens() + 1;

        DB::beginTransaction();

        try {
            DB::connection('oracle')->table('ceb_requisicoes')->insert([
                'id' => $id,
                'cod_item' => Request::input('cod_item'),
                'den_item' => Request::input('den_item'),
                'cod_unid_med' => Request::input('cod_unid_med'),
                'cod_fun1' => Request::input('cod_fun1'),
                'cod_fun2' => Request::input('cod_fun2'),
                'num_ordem' => Request::input('num_ordem'),
                'dat' => str_replace('T', ' ', Request::input('date')),
                'fim' => str_replace('T', ' ', Request::input('fim')),
                'misturas' => Request::input('horas'),
                'solicitada' => Request::input('solicitadas'),
                'misturas' => Request::input('misturas'),
                'usuario' => Auth::user()->username,
                'mistura' => Request::input('mistura') ? 'S' : 'N',
                'dest' => Request::input('dest'),


            ]);


            if (Request::input('cod_item_compon')) {

                foreach (Request::input('cod_item_compon') as $key => $value) {

                    DB::connection('oracle')->table('ceb_requisicoes_items')->insert([
                        'id' => $id_itens,
                        'id_rec' => $id,
                        'cod_comp' => $value,
                        'num_aviso_rec' => Request::input('ar')[$key],
                        //num_seq NUMBER(3,0),
                        'lote' => Request::input('lote')[$key],
                        'qtd' => Request::input('qtd')[$key],
                        'cod_unid_med' => Request::input('cod_unid_med2')[$key],
                        'cod_local_estoq' => Request::input('cod_local_estoq')[$key],
                        'estoque' => Request::input('estoque')[$key],
                        'qtdtotal' => Request::input('qtdtotal')[$key],
                        'perda' => Request::input('perda')[$key],
                        //'qtd_separada' =>Request::input('lote')[$key]
                    ]);

                    $id_itens++;
                }
            }

            DB::commit();


        } catch (\Exception $e) {
            DB::rollback();
            Log::critical($e);


        }


        return redirect()->action('RequisicoesController@index')->with(['id' => $id, 'desc' => Request::input('descricao')]);
    }

    function insertmanual(RequisicoesRequest $r)
    {
        Request::all();
        $id = self::getId() + 1;
        $id_itens = self::getIdItens() + 1;

        DB::beginTransaction();

        try {
            DB::connection('oracle')->table('ceb_requisicoes')->insert([
                'id' => $id,
                'cod_item' => Request::input('cod_item'),
                'den_item' => Request::input('den_item'),
                'cod_unid_med' => Request::input('cod_unid_med'),
                'cod_fun1' => Request::input('cod_fun1'),
                'cod_fun2' => Request::input('cod_fun2'),
                'num_ordem' => Request::input('num_ordem'),
                'dat' => str_replace('T', ' ', Request::input('date')),
                'fim' => str_replace('T', ' ', Request::input('fim')),
                'misturas' => Request::input('horas'),
                'solicitada' => Request::input('solicitadas'),
                'misturas' => Request::input('misturas'),
                'usuario' => Auth::user()->username,
                'mistura' => Request::input('mistura') ? 'S' : 'N',
                'dest' => Request::input('dest'),


            ]);


            if (Request::input('cod_item_compon')) {

                foreach (Request::input('cod_item_compon') as $key => $value) {

                    DB::connection('oracle')->table('ceb_requisicoes_items')->insert([
                        'id' => $id_itens,
                        'id_rec' => $id,
                        'cod_comp' => $value,
                        'num_aviso_rec' => Request::input('ar')[$key],
                        //num_seq NUMBER(3,0),
                        'lote' => Request::input('lote')[$key],
                        'qtd' => Request::input('qtd')[$key],
                        'cod_unid_med' => Request::input('cod_unid_med2')[$key],
                        'cod_local_estoq' => Request::input('cod_local_estoq')[$key],
                        'estoque' => Request::input('estoque')[$key],
                        'qtdtotal' => Request::input('qtdtotal')[$key],
                        'perda' => Request::input('perda')[$key],
                        //'qtd_separada' =>Request::input('lote')[$key]
                    ]);

                    $id_itens++;
                }
            }

            DB::commit();


        } catch (\Exception $e) {
            DB::rollback();
            Log::critical($e);


        }


        return redirect()->action('RequisicoesController@index')->with(['id' => $id, 'desc' => Request::input('descricao')]);
    }

    function remove($id)
    {


        if (Auth::user()->tipo != 1) {
            DB::connection('oracle')->table('ceb_requisicoes')
                ->where('id', $id)
                ->update([

                    'Ativo' => 'N',


                ]);

        } else {
            DB::connection('oracle')->table('ceb_requisicoes_items')->where(['id_rec' => $id])->delete();
            DB::connection('oracle')->table('ceb_requisicoes_tools')->where(['id_rec' => $id])->delete();
            DB::connection('oracle')->table('ceb_requisicoes')->where(['id' => $id])->delete();

        }


        return redirect()->action('RequisicoesController@index')->with(['id' => $id, 'acao' => 'r']);
    }

    function toolsRemove($id)
    {


        if (Auth::user()->tipo != 1) abort('404');

        DB::connection('oracle')->table('ceb_requisicoes_tools')->where(['id' => $id])->delete();
        return redirect()->back();
    }


    function editar($id)
    {

        $r = DB::connection('oracle')->table('ceb_requisicoes')
            ->where(['id' => $id])
            ->first();


        $ti = DB::connection('oracle')->table('ceb_requisicoes_items')
            ->where(['id_rec' => $id])
            ->get();


        return view('requisicoes/editar')->with(['r' => $r, 'ti' => $ti]);

    }

    function tools($id)
    {

        $r = DB::connection('oracle')->table('ceb_requisicoes')
            ->where(['id' => $id])
            ->first();


        $ti = DB::connection('oracle')->table('ceb_requisicoes_tools')
            ->where(['id_rec' => $id])
            ->get();


        return view('requisicoes/tools')->with(['r' => $r, 'ti' => $ti]);

    }

    function print($id)
    {

        $r = DB::connection('oracle')->table('ceb_requisicoes')
            ->where(['id' => $id])
            ->select('ceb_requisicoes.*',
                (DB::raw("(SELECT nom_funcionario FROM funcionario u1 WHERE u1.num_matricula = ceb_requisicoes.cod_fun1 and cod_empresa='04') AS nom_funcionario1")),
                (DB::raw("(SELECT nom_funcionario FROM funcionario u2 WHERE u2.num_matricula = ceb_requisicoes.cod_fun2 and cod_empresa='04') AS nom_funcionario2"))

            )
            ->first();


        $ti = DB::connection('oracle')->table('ceb_requisicoes_items')
            ->leftJoin('item', ['item.cod_item' => 'ceb_requisicoes_items.cod_comp'])
            ->where(['item.cod_empresa' => '04'])
            ->where(['id_rec' => $id])
            ->get();


        return view('requisicoes/print')->with(['r' => $r, 'ti' => $ti]);

    }


    function printtools($id)
    {

        $r = DB::connection('oracle')->table('ceb_requisicoes')
            ->where(['id' => $id])
            ->select('ceb_requisicoes.*',
                (DB::raw("(SELECT nom_funcionario FROM funcionario u1 WHERE u1.num_matricula = ceb_requisicoes.cod_fun1 and cod_empresa='04') AS nom_funcionario1")),
                (DB::raw("(SELECT nom_funcionario FROM funcionario u2 WHERE u2.num_matricula = ceb_requisicoes.cod_fun2 and cod_empresa='04') AS nom_funcionario2"))

            )
            ->first();


        $ti = DB::connection('oracle')->table('ceb_requisicoes_tools')
            ->where(['id_rec' => $id])
            ->get();


        return view('requisicoes/printtools')->with(['r' => $r, 'ti' => $ti]);

    }

    function update(RequisicoesRequest $r)
    {
        DB::beginTransaction();

        try {
            DB::connection('oracle')->table('ceb_requisicoes')
                ->where('id', Request::input('id'))
                ->update([

                    'cod_fun1' => Request::input('cod_fun1'),
                    'cod_fun2' => Request::input('cod_fun2'),
                    'num_ordem' => Request::input('num_ordem'),
                    'dat' => str_replace('T', ' ', Request::input('date')),
                    'fim' => str_replace('T', ' ', Request::input('fim')),
                    'horas' => Request::input('horas'),


                ]);


            if (Request::input('cod_item_compon')) {

                foreach (Request::input('cod_item_compon') as $key => $value) {


                    DB::connection('oracle')->table('ceb_requisicoes_items')
                        ->where('id', Request::input('iditem')[$key])
                        ->update([
                            'num_aviso_rec' => Request::input('ar')[$key],
                            'lote' => Request::input('lote')[$key],
                            'perda' => Request::input('perda')[$key],

                        ]);


                }
            }

            DB::commit();

        } catch (\Exception $e) {

            Log::critical($e);


        }


        return redirect()->action('RequisicoesController@index')->with(['id' => Request::input('id'), 'desc' => Request::input('descricao')]);
    }

    function getId()
    {

        return DB::connection('oracle')->table('ceb_requisicoes')
                ->max('id') + 0;


    }


    function getIdTools()
    {

        return DB::connection('oracle')->table('ceb_requisicoes_tools')
                ->max('id') + 0;


    }

    function getIdItens()
    {

        return DB::connection('oracle')->table('ceb_requisicoes_items')
                ->max('id') + 0;


    }
}
