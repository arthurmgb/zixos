<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarefa;
use Livewire\WithPagination;

class TarefasIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $tarefa, $tarefa_id, $situacao=[];

    public $acao = "store";

    protected $rules = [
        'tarefa' => 'required',
    ];

    public function render()
    {

        $todas = Tarefa::where('user_id', auth()->user()->id)->count();
        $pendentes = Tarefa::where('user_id', auth()->user()->id)->where('checked',0)->count();
        $concluidas = Tarefa::where('user_id', auth()->user()->id)->where('checked',1)->count();
        
        if($this->situacao){
            
            if($this->situacao == 0){

                $tarefas = Tarefa::where('user_id', auth()->user()->id)
                ->latest('id')
                ->paginate(7);

                return view('livewire.tarefas-index', compact('tarefas', 'todas', 'pendentes', 'concluidas'));

            }
            elseif($this->situacao == 1){

                $tarefas = Tarefa::where('user_id', auth()->user()->id)
                ->where('checked', 0)
                ->latest('id')
                ->paginate(7);

                $focused = 1;

                return view('livewire.tarefas-index', compact('tarefas', 'todas', 'pendentes', 'concluidas', 'focused'));

            }
            elseif($this->situacao == 2){
                
                $tarefas = Tarefa::where('user_id', auth()->user()->id)
                ->where('checked', 1)
                ->latest('id')
                ->paginate(7);

                $focused = 2;
        
                return view('livewire.tarefas-index', compact('tarefas', 'todas', 'pendentes', 'concluidas', 'focused'));

            }

        }

        else{

            $tarefas = Tarefa::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(7);

            $focused = 0;
    
            return view('livewire.tarefas-index', compact('tarefas', 'todas', 'pendentes', 'concluidas', 'focused'));

        }

    }

    public function filtrar($id){

        $this->situacao = $id;
        $this->resetPage();

    }

    public function store(){

        $this->validate();

        Tarefa::create([
            'nome' => $this->tarefa,
            'user_id' => auth()->user()->id,
        ]);

        $this->reset([
            'tarefa',
        ]);

        $this->resetPage();

        $this->dispatchBrowserEvent('tarefa-criada', ['message' => 'Tarefa criada com sucesso!']);

    }

    public function edit(Tarefa $tarefa){

        $this->tarefa = $tarefa->nome;
        $this->tarefa_id = $tarefa->id;
        $this->acao = "update";

    }

    public function update(){

        $this->validate();

        $tarefa = Tarefa::find($this->tarefa_id);

        $tarefa->update([

            'nome' => $this->tarefa,

        ]);

        $this->reset([
            'tarefa',
            'tarefa_id',
            'acao',
        ]);

        $this->dispatchBrowserEvent('tarefa-editada', ['message' => 'Tarefa editada com sucesso!']);

    }

    public function cancela(){

        $this->reset([
            'tarefa',
            'tarefa_id',
            'acao',
        ]);

    }

    public function destroy(Tarefa $tarefa){

        $tarefa->delete();

        $this->reset([
            'tarefa',
            'tarefa_id',
            'acao',
        ]);

        $this->dispatchBrowserEvent('tarefa-deletada', ['message' => 'Tarefa deletada com sucesso!']);

    }

    public function check(Tarefa $tarefa){

        $this->tarefa_id = $tarefa->id;

        $this->tarefa_checked = $tarefa->checked;

        $tarefa = Tarefa::find($this->tarefa_id);

        if($this->tarefa_checked == 0){

            $tarefa->update([
                'checked' => 1,
            ]);

        }else{

            $tarefa->update([
                'checked' => 0,
            ]);

        }

    }


}
