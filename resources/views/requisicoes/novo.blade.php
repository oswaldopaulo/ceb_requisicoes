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
                <li class="breadcrumb-item active">Novo Cadastro</li>
            </ol>

            <form name="myForm" onsubmit="return validateForm()" role="form" action="{{ url('requisicoes/novo')}}"
                  class="form" method="post" enctype="multipart/form-data">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Novo Cadastros
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


                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="S" id="mistura" name="mistura"
                                       checked>
                                <label class="form-check-label" for="mistura">
                                    Mistura? <small class="text-muted">Oculta a descrição do item no relatório.</small>
                                </label>
                            </div>


                        </div>

                        <div class="form-group row">
                            <label for="dest" class="col-sm-1 col-form-label">Destino</label>
                            <div class="col-sm-8">
                                <input type="text" name="dest" id="dest" class="form-control" value="{{old('dest')}}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="cod_item" class="col-sm-1 col-form-label">Cod Item</label>
                            <div class="col-sm-2">
                                <input type="text" name="cod_item" id="cod_item" class="form-control"
                                       value="{{old('cod_item')}}"
                                       onfocusout="getitem('{{ url('getitem')}}',this.value)">

                            </div>

                            <label for="den_item" class="col-sm-1 col-form-label">Den Item</label>
                            <div class="col-sm-5">
                                <input type="text" name="den_item" id="den_item" class="form-control" required
                                       value="{{old('den_item')}}" readonly="readonly">
                            </div>

                            <label for="cod_unid_med" class="col-sm-1 col-form-label">UN</label>
                            <div class="col-sm-2">
                                <input type="text" name="cod_unid_med" id="cod_unid_med" class="form-control" required
                                       value="{{old('cod_unid_med')}}" readonly="readonly">
                            </div>


                        </div>





                        <div class="form-group row">

                            <label for=dat" class="col-sm-1 col-form-label">Inicio</label>
                            <div class="col-sm-2">
                                <input type="datetime-local" name="date" id="dat" class="form-control"
                                       value="<?php echo date('Y-m-d'); ?>">
                            </div>


                            <label for=fim" class="col-sm-1 col-form-label">Fim</label>
                            <div class="col-sm-2">
                                <input type="datetime-local" name="fim" id="fim" class="form-control"
                                       value="<?php echo date('Y-m-d'); ?>">
                            </div>


                            <label for="horas" class="col-sm-1 col-form-label">H. Trabalhada</label>
                            <div class="col-sm-2">
                                <input type="number" name="horas" id="horas" class="form-control"
                                       value="{{old('horas')}}">
                            </div>

                            <label for="num_ordem" class="col-sm-1 col-form-label">Nº Ordem</label>
                            <div class="col-sm-2">
                                <input type="number" name="num_ordem" id="num_ordem" class="form-control"
                                       value="{{old('num_ordem')}}">
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
                                                    @if(old('cod_fun1')==$f->num_matricula) selected @endif>{{ $f->num_matricula }}
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
                                                    @if(old('cod_fun2')==$f->num_matricula) selected @endif>{{ $f->num_matricula }}
                                                - {{ $f->nom_funcionario }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>


                            <label for="solicitadas" class="col-sm-1 col-form-label">Solicitadas</label>
                            <div class="col-sm-1">
                                <input type="number" name="solicitadas" id="solicitadas" class="form-control"
                                       onfocusout="soma_mistura()" required value="{{old('solicitadas')}}">
                            </div>


                            <label for="misturas" class="col-sm-1 col-form-label">Misturas</label>
                            <div class="col-sm-1">
                                <input type="number" name="misturas" id="misturas" class="form-control"
                                       onfocusout="soma_mistura()" required value="{{old('misturas')}}">
                            </div>


                            <label for="total_misturas" class="col-sm-1 col-form-label">Total</label>
                            <div class="col-sm-1">
                                <input type="text" name="total_misturas" id="total_misturas" class="form-control"
                                       required readonly="readonly" value="{{old('total_misturas')}}">
                            </div>


                        </div>


                        <a id="btngerar" class="btn btn-primary">Gerar</a>


                    </div>


                </div>


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


        btngerar.addEventListener('click', function (event) {

            if (cod_item.value != "" && den_item.value != "" && solicitadas.value != "" && misturas.value != "") {
                fetch("{{ url('getestrutura') }}?id=" + cod_item.value + "&solicitada=" + solicitadas.value + "&misturas=" + misturas.value).then(function (response) {
                    var contentType = response.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        return response.json().then(function (json) {
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
            $.each($data, function (index, value) {


                var markup = "<tr>"
                    + "<td>" + value.cod_item_compon + "<input type=\"hidden\" id=\"cod_item_compon[]\" name=\"cod_item_compon[]\" value='" + value.cod_item_compon + "'  readonly></td>"
                    + "<td><input type=\"text\" maxlength=\"6\" name=\"ar[]\"  class=\"form-control\"></td>"
                    + "<td><input type=\"text\" maxlength=\"20\" name=\"lote[]\"  class=\"form-control\"></td>"
                    + "<td><input type=\"text\" name=\"perda[]\"  class=\"form-control\"></td>"
                    + "<td>" + parseFloat(value.qtd).toFixed(3) + " / " + parseFloat(value.qtdtotal).toFixed(3) + "<input type=\"hidden\" name=\"qtd[]\" value='" + (value.qtd) + "'><input type=\"hidden\" name=\"qtdtotal[]\" value='" + (value.qtdtotal) + "' ></td>"
                    + "<td>" + value.cod_unid_med + "<input type=\"hidden\" name=\"cod_unid_med2[]\" value='" + value.cod_unid_med + "'  readonly></td>"
                    + "<td>" + value.cod_local_estoq + "<input type=\"hidden\" name=\"cod_local_estoq[]\" value='" + value.cod_local_estoq + "' class=\"form-control\" readonly></td>"
                    + "<td style=\"text-align: right\">" + parseFloat(value.estoque).toFixed(2) + "<input type=\"hidden\" name=\"estoque[]\" value='" + parseFloat(value.estoque).toFixed(2) + "' class=\"form-control\" readonly></td>"
                    + "</tr>";
                $("#requisicoes_itens").append(markup);
                //renumber_table("#requisicoes_itens");


            });
        }


        function validateForm() {


            if (document.getElementById('requisicoes_itens').rows.length <= 1) {

                alert('Clique no botão gerar antes de salvar');
                return false

            }
        }
    </script>
@endsection

