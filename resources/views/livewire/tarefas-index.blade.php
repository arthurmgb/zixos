<div>
    <div class="card">
        <div class="card-header">
            <div class="input-group my-1">
                <input wire:model="tarefa" @if ($acao == "store") wire:keydown.enter="store" @else wire:keydown.enter="update" @endif type="text" class="form-control form-control-lg task-input" placeholder="Digite sua tarefa..." autocomplete="off">
                <div class="input-group-append">
                @if ($acao == "store")

                  <button wire:click="store" wire:loading.attr="disabled" class="btn btn-lg btn-outline-success" type="button">Adicionar</button>

                  @else

                  <button wire:click="update" wire:loading.attr="disabled" class="btn btn-lg btn-outline-primary" type="button">Editar</button>

                  <button wire:click="cancela" wire:loading.attr="disabled" class="btn btn-lg btn-outline-secondary" type="button">Cancelar</button>

                  @endif

                </div>
            </div>
        </div>
        <div class="card-body py-2">
            @if ($tarefas->count())

            <table class="table">
                <tbody>

                @foreach ($tarefas as $tarefa)
        
                    <!-- Tarefa -->
                    <tr class="task">
                        <td style="border: none;" width="5px">
                            <input wire:click="check({{$tarefa}})" type="checkbox" id="cb{{$tarefa->id}}" @if ($tarefa->checked == 1) checked @endif>
                            <label for="cb{{$tarefa->id}}"></label>
                        </td>
                        <td style="border: none;">
                            <h5 class="ml-4 mt-2 @if($tarefa->checked == 1) text-muted cortado @endif">{{$tarefa->nome}}</h5>
                        </td>
                        <td style="border: none;" width="50px">
                            <div style="user-select: none;">
                                <div class="d-flex d-inline-flex">
                                    <button wire:click="edit({{$tarefa}})" wire:loading.attr="disabled" class="btn btn-primary mt-1 mr-2 grab" title="Editar tarefa">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:loading.attr="disabled" wire:click="destroy({{$tarefa}})" class="btn btn-danger mt-1 mr-2 grab" title="Apagar tarefa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Tarefa -->

                    @endforeach

                </tbody>
              </table>

              @else
              <div class="d-flex flex-row justify-content-center align-items-center">
                  <button style="width: 45px; height: 45px; border-radius: 30px;" wire:click="gotoPage(1)" wire:loading.attr="disabled" class="btn btn-primary mt-4">
                    <i class="fas fa-sync-alt"></i>
                  </button>
              </div>

              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(241, 242, 243, 0); display: block; shape-rendering: auto;" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="84" cy="50" r="10" fill="#3be8b0">
                    <animate attributeName="r" repeatCount="indefinite" dur="0.3846153846153846s" calcMode="spline" keyTimes="0;1" values="10;0" keySplines="0 0.5 0.5 1" begin="0s"></animate>
                    <animate attributeName="fill" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="discrete" keyTimes="0;0.25;0.5;0.75;1" values="#3be8b0;#ffb900;#6a67ce;#1aafd0;#3be8b0" begin="0s"></animate>
                </circle><circle cx="16" cy="50" r="10" fill="#3be8b0">
                    <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
                    <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
                </circle><circle cx="50" cy="50" r="10" fill="#1aafd0">
                    <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3846153846153846s"></animate>
                    <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3846153846153846s"></animate>
                </circle><circle cx="84" cy="50" r="10" fill="#6a67ce">
                    <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.7692307692307692s"></animate>
                    <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.7692307692307692s"></animate>
                </circle><circle cx="16" cy="50" r="10" fill="#ffb900">
                    <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-1.1538461538461537s"></animate>
                    <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-1.1538461538461537s"></animate>
                </circle>
                </svg>

              @endif
        </div>
        @if ($tarefas->count())
        <div class="card-footer pb-0">
            <div class="float-right p-0 m-0">
                {{$tarefas->links()}}
            </div>
        </div>
        @endif

    </div>

</div>

