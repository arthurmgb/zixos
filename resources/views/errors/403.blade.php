@extends('errors::minimal')

@section('title', __('Não autorizado'))
@section('code', '403')
@section('message', __('Esta O.S. pertence à outro usuário'))
