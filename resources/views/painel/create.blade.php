@extends('adminlte::page')

@section('title', 'Incluir O.S.')

@section('content_header')
    <h1 class="ml-2">Incluir nova Ordem de Serviço</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'oss.store']) !!}
            @php
             $hora_atual = Carbon\Carbon::now()->locale('pt_BR');
             $hora_atual = $hora_atual->isoFormat('LT');   
            @endphp
            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="far fa-clock ml-2 mr-1"></i>
                    {!! Form::label('entrada', 'Horário de entrada') !!}
                    {!! Form::time('entrada', $hora_atual, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}

                    @error('entrada')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <i class="far fa-clock ml-2 mr-1"></i>
                    {!! Form::label('saida', 'Horário de saída') !!}
                    {!! Form::time('saida', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-building ml-2 mr-1"></i>
                    {!! Form::label('empresa', 'Empresa') !!}
                    {!! Form::text('empresa', null, ['class' => 'form-control', 'autofocus', 'required', 'autocomplete' => 'off']) !!}
                    @error('empresa')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-user-tie ml-2 mr-1"></i>
                    {!! Form::label('solicitante', 'Solicitante') !!}
                    {!! Form::text('solicitante', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-user-shield ml-2 mr-1"></i>
                    {!! Form::label('idtv', 'ID TeamViewer') !!}
                    <a data-clipboard-target="#idtv" class="copia btn text-primary float-right p-0"><i class="fas fa-clipboard-list mr-1"></i>Copiar</a>
                    {!! Form::text('idtv', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-user-lock ml-2 mr-1"></i>
                    {!! Form::label('senhatv', 'Senha TeamViewer') !!}
                    <a data-clipboard-target="#senhatv" class="copia btn text-primary float-right p-0"><i class="fas fa-clipboard-list mr-1"></i>Copiar</a>
                    {!! Form::text('senhatv', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <i class="fas fa-exclamation-triangle ml-2 mr-1"></i>
                    {!! Form::label('solicitacao', 'Solicitação/Problema') !!}
                    {!! Form::textarea('solicitacao', null, ['class' => 'form-control', 'rows' => '2', 'required', 'placeholder' => 'Descreva a solicitação ou o problema relatado.', 'autocomplete' => 'off']) !!}
                    @error('solicitacao')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <i class="fas fa-tools ml-2 mr-1"></i>
                    {!! Form::label('solucao', 'Serviço executado') !!}
                    {!! Form::textarea('solucao', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Descreva o serviço executado para solucionar o problema.', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            {!! Form::button('<i class="fas fa-save mr-2"></i>Salvar Ordem de Serviço', ['type' => 'submit', 'class' => 'btn btn-success btn-lg float-right']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/painel/painel_custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="/storage/painel/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <style>
        .font-grow{
            font-size: 18px;
        }
        .font-grow2{
            top: 5px;
            font-size: 18px;
        }
    </style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Copiar -->
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script src="{{asset('js/copy.js')}}"></script>
<!-- /Copiar -->
@stop