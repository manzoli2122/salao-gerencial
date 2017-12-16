<?php

namespace Manzoli2122\Salaos\Gerencial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atendimento extends Model
{
    use SoftDeletes;
    
    protected $table = 'atendimentos';
    
    
    protected $fillable = [
        'cliente_id', 'valor', 'arquivado' , 
    ];


    public function cliente()
    {
        return $this->belongsTo('App\Core\User', 'cliente_id');
    }


    public function servicos()
    {        
        return $this->hasMany('App\Modules\Gerencial\Models\AtendimentoFuncionario', 'atendimento_id');
    }


    public function pagamentos()
    {        
        return $this->hasMany('App\Modules\Gerencial\Models\Pagamento', 'atendimento_id');
    }



    public function produtos()
    {        
        return $this->hasMany('App\Modules\Gerencial\Models\ProdutosVendidos', 'atendimento_id');
    }




    public function valorServicos(){
        $valor = 0.0;
        foreach($this->servicos as $servico){
            $valor = $valor + $servico->servico->valor - $servico->desconto;
        }
        return  $valor;       
    }


    public function valorPagamentos(){
        $valor = 0.0;
        foreach($this->pagamentos as $pagamento){
            $valor = $valor + $pagamento->valor;
        }
        return  $valor;       
    }


    public function valorProdutos(){
        $valor = 0.0;        
        foreach($this->produtos as $produto){
            $valor =  $valor + $produto->valor ;
        }
        return  $valor;
    }



    public function atualizarValor(){
        $this->valor = $this->valorProdutos() + $this->valorServicos() ;  
        if( ( $this->valor - $this->valorPagamentos() ) < 0.09 ){
            $this->arquivado = true;
        }
        else{
            $this->arquivado = false;
        }        
        $this->save();
    }






    
    public function getDatatable()
    {
        return $this->select(['id', 'cliente_id',  DB::raw( " created_at as created_at " ) ,   DB::raw("concat( 'R$' , round( valor, 2 )) as valor")   ]);        
    }
    
    public function getDatatableApagados()
    {
        return $this->onlyTrashed()->select(['id', 'cliente_id',   DB::raw( " created_at as created_at " ) , DB::raw("concat( 'R$' , round( valor, 2 )) as valor") ]);        
    }
   





}
