@extends('adminlte::page')

@section('title', 'Data e Hora')

@section('content_header')

    <div class="d-flex flex-row justify-content-between">
        <h1 class="ml-2">Data e Hora</h1>
        <a class="btn btn-primary" href="{{route('livewire')}}">
            <i class="fas fa-chevron-left mr-2"></i>Voltar para O.S.
        </a>
    </div>
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <!-- Calendário -->
                    <div class="card bg-gradient-success boxed">

                        <div class="card-header border-0">

                            @php  
                            $data_atual = Carbon\Carbon::now()->locale('pt_BR');
                            $dia_da_semana = $data_atual->isoFormat('dddd');
                            $dia_da_semana = ucwords($dia_da_semana);
                            @endphp

                            <h3 class="card-title grow-title">
                                <i class="far fa-calendar-alt mr-1"></i>
                                Calendário - {{$data_atual->isoFormat('L')}} ({{$dia_da_semana}})
                            </h3>
                        </div>

                        <div class="card-body pt-0">

                            <div id="calendar" style="width: 100%"></div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <!-- Relógio -->
                    <div class="card bg-gradient-primary boxed">

                        <div class="card-header border-0">
                            <h3 class="card-title grow-title">
                                <i class="far fa-clock mr-1"></i>
                                Relógio
                            </h3>
                        </div>

                        <div class="card-body pt-0">

                            <div class="text-center" id="relogio" style="width: 100%"></div>

                        </div>

                    </div>

                </div>

            </div>

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/painel/painel_custom.css">
    <link rel="shortcut icon" type="image/x-icon" href="/storage/painel/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"/>

    <style>

        @font-face {
        font-family: "Digital";
        src: url('{{asset('css/painel/DS-DIGI.TTF')}}');
        }

        #relogio{
            font-size: 90px;
            font-family: 'Digital';
        }
        .boxed, th, td, td span{
            cursor: grab !important;
            transition: all ease 0.2s;
            user-select: none;
        }
        .boxed:hover{
            transform: scale(1.01);
            box-shadow: 0px 20px 15px -3px rgba(0,0,0,0.25);
        }
        .boxed:active, th:active, td:active, td span:active{
            cursor: grabbing !important;
        }
        table {
            border-collapse:separate; 
            border-spacing: 0 1em;
            font-size: 20px;
        }
        .grow-title{
            padding-top: 5px;
            padding-left: 3px;
            font-size: 22px;
        }
        table .today{
            background-color: rgb(12, 110, 12) !important;
        }
        table .new, .old{
            color: rgb(112, 112, 112) !important;
        }

    </style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{asset('js/pt-br.js')}}"></script>

<script>

    //Calendário
   
    $('#calendar').datetimepicker({
        format: 'L',
        inline: true,
        locale: 'pt-br',    
    })

</script>

<script>

    const clock = document.getElementById('relogio');

    function time(){

        const now = moment();
        const human = now.format('HH:mm:ss');
        relogio.textContent = human;

    }

    setInterval(time, 1000);
    time();

</script>

@stop