@extends('default')
@section('content')
@include('modalremover')
@php 
	use Illuminate\Support\Facades\Request;
	    
    $funcionarios = App\Http\Controllers\OpenController::getFuncionarios();


@endphp
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Insumos e Acessórios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url ('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Insumos e Acessórios</li>
        </ol>
        <!--
        <div class="card mb-4">

            <div class="card-body">


            </div>
        </div>
         -->
       <form role="form" action="{{ url('requisicoes/tools')}}" class="form" method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                               Inserir insumos e acessórios
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
			 
				 <div class="form-group row">
				 	
				 	<label for="cod_item" class="col-sm-1 col-form-label">Cod Item</label>
                    <div class="col-sm-2 input-group">
                        <input type="text" name="cod_item" id="cod_item"  class="form-control"  onchange="getitem('{{ url('getitem')}}',this.value)"  value="{{old('cod_item')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"  onClick="getitem('{{ url('getitem')}}',cod_item.value)"  title="Consultar no Logix"><i class="fas fa-arrow-circle-down"></i></button>
                        </div>
                    </div>
				 	
                    <label for="den_item" class="col-sm-1 col-form-label">Den Item</label>
                    <div class="col-sm-5">
                      <input type="text" name="den_item" id="den_item" class="form-control"  required value="{{old('den_item')}}" readonly="readonly">
                    </div>
                    
                      <label for="cod_unid_med" class="col-sm-1 col-form-label">UN</label>
                    <div class="col-sm-2">
                      <input type="text" name="cod_unid_med" id="cod_unid_med" class="form-control"  required value="{{old('cod_unid_med')}}" readonly="readonly">
                    </div>
                     
                     
                     

             	</div>
             	
             	
             	<div class="form-group row">
             	
             	   <label for="num_aviso_rec" class="col-sm-1 col-form-label">AR</label>
                    <div class="col-sm-2">
                      <input type="text" name="num_aviso_rec" id="num_aviso_rec" class="form-control"  required value="{{old('num_aviso_rec')}}">
                    </div>
                    
                    <label for="lote" class="col-sm-1 col-form-label">Lote</label>
                    <div class="col-sm-2">
                      <input type="text" name="lote" id="lote" class="form-control"  required value="{{old('lote')}}">
                    </div>
                    
                    
                     <label for="inicio" class="col-sm-1 col-form-label">Inicio</label>
                    <div class="col-sm-2">
                      <input type="datetime-local" name="inicio" id="inicio" class="form-control"  required value="{{old('inicio')}}">
                    </div>
                    
                    
                     
                     <label for="fim" class="col-sm-1 col-form-label">Fim</label>
                    <div class="col-sm-2">
                      <input type="datetime-local" name="fim" id="fim" class="form-control"  required value="{{old('inicio')}}">
                    </div>
                    
             	
    				 	
                        </div>
             	
    				<button type="submit" class="col-sm-1 btn btn-primary">Inserir</button>

        		 	 
			 
			


			



				

           





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
                            	<th>#</th>
                            	<th>Item</th>
                                <th>Den Item</th>
                                <th>AR</th>
                                <th>Lote</th>
                                <th>Inicio</th>
                                <th>Fim</th>
                               
                            
                            </tr>
                        </thead>
                        
              
              
             
                        <tbody>
                        
                           @foreach($ti as $r)
                            <tr>
                            	<td style="text-align: right">
                          
                            		<a href="#" onclick="modal('{{ url('requisicoes/tools/remove/' . $r->id) }}')"><i class="fas fa-trash-alt mr-1 red"></i></a>
                            	</td>
                                <td>{{$r->cod_item}} </td>
                                <td>{{$r->descricao}}</td>
                                <td>{{$r->num_aviso_rec}}</td>
                                <td>{{$r->lote}}</td>
                                <td>{{ date("d/m/Y H:m:s", strtotime($r->inicio)) }}</td>
                   				<td>{{ date("d/m/Y H:m:s", strtotime($r->fim)) }}</td>
                    
                              </tr>
                          
                         @endforeach
                     
                           
                      
     
                        </tbody>
                    </table>
                </div>
            
            
            </div>
            </div>
            
    	<a href="{{ url()->previous() }}"  class="btn btn-secondary">Voltar</a>
    	
     </form>
        
    </div>
</main>
<script type="text/javascript" src="{{ asset('js/getitemtools.js')}}"/></script>
<script type="text/javascript">



setInterval(function () {
	 $('#msg').hide(); // show next div
}, 5 * 1000); // do this every 10 seconds    




function soma_mistura(){

	if(solicitadas.value > 0 && misturas.value > 0){
		total_misturas.value = (solicitadas.value * misturas.value).toFixed(3);;
	}
}



btngerar.addEventListener('click', function(event){
	 
	if(cod_item.value != "" && den_item.value != "" && solicitadas.value != "" && misturas.value != ""){
	   fetch("{{ url('getestrutura') }}?id=" + cod_item.value + "&solicitada=" + solicitadas.value + "&misturas=" + misturas.value).then(function(response) {
			  var contentType = response.headers.get("content-type");
			  if(contentType && contentType.indexOf("application/json") !== -1) {
			    return response.json().then(function(json) {
			      // process your JSON further
			    	//  console.log(json);
			    	orderAddRow(json)
			    });
			  } else {
			    console.log("Oops, we haven't got JSON!");
			  }
			});
		}
	});
	
	
	
	function orderAddRow($data) {
		$("tbody").children().remove()
	    $.each($data,function(index,value) {

	    	 //var json_estoque = 0;

	    		//var tecido = $("#requisicoes_itens").val();
	    	

	    		
	    		
	         	var markup = "<tr>"
                	+ "<td>" + value.cod_item_compon + "<input type=\"hidden\" name=\"cod_item_compon[]\" value='" +  value.cod_item_compon + "'  readonly></td>"
                    + "<td><input type=\"text\" name=\"ar[]\"  class=\"form-control\"></td>"
                    + "<td><input type=\"text\" name=\"lote[]\"  class=\"form-control\"></td>"
                    + "<td><input type=\"text\" name=\"perda[]\"  class=\"form-control\"></td>"
                    + "<td>" + parseFloat(value.qtd).toFixed(3)  +  " / " + parseFloat(value.qtdtotal).toFixed(3) + "<input type=\"hidden\" name=\"qtd[]\" value='"+ (value.qtd) + "'><input type=\"hidden\" name=\"qtdtotal[]\" value='"+ (value.qtdtotal) + "' ></td>"
                    + "<td>" +  value.cod_unid_med + "<input type=\"hidden\" name=\"cod_unid_med2[]\" value='" + value.cod_unid_med + "'  readonly></td>"
                    + "<td>" + value.cod_local_estoq + "<input type=\"hidden\" name=\"cod_local_estoq[]\" value='" + value.cod_local_estoq + "' class=\"form-control\" readonly></td>"
                    + "<td style=\"text-align: right\">" + parseFloat(value.estoque).toFixed(2) +  "<input type=\"hidden\" name=\"estoque[]\" value='"+ parseFloat(value.estoque).toFixed(2) + "' class=\"form-control\" readonly></td>"
                    +"</tr>";
            	$("#requisicoes_itens").append(markup);
		 		//renumber_table("#requisicoes_itens");
	     
	    			
  	          
	    });
	}

	

	
	</script>
 @endsection
	         	
