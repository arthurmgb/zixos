<?php

namespace App\Http\Livewire;

use App\Models\Ordem;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class OssRelatorios extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = [];

    public $idOrdem;

    public $ordemRemove = null;

    public function render()
    {
        
        if($this->search){

            if(isset($this->search['situacao'])){

                if(isset($this->search['final'])){
                    $final = $this->search['final'];
                }else{
                    $this->search['final'] = Carbon::today()->toDateString();
                    $final = $this->search['final'];
                }

                $final = $final . " 23:59:59";
                $inicial = $this->search['inicial'] . " 00:00:00";
                
                $situacao = $this->search['situacao']; 

                if($situacao == 2){
                    //ENCONTRADAS POR PÁGINA
                    $oss = Ordem::where('user_id', auth()->user()->id)
                    ->whereBetween('created_at', [$inicial, $final])
                    ->latest('id')
                    ->paginate(10); 
                    $qtd_os = count($oss);

                    //TOTAL ENCONTRADAS
                    $resultado = Ordem::where('user_id', auth()->user()->id)
                    ->whereBetween('created_at', [$inicial, $final])
                    ->get();
                    $os_encontradas = count($resultado);

                    return view('livewire.oss-relatorios', compact('oss', 'qtd_os', 'os_encontradas'))
                    ->layout('painel.relatorios');

                }else{
                    //ENCONTRADAS POR PÁGINA
                    $oss = Ordem::where('user_id', auth()->user()->id)
                    ->where('fechada', $situacao)
                    ->whereBetween('created_at', [$inicial, $final])
                    ->latest('id')
                    ->paginate(10); 
                    $qtd_os = count($oss);

                    //TOTAL ENCONTRADAS
                    $resultado = Ordem::where('user_id', auth()->user()->id)
                    ->where('fechada', $situacao)
                    ->whereBetween('created_at', [$inicial, $final])
                    ->get();
                    $os_encontradas = count($resultado);

                    return view('livewire.oss-relatorios', compact('oss', 'qtd_os', 'os_encontradas'))
                    ->layout('painel.relatorios');
                }

            }
     
            else{
                
                $this->search['situacao'] = '1';

                if(isset($this->search['final'])){
                    $final = $this->search['final'];
                }else{
                    $this->search['final'] = Carbon::today()->toDateString();
                    $final = $this->search['final'];
                }

                $final = $final . " 23:59:59";
                $inicial = $this->search['inicial'] . " 00:00:00";
                
                $situacao = $this->search['situacao'];

                //ENCONTRADAS POR PÁGINA
                $oss = Ordem::where('user_id', auth()->user()->id)
                ->where('fechada', $situacao)
                ->whereBetween('created_at', [$inicial, $final])
                ->latest('id')
                ->paginate(10); 
                $qtd_os = count($oss);

                //TOTAL ENCONTRADAS
                $resultado = Ordem::where('user_id', auth()->user()->id)
                ->where('fechada', $situacao)
                ->whereBetween('created_at', [$inicial, $final])
                ->get();
                $os_encontradas = count($resultado);

                return view('livewire.oss-relatorios', compact('oss', 'qtd_os', 'os_encontradas'))
                ->layout('painel.relatorios');
                
            }
            
        }
        else{
            
            return view('livewire.oss-relatorios')
                    ->layout('painel.relatorios');
        }
       
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
        
        if(is_null($os->saida)){
            $this->dispatchBrowserEvent('cancel-toggle', ['message' => 'Não é possível fechar uma O.S. sem marcar a saída.']);
        }
        elseif(is_null($os->solucao)){
            $this->dispatchBrowserEvent('cancel-toggle', ['message' => 'O cadastro de serviço executado é obrigatório.']);
        }
        else{

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

    }

    public function marca_saida(Ordem $os){

        $this->ordem = $os->id;
        
        $os = Ordem::find($this->ordem);

        $os->update([
            'saida'=> Carbon::now()->locale('pt_BR'),
        ]);

    }
}
