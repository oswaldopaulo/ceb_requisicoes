<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;


class OpenController extends ControllerOpen
{
 
    
     
    static function  getItens(){
         
        return  DB::connection('oracle')->table('item')
                ->select('cod_item','den_item')
                ->where(['cod_empresa'=>'04', 'ies_ctr_estoque'=>'S'])->get();
      
    }
    
    
    static function  getItem($id){
        
      
        
       $item =  DB::connection('oracle')->table('item')
        ->where(DB::raw("TRIM(cod_item)"), '=',$id)
        ->where(['cod_empresa'=>'04'])
        ->select('cod_item','den_item','cod_unid_med')->first();
       
        if($item){
            return response()->json($item);
        } else {
            return response()->json(['erro'=>'Item não encontrado']);
        }
        
    }
    
    
    static  function  getEstrutura(){
        
        $id= Request::input('id');
        $solicitada= Request::input('solicitada');
        $misturas= Request::input('misturas');
        
        $itens =  DB::connection('oracle')->select("Select estrutura.*, item.*,
        (qtd_necessaria*$solicitada) as qtd,
        ((qtd_necessaria*10)*$misturas) as qtdtotal,
        NVL((select sum(qtd_saldo) as saldo from Estoque_lote where cod_item = estrutura.cod_item_compon and cod_local=item.cod_local_estoq),0) as estoque
        
        from estrutura, item
        where estrutura.cod_item_pai like '$id' || '%'
        and item.cod_item=estrutura.cod_item_compon and item.cod_empresa='04' and estrutura.cod_empresa=item.cod_empresa");
        
        if($itens){
            return response()->json($itens);
        } else {
            return response()->json(['erro'=>'Item não encontrado']);
        }
        
    }
    
  
    static  function  getEstoque(){
        $cod_item= Request::input('cod_item');
        $cod_local_estoq= Request::input('cod_local_estoq');
       
        
        
        $resp =  DB::connection('oracle')->select("select sum(qtd_saldo) as saldo from Estoque_lote where cod_item like '$cod_item' || '%'
 and cod_empresa='04'");
        
        if($resp){
            return response()->json($resp);
        } else {
            return response()->json(['erro'=>'Item não encontrado']);
        }
        
    }
    
    static function  getFuncionarios(){
        
        
        return  DB::connection('oracle')->select("select num_matricula, nom_funcionario from funcionario f where f.dat_demis is not null and cod_empresa = '04'");
        
        
    }
    
        
    
}
