<?php

namespace Manzoli2122\Salao\Gerencial\Http\Controllers;

use Illuminate\Http\Request;
//use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
//use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
//use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;
//use Manzoli2122\Salao\Despesas\Models\Despesa;
use Manzoli2122\Salao\Cadastro\Http\Controllers\Padroes\Controller ;
use DataTables;
use App\Constants\ErrosSQL;
//use Carbon\Carbon;

class PagamentosController extends Controller
{
    protected $model;

    protected $route = "pagamentos";

    protected $name = "Pagamento";

    protected $view = "gerencial::pagamentos";

    public function __construct( Pagamento $pagamento  ){
        $this->middleware('auth');

        $this->model = $pagamento;
        
    }  


      
    public function index()
    {
        $models = $this->model->get(); 
        return view("{$this->view}.index" , compact('models'));
    }




    public function filtrar(Request $request)
    {       
        $dataForm = $request->except('_token');
        $formaPagamento = $dataForm['formaPagamento'];   

        $operadora_confirm = $dataForm['operadora_confirm'];  


        $models = $this->model->where('formaPagamento', $formaPagamento )
                              ->where('operadora_confirm', $operadora_confirm )->get();       
        
        //$data = Carbon::createFromFormat('Y-m-d', $dataString);
              
        return view("{$this->view}.index", compact('models'));
    }



    public function confirmarOperadora($id)
    {
        try {            
            $model = $this->model->find($id);
            $model->operadora_confirm = true;
            $model->update();                   
            $msg = __('msg.sucesso_operadora_confirmada', ['1' => $this->name ]);
            
            //$msg2 =  "DELETEs - " . $this->name . ' apagado(a) com sucesso !! ' . $model . ' responsavel: ' . session('users') ;
            //Log::write( $this->logCannel , $msg2  );            
            
        } 
        catch(\Illuminate\Database\QueryException $e) 
        {
            $erro = true;
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' => $this->name , '2' => 'Model']):
                __('msg.erro_bd');
        }
        return response()->json(['erro' => isset($erro), 'msg' => $msg], 200);

    }






     /**
    * Processa a requisição AJAX do DataTable na página de listagem.
    * Mais informações em: http://datatables.yajrabox.com
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function getDatatable()
    {
        $models = $this->model->getDatatable();
        return Datatables::of($models)
            ->addColumn('action', function($linha) {
                if(!$linha->operadora_confirm  ){
                    if(($linha->formaPagamento=='debito') or ($linha->formaPagamento =='credito' ))
                    return '<button data-id="'. $linha->id . '" btn-confirmar-operadora type="button" class="btn btn-danger btn-xs" title="Confirmar Operadora"> OPERADORA <i class="fa fa-arrow-up"></i> </button> ' ;
                }
                else if( !$linha->na_conta ){
                    return '<button data-id="'. $linha->id . '" btn-confirmar-operadora type="button" class="btn btn-warning btn-xs" title="Confirmar Operadora">BANCO <i class="fa fa-arrow-up"></i> </button> ';
                }
                else{
                     return '';
                }
            })->make(true);
    }




}
