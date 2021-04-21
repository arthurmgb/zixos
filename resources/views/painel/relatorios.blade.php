@extends('adminlte::page')

@section('title', 'Relatórios')

@section('content_header')

    <div class="d-flex flex-row justify-content-between">
        <h1 class="ml-2">Relatórios - Filtrar Ordens de Serviço</h1>
        <a class="btn btn-primary" href="{{url()->previous()}}">
            <i class="fas fa-chevron-left mr-2"></i>Voltar
        </a>
    </div>

@stop

@section('content')
  @livewire('oss-relatorios')
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
        .evento-pointer{
            pointer-events: none;
        }
        .pointer{
            cursor: pointer;
        }
    </style>
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Copiar -->
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script src="{{asset('js/copy.js')}}"></script>
<!-- /Copiar -->

<script>
    $(document).ready(function(){
        toastr.options = {
            toastClass: 'font-grow',
            "progressBar": true,
        }
    });
</script>

<script>

    window.addEventListener('show-modal', event => {
        $('#mostraOS').modal('show');
    })

    window.addEventListener('show-delete-modal', event => {
        $('#confirmDelete').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmDelete').modal('hide');
        toastr.success(event.detail.message);
    })

    window.addEventListener('cancel-toggle', event => {
        toastr.error(event.detail.message);
    })

</script>

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