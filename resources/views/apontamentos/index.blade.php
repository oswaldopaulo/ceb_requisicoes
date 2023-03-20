@extends('default')
@section('content')  
@include('modalremover')
<script src="{{ asset('assets/demo/datatables-apontamentos.js') }}"></script>
<script type="text/javascript">
	function novo() {
		
		window.location.href = "{{ url('apontamentos/novo')}}";
	}

    function novomanual() {

        window.location.href = "{{ url('apontamentos/novomanual')}}";
    }
</script>
<style>
 td {
    white-space: nowrap;
 }
</style>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Apontamentos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url ('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Apontamentos</li>
        </ol>
        
        
                   @if (!empty($errors->all())) 
                    	 <div class="card bg-danger text-white mb-4 card mb-4" id="msg" style="padding: 5px">
                        	<ul>
                        	@foreach ($errors->all() as $error)
                        		<li>{{ $error }}</li>
                        	@endforeach
                        	</ul>
                    	</div>
                    @endif
                  					 
                              
                       
       
  
          			@if(session('acao'))
                    	 @if(session('id'))
                    	  <div class="card bg-warning text-white mb-4 card mb-4" id="msg" style="padding: 5px">
                                    <div class="card-body">
                                    <strong>Sucesso!</strong>
                                   	O registro {{ session('id')  }}  foi deletado.
                                     </div>   
                                    
                                </div>
                     @endif
                    @else
                    	@if(session('id'))
        				 <div class="card bg-success text-white mb-4 card mb-4" id="msg" style="padding: 5px">
                        	<div class="card-body">
                            	<strong>Sucesso! </strong>
                            	O registro {{ session('id')  }} {{ session('desc')  }} foi gravado.
                           </div>
                        </div>
                    
                      @endif
                    @endif
        <div class="card mb-4">
            <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                               Cadastros @if(!Request::input('all'))
                                    <small style="text-align: right"> (Filtrado ultimos 500 <a style="color: #0c77af" href="{{ url("apontamentos" . "?all=1") }}"> Mostrar Todos</a>)</small>
                                             @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width ="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width: 50px"></th>
                            	<th>Empresa</th>
                                <th>ID</th>
                                <th>O.P</th>
                                <th>D.Prod</th>
                                <th>H.Prod</th>
{{--                                <th>Sol.</th>--}}
                                <th>U. Apontamento</th>
                                <th>Funcionario</th>
                                <th>Item</th>
                                <th>Qtd Produziada</th>
                                <th>Perda</th>

                            </tr>
                        </thead>
              
              
             
                        <tbody>
                        @foreach($t as $r)
                            <tr>
                            	<td style="text-align: right">
                              		<a href="{{ url('apontamentos/tools/' . $r->seq_reg_mestre)}}" title="Insumos e Ferramentas"> <i class="fas fa-tools mr-1 blue"></i></a>
                            		<a href="{{ url('apontamentos/funcionarios/' . $r->seq_reg_mestre)}}" title="Funcionarios"> <i class="fas fa-users mr-1 blue"></i></a>
                            		</td>
                                <td>{{$r->empresa}} </td>
                                <td>{{$r->seq_reg_mestre  }} </td>
                                <td>{{$r->ordem_producao }} </td>
                                <td>{{ $r->data_producao_filtro }}</td>
                                <td>{{ $r->hor_apontamento }}</td>
                                <td>{{ $r->usu_apontamento }}</td>
                                <td>{{ $r->nom_funcionario }}</td>
                                <td>{{ trim($r->item_produzido ?? "") . " - " . $r->den_item}}</td>
                                <td>{{$r->qtd_produzida}}</td>
                                <td>{{$r->perda}}</td>

                              </tr>
                          
                         @endforeach
     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">


 setInterval(function () {
    	 $('#msg').hide(); // show next div
    }, 5 * 1000); // do this every 10 seconds    


</script>
 @endsection        
