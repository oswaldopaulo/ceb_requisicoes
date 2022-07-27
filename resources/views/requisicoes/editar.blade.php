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
            <form role="form" action="{{ url('requisicoes/editar')}}" class="form" method="post"
                  enctype="multipart/form-data">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Editar Cadastros
                    </div>


                    <div class="card-body">

                        <div class="card text-white bg-danger mb-3" id="msg" style="padding: 5px; display: none;">
                            <div class="card-body">
                                <strong>Erro! </strong>
                                Item não encotrado
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


                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                        <input type="hidden" name="id" id="id" value="{{ $r->id}}"/>

                        @if(!empty($ignore))
                            @foreach($ignore as $i)
                                <input type="hidden" id="ignore{{ $i }}" name="ignore{{ $i }}" value="{{ $r->$i }}"/>

                            @endforeach
                        @endif


                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="S" id="mistura" name="mistura"
                                       @if($r->mistura=='S')checked @endif>
                                <label class="form-check-label" for="mistura">
                                    Mistura? <small class="text-muted">Oculta a descrição do item no relatório.</small>
                                </label>
                            </div>


                        </div>

                        <div class="form-group row">
                            <label for="dest" class="col-sm-1 col-form-label">Destino</label>
                            <div class="col-sm-8">
                                <input type="text" name="dest" id="dest" class="form-control" value="{{$r->dest}}"
                                       readonly>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="cod_item" class="col-sm-1 col-form-label">Cod Item</label>
                            <div class="col-sm-2 input-group">
                                <input type="text" name="cod_item" id="cod_item" class="form-control"
                                       value="{{$r->cod_item}}" readonly="readonly">

                            </div>

                            <label for="den_item" class="col-sm-1 col-form-label">Den Item</label>
                            <div class="col-sm-5">
                                <input type="text" name="den_item" id="den_item" class="form-control" required
                                       value="{{$r->den_item}}" readonly="readonly">
                            </div>

                            <label for="cod_unid_med" class="col-sm-1 col-form-label">UN</label>
                            <div class="col-sm-2">
                                <input type="text" name="cod_unid_med" id="cod_unid_med" class="form-control" required
                                       value="{{$r->cod_unid_med}}" readonly="readonly">
                            </div>


                        </div>


                        <div class="form-group row">

                        </div>


                        <div class="form-group row">

                            <label for=dat" class="col-sm-1 col-form-label">Inicio</label>
                            <div class="col-sm-2">
                                <input type="datetime-local" name="date" id="dat" class="form-control"
                                       value="{{ str_replace(' ','T',$r->dat) }}">
                            </div>


                            <label for="fim" class="col-sm-1 col-form-label">Fim</label>
                            <div class="col-sm-2">
                                <input type="datetime-local" name="fim" id="fim" class="form-control"
                                       value="{{ str_replace(' ','T',$r->fim) }}">
                            </div>


                            <label for="horas" class="col-sm-1 col-form-label">Horas</label>
                            <div class="col-sm-2">
                                <input type="number" step="0.1" name="horas" id="horas" class="form-control" value="{{$r->horas}}">
                            </div>


                            <label for="num_ordem" class="col-sm-1 col-form-label">Nº Ordem</label>
                            <div class="col-sm-2">
                                <input type="number" name="num_ordem" id="num_ordem" class="form-control"
                                       value="{{$r->num_ordem}}">
                            </div>

                        </div>


                        <div class="form-group row">

                            <label for="cod_fun1" class="col-sm-1 col-form-label">Funcionario 1</label>
                            <div class="col-sm-2">
                                <select class="form-control selectpicker" data-live-search="true" name="cod_fun1"
                                        placeholder="Funcionario">
                                    <option value="">Selecione</option>

                                    @if($funcionarios)
                                        @foreach($funcionarios as $f)
                                            <option value="{{ $f->num_matricula}}"
                                                    @if(trim($r->cod_fun1)==$f->num_matricula) selected="selected" @endif>{{ $f->num_matricula }}
                                                - {{ $f->nom_funcionario }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <label for="cod_fun2" class="col-sm-1 col-form-label">Funcionario 2</label>
                            <div class="col-sm-2">
                                <select class="form-control selectpicker" data-live-search="true" name="cod_fun2"
                                        placeholder="Funcionario">
                                    <option value="">Selecione</option>
                                    @if($funcionarios)
                                        @foreach($funcionarios as $f)
                                            <option value="{{ $f->num_matricula}}"
                                                    @if(trim($r->cod_fun2)==$f->num_matricula) selected="selected" @endif>{{ $f->num_matricula }}
                                                - {{ $f->nom_funcionario }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>


                            <label for="solicitadas" class="col-sm-1 col-form-label">Solicitadas</label>
                            <div class="col-sm-1">
                                <input type="number" name="solicitadas" step="0.001" id="solicitadas" class="form-control"
                                       onchange="soma_mistura()" required value="{{$r->solicitada}}"
                                       readonly="readonly">
                            </div>


                            <label for="misturas" class="col-sm-1 col-form-label">Misturas</label>
                            <div class="col-sm-1">
                                <input type="number" name="misturas" id="misturas" class="form-control"
                                       onchange="soma_mistura()" required value="{{$r->misturas}}" readonly="readonly">
                            </div>


                            <label for="total_misturas" class="col-sm-1 col-form-label">Total</label>
                            <div class="col-sm-1">
                                <input type="text" name="total_misturas" id="total_misturas" class="form-control"
                                       required readonly="readonly">
                            </div>


                        </div>


                    </div>


                </div>


                <form role="form" action="{{ url('requisicoes/novo')}}" class="form" method="post"
                      enctype="multipart/form-data">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Componentes
                        </div>


                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap" id="requisicoes_itens" width="100%"
                                       cellspacing="0">
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
                                            <td> {{ $i->cod_comp }} <input type="hidden" name="cod_item_compon[]"
                                                                           value="{{ $i->cod_comp }}"><input
                                                        type="hidden" name="iditem[]" value="{{ $i->id }}"></td>
                                            <td><input type="number" name="ar[]" maxlength="6" class="form-control"
                                                       value="{{ $i->num_aviso_rec }}"></td>
                                            <td><input type="text" name="lote[]" maxlength="20" class="form-control"
                                                       value="{{ $i->lote }}"></td>
                                            <td><input type="number" step=".001" name="perda[]" class="form-control"
                                                       value="{{ number_format((float)($i->perda ), 3, '.', '') }}">
                                            </td>
                                            <td>{{ number_format((float)($i->qtd ), 3, ',', '.') }}
                                                / {{ number_format((float)($i->qtdtotal ), 3, ',', '.') }} <input
                                                        type="hidden" name="qtd[]" value="{{ $i->qtd }}"><input
                                                        type="hidden" name="qtdtotal[]" value="{{ $i->qtdtotal}}"></td>
                                            <td>{{ $i->cod_unid_med }} <input type="hidden" name="cod_unid_med2[]"
                                                                              value="{{ $i->cod_unid_med }}" readonly>
                                            </td>
                                            <td>{{ $i->cod_local_estoq }}<input type="hidden" name="cod_local_estoq[]"
                                                                                value="{{ $i->cod_local_estoq }}"
                                                                                class="form-control" readonly></td>
                                            <td style="text-align: right">{{ number_format((float)($i->estoque  ), 3, ',', '.') }}
                                                <input type="hidden" name="estoque[]" value="{{ $i->estoque}}"
                                                       class="form-control" readonly></td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>

        </div>
    </main>
    <script type="text/javascript" src="{{ asset('js/getitem.js')}}"/></script>
    <script type="text/javascript">


        setInterval(function () {
            $('#msg').hide(); // show next div
        }, 5 * 1000); // do this every 10 seconds


        function soma_mistura() {

            if (solicitadas.value > 0 && misturas.value > 0) {
                total_misturas.value = (solicitadas.value * misturas.value).toFixed(3);
                ;
            }
        }


        soma_mistura()

    </script>
@endsection

