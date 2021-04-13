@extends('adminlte::page')

@section('title', 'Ordens de Serviço')

@section('content_header')
    @php  
        $data_atual = Carbon\Carbon::now()->locale('pt_BR');
        $dia_da_semana = $data_atual->isoFormat('dddd');
        $dia_da_semana = ucwords($dia_da_semana);
    @endphp
    <h1 class="ml-2">Ordens de Serviço - {{$data_atual->isoFormat('LL')}} ({{$dia_da_semana}})</h1>
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

<script>
    $(document).ready(function(){
        toastr.options = {
            toastClass: 'font-grow',
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