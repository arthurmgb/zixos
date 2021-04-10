<?php

namespace App\Http\Livewire;

use App\Models\Ordem;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class OssIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public $idOrdem;

    public $ordemRemove = null;
    
    public function updatingSearch(){

        $this->resetPage();

    }

    public function render()
    {
       
        $oss = Ordem::where('user_id', auth()->user()->id)
        ->where('empresa', 'LIKE', '%' . $this->search .'%')
        ->whereDate('created_at', Carbon::today()->locale('pt_BR'))
        ->latest('id')
        ->paginate(7);

        $oss_abertas = Ordem::where('user_id', auth()->user()->id)
        ->where('fechada', 0)
        ->whereDate('created_at', Carbon::today()->locale('pt_BR'))->get();

        $qtd_abertas = count($oss_abertas);

        return view('livewire.oss-index', compact('oss', 'qtd_abertas'))
                                ->layout('painel.index');
        
    }

    public function mostra_os(Ordem $os){
        

        $this->idOrdem = $os->id;

        $this->dispatchBrowserEvent('show-modal');

        
    }

    public function remove_os($os){
        
        $this->ordemRemove = $os;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleta_os(){

        $ordem = Ordem::find($this->ordemRemove);

        $ordem->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Ordem de Serviço deletada com sucesso!']);
    }

    public function toggle(Ordem $os){
        
        $this->ordem = $os->id;
        $this->status = $os->fechada;

        $os = Ordem::find($this->ordem);

        if($this->status == 0){
            $os->update([
                'fechada'=> '1',
            ]);
        }else{
            $os->update([
                'fechada'=> '0',
            ]);
        }

    }

    public function marca_saida(Ordem $os){

        $this->ordem = $os->id;
        
        $os = Ordem::find($this->ordem);

        $os->update([
            'saida'=> Carbon::now()->locale('pt_BR'),
        ]);

    }

}
