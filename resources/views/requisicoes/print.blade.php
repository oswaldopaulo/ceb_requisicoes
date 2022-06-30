@php 
	use Illuminate\Support\Facades\Request;
	use Illuminate\Support\Str;    
    $funcionarios = App\Http\Controllers\OpenController::getFuncionarios();


@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Requisição CEB {{ $r->id }}</title>
        <link href="{{ asset ('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset ('vendor/datatables-1.10.21/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
         <script src="{{ asset ('js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset ('vendor/fontawesome-free-5.13.1-web/js/all.min.js') }}" ></script>



        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.css"/>


    </head>
    <body class="sb-nav-fixed">
    
    
    <header>
    <div class="container-fluid">
    <h1 class="mt-4"><img alt="" src="{{ asset('assets/img/logo_ceb.jpg')}}"> </h1>
       
       
           <div class="card mb-4">
			<div class="row">
              <div class="col-sm-3">
                <div>
                  <div class="card-body">
                    <h5 class="card-title">Assunto:</h5>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div >
                  <div class="card-body">
                    <h2 class="card-title text-center">REQUISIÇÃO DE MATERIAIS</h2>
         
                    
                  </div>
                </div>
              </div>
              
               <div class="col-sm-3">
                <div>
                  <div class="card-body">
                  	<p class="card-title text-right">Data Emissão: {{ date('d/m/Y') }}</p>
                  	<p class="card-title text-right">Hora Emissão: {{ date('H:i:s') }}</p>
                    
         
                    
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>
    </header>
<main>
    <div class="container-fluid">
        
        
        <div class="mb-4">

     
       <form role="form" action="{{ url('requisicoes/editar')}}" class="form" method="post" enctype="multipart/form-data">
        <div class="card mb-4 border-0">
            


            <div class="card-body ">
            
          
		
			 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			  <input type="hidden" name="id" id="id" value="{{ $r->id}}" />
			  
			  @if(!empty($ignore))
    			 	@foreach($ignore as $i)
                             <input type="hidden" id="ignore{{ $i }}" name="ignore{{ $i }}" value= "{{ $r->$i }}" />

                    @endforeach
                @endif
			 
				 <div class="form-group row">
				 	
				 	<label for="cod_item" class="col-sm-2 col-form-label"><strong>ID: </strong> {{$r->id}}</label>
                    <label for="cod_item" class="col-sm-7 col-form-label"> <strong>Ordem: </strong> {{$r->num_ordem}} </label>
				 	
                    <label for="den_item" class="col-sm-2 col-form-label"><strong>UN</strong> </label>
                    <label for="den_item" class="col-sm-1 col-form-label">{{$r->cod_unid_med}}</label>
                   
                    <label for="den_item" class="col-sm-9 col-form-label"><strong>ITEM:   </strong>{{$r->cod_item}} {{$r->den_item}}</label>
                   
                    
                    
                    <label for="den_item" class="col-sm-2 col-form-label"><strong>Solicitado:</strong></label>
                    <label for="den_item" class="col-sm-1 col-form-label text-right">{{$r->solicitada}}</label>
                    
                    
                    <label for="den_item" class="col-sm-3 col-form-label"><strong>Cod Fun 1: </strong>{{trim($r->cod_fun1)}} {{$r->nom_funcionario1}}</label>
                   
                    
                    <label for="den_item" class="col-sm-6 col-form-label"><strong>Cod Fun 2:  </strong> {{trim($r->cod_fun2)}} {{$r->nom_funcionario2}}</label>
              
                    
                    <label for="den_item" class="col-sm-2 col-form-label"><strong>Misturas</strong></label>
                    <label for="den_item" class="col-sm-1 col-form-label text-right">{{$r->misturas}}</label>
                    
                    
                    <label for="den_item" class="col-sm-3 col-form-label"><strong>Inicio: </strong>{{ $r->dat?date("d/m/Y H:m:s", strtotime($r->dat)):''}}</label>
                    <label for="den_item" class="col-sm-3 col-form-label"><strong>Fim: </strong>{{ $r->fim?date("d/m/Y H:m:s", strtotime($r->fim)):''}}</label>
                    
                    <label for="den_item" class="col-sm-3 col-form-label"><strong>Horas: </strong>{{ $r->horas }}</label>
              
                    
            
                    
                    
                    <label for="den_item" class="col-sm-1 col-form-label"><strong>Total</strong></label>
                    <label for="den_item" class="col-sm-2 col-form-label text-right">{{ number_format((float)($r->misturas * $r->solicitada), 2, ',', '') }}</label>

             	</div>
             	
             	
        

            </div>
            
            
            
            
            
            	
        </div>
        
        
         	<form role="form" action="{{ url('requisicoes/novo')}}" class="form" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                               Componentes
            </div>


            <div class="card-body">
            
            
            <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="requisicoes_itens" width ="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th>Item</th>
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
                		<td> {{ $i->cod_comp }}  @if($r->mistura=='N') - {{Str::limit($i->den_item,30)}} @endif<input type="hidden" name="cod_item_compon[]" value="{{ $i->cod_comp }}"><input type="hidden" name="iditem[]" value="{{ $i->id }}"></td>
                   		<td>{{ $i->num_aviso_rec }}</td>
                   		<td>{{ $i->lote }}</td>
                   		<td>{{ $i->perda }}</td>
                   		<td>{{ number_format((float)($i->qtd ), 2, ',', '.') }} /  {{ number_format((float)($i->qtdtotal ), 2, ',', '.') }} <input type="hidden" name="qtd[]" value="{{ $i->qtd }}"><input type="hidden" name="qtdtotal[]" value="{{ $i->qtdtotal}}" ></td>
                    	<td>{{ $i->cod_unid_med }} <input type="hidden" name="cod_unid_med2[]" value="{{ $i->cod_unid_med }}"  readonly></td>
                  		<td>{{ $i->cod_local_estoq }}<input type="hidden" name="cod_local_estoq[]" value="{{ $i->cod_local_estoq }}" class="form-control" readonly></td>
                    	<td style="text-align: right">{{ number_format((float)($i->estoque  ), 2, ',', '.') }}<input type="hidden" name="estoque[]" value="{{ $i->estoque}}" class="form-control" readonly></td>
                    </tr>
                     @endforeach    
                      
     
                        </tbody>
                    </table>
                </div>
            
            
            </div>
            </div>
            
    	
     </form>
        
    </div>
</main>

<footer>
<div class="container-fluid">
    
       
       
          
			<div class="row">
              <div class="col-sm-4">
                <div>
                  <div class="card-body">
                    <h5 class="card-title text-center">Separador</h5>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div >
                  <div class="card-body">
                   <h5 class="card-title text-center">Conferente</h5>
         
                    
                  </div>
                </div>
              </div>
              
               <div class="col-sm-4">
                <div>
                  <div class="card-body">
                  	<h5 class="card-title text-center">Recebido</h5>
                    
         
                    
                  </div>
                </div>
              </div>
           

            
        </div>
    </div>

</footer>
<script type="text/javascript" src="{{ asset('js/getitem.js')}}"/></script>

 <script src="{{ asset ('vendor/bootstrap-4.5.0-dist/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset ('js/scripts.js') }}"></script>
        <script src="{{ asset('vendor/datatables-1.10.21/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables-1.10.21/js/dataTables.bootstrap4.min.js') }}"></script>

         <script src="{{ asset('vendor/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js') }}">  </script>
        <link href="{{ asset ('vendor/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"/>

        @if (Request::path() != 'loja')
        <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
        @else
             <script src="{{ asset('assets/demo/datatables-loja.js') }}"></script>
        @endif

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>
	<script type="text/javascript">



setInterval(function () {
	 $('#msg').hide(); // show next div
}, 5 * 1000); // do this every 10 seconds    






	
	window.print();
	</script>
    </body>
</html> 
	         	
