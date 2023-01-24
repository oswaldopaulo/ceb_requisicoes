@extends('default')
@section('content')  
@include('modalremover')
<script src="{{ asset('assets/demo/datatables-requisicoes.js') }}"></script>
<script type="text/javascript">
	function novo() {
		
		window.location.href = "{{ url('requisicoes/novo')}}";
	}

    function novomanual() {

        window.location.href = "{{ url('requisicoes/novomanual')}}";
    }
</script>
<style>
 td {
    white-space: nowrap;
 }
</style>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Requisições</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url ('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Requisições</li>
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
                                    <small style="text-align: right"> (Filtrado ultimos 500 <a style="color: #0c77af" href="{{ url("requisicoes" . "?all=1") }}"> Mostrar Todos</a>)</small>
                                             @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width ="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width: 50px"></th>
                            	<th>Id</th>
                            	@if(Auth::user()->tipo==1)<th>Ativo</th>@endif
                                <th>D.Criação</th>
                                <th>Item</th>
                                <th>Sol.</th>
                                <th>Mist.</th>
                                <th>NºOrdem</th>
                                <th>Inicio</th>
                                <th>Fim</th>
                                <th>Usuário</th>
                               
                                
                               
                            </tr>
                        </thead>
              
              
             
                        <tbody>
                        @foreach($t as $r)
                            <tr>
                            	<td style="text-align: right">
                            	
                            	
                            	
                       
                            		
                            		<a href="{{ url('requisicoes/tools/' . $r->id)}}"> <i class="fas fa-tools mr-1 blue"></i></a>
                            		<a href="{{ url('requisicoes/editar/' . $r->id)}}"> <i class="fas fa-edit mr-1 blue"></i></a>
                            		<a href="#" onclick="modal('{{ url('requisicoes/remove/' . $r->id) }}')"><i class="fas fa-trash-alt mr-1 red"></i></a>
                            		
                            		<div class="btn-group mr-1 blue">
                                          <a class="btn dropdown-toggle blue" data-toggle="dropdown" href="#">
                                            <i class="fas fa-print mr-1 blue "></i>
                                            <span class="caret"></span>
                                            
                                          </a>
                                          <ul class="dropdown-menu">
                                            <!-- dropdown menu links -->
                                             	<li><a style="margin-left: 10px" href="#"><a href="{{ url('requisicoes/print/' . $r->id)}}" target="print"> <i class="fas fa-print mr-1 blue "></i>Requisição</a></a></li>
                                          		<li><a style="margin-left: 10px" href="#"><a href="{{ url('requisicoes/printtools/' . $r->id)}}" target="print"> <i class="fas fa-print mr-1 blue "></i>Insumos e Ferr.</a></a></li>
                                          </ul>
                                	</div>
                            	
                            	</td>
                                <td>{{$r->id}} </td>
                                @if(Auth::user()->tipo==1) <td>{{$r->ativo}} </td>@endif
                                <td>{{$r->criacao ? date("d/m/y H:m", strtotime($r->criacao)): "" }} </td>
                                <td>{{$r->cod_item }} - {{$r->den_item }} </td>
                                <td>{{ $r->solicitada }}</td>
                                <td>{{ $r->misturas }}</td>
                                <td>{{ $r->num_ordem }}</td>
                                <td>{{ $r->dat?date("d/m/Y H:m:s", strtotime($r->dat)):''}}</td>
                                <td>{{ $r->fim?date("d/m/Y H:m:s", strtotime($r->fim)):''}}</td>
                                <td>{{$r->usuario}}</td>
                    
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
