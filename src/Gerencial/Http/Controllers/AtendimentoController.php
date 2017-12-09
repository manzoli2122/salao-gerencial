<?php

namespace Manzoli2122\Salao\Gerencial\Http\Controllers;


use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;
use Illuminate\Http\Request;
use Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//use Barryvdh\DomPDF\Facade as PDF;

class AtendimentoController extends SoftDeleteController
{

    

    protected $model;
    
    protected $pagamento;
    protected $atendimentoFuncionario;
   
    protected $produtosVendidos;
    protected $name = "Atendimento";
    protected $view = "gerencial::atendimentos";
    protected $route = "gerencialAtendimentos";

    protected $log;

    public function __construct(Pagamento $pagamento , Atendimento $atendimento  ,
                                AtendimentoFuncionario $atendimentoFuncionario ,                                
                                ProdutosVendidos $produtosVendidos ){

        $this->model = $atendimento;
       
        $this->pagamento = $pagamento;
        $this->atendimentoFuncionario = $atendimentoFuncionario;
       
        $this->produtosVendidos = $produtosVendidos;
        $this->middleware('auth');


        $this->middleware('permissao:atendimentosGerencial')->only([ 'index' , 'show' , 'pesquisar' ]) ;
        
        //$this->middleware('can:atendimentos-cadastrar')->only([ 'create' , 'store']);

        //$this->middleware('can:atendimentos-editar')->only([ 'edit' , 'update']);

        $this->middleware('permissao:atendimentosGerencial-soft-delete')->only([ 'destroySoft' ]);

        $this->middleware('permissao:atendimentosGerencial-restore')->only([ 'restore' ]);
        
        $this->middleware('permissao:atendimentosGerencial-admin-permanete-delete')->only([ 'destroy' ]);

        $this->middleware('permissao:atendimentosGerencial-apagados')->only([ 'indexApagados' , 'showApagado' , 'pesquisarApagados']) ;
                               

        // create a log channel
        $this->log = new Logger('atendimento');
        $this->log->pushHandler(new StreamHandler( storage_path('logs/Atendimento.log') , Logger::WARNING));



    }
    
   

    
    public function restore($id)
    {
        $model = $this->model->withTrashed()->find($id);

        foreach( $this->atendimentoFuncionario->withTrashed()->where('atendimento_id' , $id)->get() as $servico){
            $servico->restore();
        }
        foreach($this->pagamento->withTrashed()->where('atendimento_id' , $id)->get() as $pagamento){
            $pagamento->restore();
        }
        foreach($this->produtosVendidos->withTrashed()->where('atendimento_id' , $id)->get() as $produto){
            $produto->restore();
        }

        $restore = $model->restore();
        if($restore){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }


    



    public function destroySoft($id)
    {
        $model = $this->model->find($id);

        
        foreach($model->servicos as $servico){
            $servico->delete();
        }
        foreach($model->pagamentos as $pagamento){
            $pagamento->delete();
        }
        foreach($model->produtos as $produto){
            $produto->delete();
        }

        $delete = $model->delete();
        if($delete){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.showApagados",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }




    public function pesquisarPorData(Request $request)
    {        
        $dataForm = $request->except('_token');
        $models = $this->model->whereDate('created_at', $dataForm['key'])->get();        
        $data['models'] = $models;        

       // return PDF::loadView("gerencial::relatorio.index", $data)->stream();
        return view("gerencial::relatorio.index", compact('models', 'dataForm'));
    }




}
