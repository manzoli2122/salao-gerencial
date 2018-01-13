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
    protected $pagamento;

    protected $route = "pagamentos";

    protected $view = "gerencial::pagamentos";

    public function __construct( Pagamento $pagamento  ){
        $this->middleware('auth');

        $this->pagamento = $pagamento;
        
    }  


      
    public function index()
    {
        return view("{$this->view}.index");
    }

}
