<?php

namespace Manzoli2122\Salao\Gerencial\Http\Controllers;

use Illuminate\Http\Request;
//use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
//use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
//use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;
//use Manzoli2122\Salao\Despesas\Models\Despesa;
use Manzoli2122\Salao\Cadastro\Http\Controllers\Padroes\Controller ;

//use Carbon\Carbon;

class PagamentosController extends Controller
{
    protected $model;

    protected $route = "pagamentos";

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
        
        $models = $this->model->whereDate('formaPagamento', $formaPagamento )->get();       
        
        //$data = Carbon::createFromFormat('Y-m-d', $dataString);
              
        return view("{$this->view}.index", compact('models'));
    }





}
