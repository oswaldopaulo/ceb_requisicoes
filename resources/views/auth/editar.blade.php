@extends('default')
@section('content')
    @include('modalmsg')
    @php
        use \App\Http\Controllers\EstadosController;



    @endphp
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Usuários</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url ('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Novo Cadastro</li>
            </ol>
            <!--
            <div class="card mb-4">

                <div class="card-body">


                </div>
            </div>
             -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Novo Cadastros
                </div>


                <div class="card-body">

                    @if (!empty($errors->all()))
                        <div class="alert alert-danger col-lg-12">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form role="form" action="{{ url('usuarios/editar')}}" class="form" method="post">
						@if(Auth::user()->tipo==1)
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="tipo" name="tipo"  @if($r->tipo=='1') checked @endif>
                                <label class="form-check-label" for="tipo">
                                    Administrador
                                </label>
                            </div>
                        </div>
                        @endif
                        
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="hidden" name="id" id="id" value="{{ $r->id }}" />
                        @if(!empty($ignore))
                            @foreach($ignore as $i)
                                <input type="hidden" id="ignore{{ $i }}" name="ignore{{ $i }}" value= "{{ $r->$i }}" />

                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">Nome</label>
                            <div class="col-sm-11">
                                <input type="text" name="name" id="name" class="form-control"  required value="{{ $r->name }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="username" class="col-sm-1 col-form-label">Usuário Logix</label>
                            <div class="col-sm-2">
                                <input type="text" name="username" id="username" class="form-control" required value="{{ $r-> username }}">
                            </div>

                            <label for="email" class="col-sm-1 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="email" class="form-control"  required  value="{{ $r->email }}" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-1 col-form-label">Senha</label>
                            <div class="col-sm-5">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <label for="password_confirmation" class="col-sm-1 col-form-label">Confirma</label>
                            <div class="col-sm-5">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-sm-1 col-form-label">CPF</label>
                            <div class="col-sm-5">
                                <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $r->cpf }}">
                            </div>
                            <label for="telefone" class="col-sm-1 col-form-label">Telefone</label>
                            <div class="col-sm-5">
                                <input type="tel" name="telefone" id="telefone" class="form-control" value="{{ $r->telefone }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-sm-1 col-form-label">CEP</label>
                            <div class="col-sm-2 input-group">
                                <input type="text" name="cep_end" id="cep_end"  class="form-control"  value="{{$r->cep}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"  onClick="getcep(cep_end.value)"title="Baixar do ViaCep"><i class="fas fa-cloud-download-alt"></i></button>
                                </div>
                            </div>
                            <label for="rua" class="col-sm-1 col-form-label">Rua</label>
                            <div class="col-sm-6">
                                <input type="text" name="rua" id="des_end" class="form-control"  value="{{ $r->rua }}">
                            </div>
                            <label for="numero" class="col-sm-1 col-form-label">Nº</label>
                            <div class="col-sm-1">
                                <input type="text" name="numero" id="numero" class="form-control"  value="{{ $r->numero }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bairro" class="col-sm-1 col-form-label">Bairro</label>
                            <div class="col-sm-4">
                                <input type="text" name="bairro" id="bairro" class="form-control"  value="{{ $r->bairro }}">
                            </div>
                            <label for="cidade" class="col-sm-1 col-form-label">Cidade</label>
                            <div class="col-sm-4">
                                <input type="text" name="cidade" id="des_cidade" class="form-control"  value="{{ $r->cidade }}">
                            </div>
                            <label for="uf" class="col-sm-1 col-form-label">UF</label>
                            <div class="col-sm-1">

                                <select id="des_uf" name="uf"  class="form-control" ">
                                <option value="">Selecione o Estado</option>
                                @foreach(EstadosController::arrayforoptions() as $e)
                                    <option value="{{$e->uf_estado}}" @if($r->uf==$e->uf_estado) selected @endif>{{$e->nome_estado}}</option>
                                    @endforeach

                                    </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="S" id="ativo" name="ativo"  @if($r->ativo=='S') checked @endif>
                                <label class="form-check-label" for="ativo">
                                    Ativo
                                </label>
                            </div>
                        </div>


                        <a href="{{ url()->previous()  }}"  class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>





                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="{{ asset('js/getcep.js')}}"/></script>
    <script type="text/javascript" src="{{ asset('js/gettoken.js')}}"/></script>
    <script type="text/javascript">
        //generateToken(token,50);
    </script>
@endsection
