<?php

namespace App\Http\Controllers;

use App\Models\Ordem;
use Illuminate\Http\Request;

class OSController extends Controller
{

    public function index()
    {
        return view('painel.index');
    }

    public function create()
    {
        return view('painel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entrada' => 'required',
            'empresa' => 'required',
            'solicitacao' => 'required',
        ]);

        $request->request->add(['user_id' => auth()->user()->id]);

        Ordem::create($request->all());  

        $notification = array(
            'message' => 'Ordem de Serviço criada com sucesso!', 
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);

    }

    public function show(){
        
    }
    
    public function edit(Ordem $oss)
    {
        $this->authorize('author', $oss);
        return view('painel.edit', compact('oss'));
    }

    public function update(Request $request, Ordem $oss)
    {
        $this->authorize('author', $oss);
        
        $request->validate([
            'entrada' => 'required',
            'empresa' => 'required',
            'solicitacao' => 'required',
        ]);

        $oss->update($request->all());

        $notification = array(
            'message' => 'Ordem de Serviço atualizada com sucesso!', 
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }

}
