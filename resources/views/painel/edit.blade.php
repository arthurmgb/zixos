@extends('adminlte::page')

@section('title', 'Editar O.S.')

@section('content_header')
    <h1 class="ml-2">Editar Ordem de Serviço</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @php

                if($oss->saida){

                $oss->saida = Carbon\Carbon::parse($oss->saida)->format('H:i');

                }else{

                $oss->saida = null;
                
                }
                
            @endphp

            {!! Form::model($oss, ['route' => ['oss.update', $oss], 'method' => 'put']) !!}

            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="far fa-clock ml-2 mr-1"></i>
                    {!! Form::label('entrada', 'Horário de entrada') !!}
                    {!! Form::time('entrada', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}

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
                    {!! Form::text('empresa', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
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
                    {!! Form::text('idtv', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-user-lock ml-2 mr-1"></i>
                    {!! Form::label('senhatv', 'Senha TeamViewer') !!}
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
            {!! Form::button('<i class="fas fa-save mr-2"></i>Atualizar Ordem de Serviço', ['type' => 'submit', 'class' => 'btn btn-success btn-lg float-right']) !!}

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
    </style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

    @if(Session::has('message'))

    
        toastr.options = {
            toastClass: 'font-grow',
        }
  

      var type = "{{ Session::get('alert-type', 'info') }}";

      switch(type)
        {

          case 'info':
              toastr.info("{{ Session::get('message') }}");
              break;
          
          case 'warning':
              toastr.warning("{{ Session::get('message') }}");
              break;
  
          case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
  
          case 'error':
              toastr.error("{{ Session::get('message') }}");
              break;

        }

    @endif

</script>
@stop