<div>
    <div class="card">
        <div class="card-header">
            <a accesskey="s" data-toggle="tooltip" data-placement="top" title="Alt + S" class="btn btn-success btn-lg float-right mb-2" href="{{route('oss.create')}}"><i class="fas fa-plus-circle mr-2"></i>Incluir O.S.</a>
            <input style="letter-spacing: 1px;" wire:model="search" autocomplete="off" class="form-control" placeholder="Pesquisar por empresa...">
        </div>
        <div class="card-body">
            @if ($oss->count() == 0)
            <div class="alert alert-light mb-0" role="alert">
                Nenhum registro encontrado.
            </div>
            @else
            <div class="d-flex flex-row align-items-center mb-2">
                
                <h5 class="mb-0 align-self-end mr-1">
    
                    @if ($qtd_cad)
                    <span class="badge badge-dark m-0 p-2">
                        <i class="fas fa-file-alt mr-1"></i> O.S. cadastradas: {{$qtd_cad}}
                    </span>
                    @endif
                
                </h5>

                <h5 class="mb-0 align-self-end">
    
                    @if ($qtd_abertas != 0 and $qtd_abertas != 1)
                    <span class="badge badge-warning m-0 p-2">
                        <i class="fas fa-bell mr-1"></i> {{$qtd_abertas}} Ordens de Serviço abertas
                    </span>
                    @elseif ($qtd_abertas == 1)
                    <span class="badge badge-primary m-0 p-2">
                        <i class="fas fa-bell mr-1"></i> {{$qtd_abertas}} Ordem de Serviço aberta
                    </span>
                    @else
                    @endif
                
                </h5>
                <a class="btn btn-primary align-self-end ml-auto" href="{{route('livewire')}}">
                    <i class="fas fa-clipboard-list mr-2"></i>Dia atual
                </a>
            </div>

                <table class="table table-striped table-responsive-sm text-center border-top">
                    <thead>
                        <tr>
                            <th>Entrada</th>
                            <th>Empresa</th>
                            <th>Solicitante</th>
                            <th>Solicitação</th>
                            <th>Saída</th>
                            <th style="user-select: none;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($oss as $os)
                        
                        @if ($os->fechada == 0)
                                <tr class="table-row">
                                    <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" class="font-weight-bold text-success pointer">{{date('H:i', strtotime($os->entrada))}}</td>
                                    <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->empresa}}</td>
                                    <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->solicitante}}</td>
                                    <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->solicitacao}}</td>
                                    <td class="font-weight-bold text-danger">@if (is_null($os->saida))  <button wire:click.prevent="marca_saida({{$os}})" wire:loading.attr="disabled" class="btn btn-sm btn-danger"><i class="fas fa-clock"></i></button> @else {{date('H:i', strtotime($os->saida))}} @endif</td>
                                    <td style="user-select: none;">

                                        <button wire:click.prevent="toggle({{$os}})" wire:loading.attr="disabled" class="btn btn-sm btn-secondary my-1"><i class="fas fa-times-circle mr-1"></i>Fechar O.S.</button>

                                        <a class="btn btn-sm btn-success my-1" href="{{route('oss.edit', $os)}}"><i class="fas fa-edit mr-1"></i>Editar</a>

                                        <button wire:click.prevent="mostra_os({{$os}})" wire:loading.attr="disabled" title="Detalhar O.S." class="btn btn-sm btn-primary my-1">
                                            <i class="fas fa-folder-open"></i>
                                        </button>

                                        <button wire:click.prevent="remove_os({{$os->id}})" wire:loading.attr="disabled" title="Deletar O.S." class="btn btn-sm btn-danger my-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </td>
                                </tr>
                        @else
                            <tr class="table-row">
                                <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" class="font-weight-bold text-success pointer">{{date('H:i', strtotime($os->entrada))}}</td>
                                <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->empresa}}</td>
                                <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->solicitante}}</td>
                                <td wire:click.prevent="mostra_os({{$os}})" wire:loading.class="evento-pointer" style="max-width: 50px;" class="text-truncate pointer">{{$os->solicitacao}}</td>
                                <td class="font-weight-bold text-danger">@if (is_null($os->saida)) <button wire:click.prevent="marca_saida({{$os}})" wire:loading.attr="disabled" class="btn btn-sm btn-danger"><i class="fas fa-clock"></i></button> @else {{date('H:i', strtotime($os->saida))}} @endif</td>
                                <td style="user-select: none;">

                                    <span title="✔️">
                                    <a aria-disabled="true" class="btn btn-sm btn-secondary my-1 disabled"><i class="fas fa-check-circle mr-1"></i></i>Fechada</a>
                                    </span>

                                    <button wire:click.prevent="toggle({{$os}})" wire:loading.attr="disabled" title="Reabrir O.S." class="btn btn-sm btn-success my-1">
                                        <i class="fas fa-undo-alt mr-1"></i>Reabrir
                                    </button>

                                    <button wire:click.prevent="mostra_os({{$os->id}})" wire:loading.attr="disabled" title="Detalhar O.S." class="btn btn-sm btn-primary my-1">
                                        <i class="fas fa-folder-open"></i>
                                    </button>

                                    <button wire:click.prevent="remove_os({{$os->id}})" wire:loading.attr="disabled" title="Deletar O.S." class="btn btn-sm btn-danger my-1">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                        @endif
                        
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer pb-0">
            <div class="float-right p-0 m-0">
                {{$oss->links()}}
            </div>
        </div>
    </div>

    <!-- MODAL MOSTRA -->

    <div class="modal fade" id="mostraOS" tabindex="-1" aria-labelledby="mostraOS" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="mostraOS"><i class="fas fa-file-alt mr-2"></i>Ordem de Serviço</h5>
            <button style="outline: none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times-circle text-white"></i>
            </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p class="h3 mb-3 text-center">Detalhes da Ordem de Serviço</p>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-body">

                           @php
                               $getOrdem = App\Models\Ordem::where('id', $idOrdem)->get();
                               $ordem = $getOrdem->toArray();
                               
                           @endphp

                           @foreach ($ordem as $item_ordem)

                            <div class="row text-center">
                                <div class="col-4">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    <label class="h5">Data de inclusão</label>
                                    <p style="color: #007BFF" class="h5 font-weight-bold mb-0">
                                        {{ $data = Carbon\Carbon::parse($item_ordem['created_at'])->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <i class="far fa-clock mr-1"></i>
                                    <label class="h5">Horário de entrada</label>
                                    <p style="color: #28A745" class="h5 font-weight-bold mb-0">
                                       {{ $entrada = Carbon\Carbon::parse($item_ordem['entrada'])->format('H:i') }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <i class="far fa-clock mr-1"></i>
                                    <label class="h5">Horário de saída</label>
                                    <p style="color: #DC3545" class="h5 font-weight-bold mb-0">

                                        @if (is_null($item_ordem['saida']))
                                        Não marcado
                                        @else
                                        {{ $saida = Carbon\Carbon::parse($item_ordem['saida'])->format('H:i') }}
                                        @endif
                                        
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-4">
                                    <i class="fas fa-building mr-1"></i>
                                    <label class="h5">Empresa</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['empresa']}}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-user-tie mr-1"></i>
                                    <label class="h5">Solicitante</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['solicitante']}}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <label class="h5">Situação</label>

                                    @if ($item_ordem['fechada'] == 0)
                                    <p style="color: #28A745" class="h5 font-weight-bold mb-0">Aberta</p>
                                    @else
                                    <p style="color: #DC3545" class="h5 font-weight-bold mb-0">Fechada</p>
                                    @endif
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <i class="fas fa-user-shield mr-1"></i>
                                    <label class="h5">ID TeamViewer</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['idtv']}}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-user-lock mr-1"></i>
                                    <label class="h5">Senha TeamViewer</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['senhatv']}}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-12">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <label class="h5">Solicitação/Problema</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['solicitacao']}}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-12">
                                    <i class="fas fa-tools mr-1"></i>
                                    <label class="h5">Serviço executado</label>
                                    <p class="h5 mb-0">
                                        {{$item_ordem['solucao']}}
                                    </p>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-color: #F7F7F7" class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- MODAL DELETE -->

    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDelete" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h5 class="modal-title" id="confirmDelete"><i class="fas fa-trash-alt mr-2"></i>Deletar Ordem de Serviço</h5>
            <button style="outline: none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times-circle text-white"></i>
            </button>
            </div>
            <div class="modal-body">
                <p class="h5 m-0 text-center py-3">Deseja realmente deletar essa <b>Ordem de Serviço</b>?</p>
            </div>
            <div style="background-color: #F7F7F7" class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Cancelar</button>
            <button wire:click.prevent="deleta_os" wire:loading.attr="disabled" type="button" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>Deletar</button>
            </div>
        </div>
        </div>
    </div>

</div>

