<?php

namespace Manzoli2122\Salao\Gerencial\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\Salao\Atendimento\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Models\ProdutosVendidos;

use Manzoli2122\Salao\Despesas\Models\Despesa;



class GerencialController extends Controller
{
 

    protected $pagamento;
    protected $despesa;


    public function __construct( Pagamento $pagamento , Despesa $despesa ){
        $this->middleware('auth');

        $this->pagamento = $pagamento;
        $this->despesa = $despesa;

    }  
       


    public function index()
    {

        $pagamentos = $this->pagamento->where('formaPagamento','<>', 'fiado')->sum('valor');
        $pagamentosFiados = $this->pagamento->where('formaPagamento', 'fiado')->sum('valor');
        $despesas = $this->despesa->sum('valor');

        return view("gerencial::relatorio.teste",compact('pagamentos', 'despesas','pagamentosFiados'));
    }
        
}
