@extends('default')
@section('content')
@php 
	use Illuminate\Support\Facades\Request;
	    
    $funcionarios = App\Http\Controllers\OpenController::getFuncionarios();


@endphp
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Requisicoes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url ('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Editar Cadastro</li>
        </ol>
        <!--
        <div class="card mb-4">

            <div class="card-body">


            </div>
        </div>
         -->
       <form role="form" action="{{ url('requisicoes/editar')}}" class="form" method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                               Editar Cadastros
            </div>


            <div class="card-body">
            
            <div class="card text-white bg-danger mb-3" id="msg" style="padding: 5px; display: none;">
                        	<div class="card-body">
                            	<strong>Erro! </strong>
                            	Item  não encotrado
                           </div>
                        </div>

                 @if (!empty($errors->all()))
                    	<div class="alert alert-danger col-lg-12">
                    	<ul>
                    	@foreach ($errors->all() as $error)
                    		<li>{{ $error }}</li>
                    	@endforeach
                    	</ul>
                    	</div>
                    @endif


		
			 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			  <input type="hidden" name="id" id="id" value="{{ $r->id}}" />
			  
			  @if(!empty($ignore))
    			 	@foreach($ignore as $i)
                             <input type="hidden" id="ignore{{ $i }}" name="ignore{{ $i }}" value= "{{ $r->$i }}" />

                    @endforeach
                @endif
			 
				 <div class="form-group row">
				 	
				 	<label for="cod_item" class="col-sm-1 col-form-label">Cod Item</label>
                    <div class="col-sm-1 input-group">
                        <input type="text" name="cod_item" id="cod_item"  class="form-control"  value="{{$r->cod_item}}" readonly="readonly">
                        
                    </div>
				 	
                    <label for="den_item" class="col-sm-1 col-form-label">Den Item</label>
                    <div class="col-sm-3">
                      <input type="text" name="den_item" id="den_item" class="form-control"  required value="{{$r->den_item}}" readonly="readonly">
                    </div>
                    
                      <label for="cod_unid_med" class="col-sm-1 col-form-label">UN</label>
                    <div class="col-sm-1">
                      <input type="text" name="cod_unid_med" id="cod_unid_med" class="form-control"  required value="{{$r->cod_unid_med}}" readonly="readonly">
                    </div>
                
                    <button type="submit" class="col-sm-1 btn btn-primary">Adicionar</button>
                    
                     

             	</div>
             	
       
            </div>
            
             	
        </div>
        
        
         	<form role="form" action="{{ url('requisicoes/novo')}}" class="form" method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                               Componentes
            </div>


            <div class="card-body">
            
            
            <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="requisicoes_itens" width ="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>C.Comp</th>
                                <th>AR</th>
                                <th>Lote</th>
                                <th>Perda</th>
                                <th>Qtde</th>
                                <th>UN</th>
                                <th>Local</th>
                                <th>Est. CEB</th>
                               
                                                              
                                
                               
                            </tr>
                        </thead>
              
              
             
                        <tbody>
                     
                     
                     @foreach($ti as $i)
                    <tr>
                		<td> {{ $i->cod_comp }} <input type="hidden" name="cod_item_compon[]" value="{{ $i->cod_comp }}"><input type="hidden" name="iditem[]" value="{{ $i->id }}"></td>
                   		<td><input type="text" name="ar[]"  class="form-control" value="{{ $i->num_aviso_rec }}"></td>
                   		<td><input type="text" name="lote[]"  class="form-control" value="{{ $i->lote }}"></td>
                   		<td><input type="number" step=".001" name="perda[]"  class="form-control" value="{{ $i->perda }}"></td>
                   		<td>{{ $i->qtd }} / {{ $i->qtdtotal }} <input type="hidden" name="qtd[]" value="{{ $i->qtd }}"><input type="hidden" name="qtdtotal[]" value="{{ $i->qtdtotal}}" ></td>
                    	<td>{{ $i->cod_unid_med }} <input type="hidden" name="cod_unid_med2[]" value="{{ $i->cod_unid_med }}"  readonly></td>
                  		<td>{{ $i->cod_local_estoq }}<input type="hidden" name="cod_local_estoq[]" value="{{ $i->cod_local_estoq }}" class="form-control" readonly></td>
                    	<td style="text-align: right">{{ $i->estoque }}<input type="hidden" name="estoque[]" value="{{ $i->estoque}}" class="form-control" readonly></td>
                    </tr>
                     @endforeach    
                      
     
                        </tbody>
                    </table>
                </div>
            
            
            </div>
            </div>
            
    	<a href="{{ url()->previous() }}"  class="btn btn-secondary">Cancelar</a>
    	<button type="submit" class="btn btn-primary">Salvar</button>
     </form>
        
    </div>
</main>
<script type="text/javascript" src="{{ asset('js/getitem.js')}}"/></script>
<script type="text/javascript">



setInterval(function () {
	 $('#msg').hide(); // show next div
}, 5 * 1000); // do this every 10 seconds    




function soma_mistura(){

	if(solicitadas.value > 0 && misturas.value > 0){
		total_misturas.value = (solicitadas.value * misturas.value).toFixed(3);;
	}
}





	soma_mistura()
	
	</script>
 @endsection
	         	
