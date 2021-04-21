@extends('adminlte::page')

@section('title', 'Ordens de Serviço')

@section('content_header')
    @php  
        $data_atual = Carbon\Carbon::now()->locale('pt_BR');
        $dia_da_semana = $data_atual->isoFormat('dddd');
        $dia_da_semana = ucwords($dia_da_semana);
    @endphp
    <div class="d-flex flex-row">
        <h1 class="ml-2">Ordens de Serviço - {{$data_atual->isoFormat('LL')}} ({{$dia_da_semana}})</h1>
        <a title="Ver data e hora" class="btn btn-link pl-1 pt-1" href="{{route('datetime')}}"><i class="fas fa-external-link-alt"></i></a>
    </div>
@stop

@section('content')
    @livewire('oss-index')
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