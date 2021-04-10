@extends('adminlte::page')

@section('title', 'Minhas Tarefas')

@section('content_header')

    <div class="d-flex flex-row justify-content-between">
        <h1 class="ml-2">Minhas Tarefas</h1>
        <a class="btn btn-primary" href="{{route('livewire')}}">
            <i class="fas fa-chevron-left mr-2"></i>Voltar para O.S.
        </a>
    </div>
    
@stop


@section('content')
    @livewire('tarefas-index')
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
        .task-input{
            background-color: #F9FAFB;
        }
        .task-input::placeholder{
            letter-spacing: 2px;
        }
        .task-input:focus{
            border: 1px solid #CED4DA;
            border-right: 1px solid transparent;
        }
        .task{
            border-radius: 10px !important;
            box-shadow: 4px 4px 15px -10px rgba(0,0,0,0.7);
            transition: all ease 0.2s;
        }
        .task:hover{
            transform: scale(1.01);
            box-shadow: 8px 8px 30px -20px rgba(0,0,0,0.7);
        }
        .grab{
            width: 40px;
            height: 40px;
            border-radius: 60px;
        }
        table {
            border-collapse: separate; 
            border-spacing: 0 1em;
        }
        .cortado{
            text-decoration: line-through;
        }

        /*Checkboxes styles*/
        input[type="checkbox"] { display: none; }

        input[type="checkbox"] + label {
        display: block;
        position: relative;
        margin-bottom: 20px;
        margin-top: 4px;
        margin-left: 5px; 
        font: 14px/20px 'Open Sans', Arial, sans-serif;
        color: #ddd;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        }
        input[type="checkbox"] + label:active {}

        input[type="checkbox"] + label:last-child { margin-bottom: 0; }

        input[type="checkbox"] + label:before {
        content: '';
        display: block;
        width: 30px;
        height: 30px;
        border: 2px solid #10B981;
        position: absolute;
        left: 0;
        top: 0;
        opacity: .6;
        -webkit-transition: all .12s, border-color .08s;
        transition: all .12s, border-color .08s;
        }

        input[type="checkbox"]:checked + label:before {
        width: 10px;
        top: -5px;
        left: 5px;
        border-radius: 0;
        opacity: 1;
        border-top-color: transparent;
        border-left-color: transparent;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        margin-bottom: 20px;
        margin-top: 4px;
        margin-left: 6px;
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

    window.addEventListener('tarefa-criada', event => {
        toastr.success(event.detail.message);
    })

    window.addEventListener('tarefa-editada', event => {
        toastr.success(event.detail.message);
    })
    
    window.addEventListener('tarefa-deletada', event => {
        toastr.success(event.detail.message);
    })

</script>

@stop