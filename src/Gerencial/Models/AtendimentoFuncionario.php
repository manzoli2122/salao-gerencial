<?php

namespace Manzoli2122\Salao\Gerencial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtendimentoFuncionario extends Model
{
    use SoftDeletes;

    protected $table = 'atendimento_funcionarios';
    
    
    protected $fillable = [
        'valor', 'cliente_id', 'funcionario_id' , 'atendimento_id' , 'servico_id' , 'salario_id'
    ];


    public function cliente()
    {
        return $this->belongsTo('App\Core\User', 'cliente_id');
    }


    public function funcionario()
    {
        return $this->belongsTo('App\Core\User', 'funcionario_id');
    }


    public function atendimento()
    {
        return $this->belongsTo('App\Modules\Gerencial\Models\Atendimento', 'atendimento_id');
    }


    public function servico()
    {
        return $this->belongsTo('App\Modules\Cadastro\Models\Servico', 'servico_id');
    }



    public function AtendimentosSemSalario($funcionarioId)
    {
        return $this->whereNull('salario_id')->where('funcionario_id' , $funcionarioId)->get();
    }


    public function salario()
    {
        return $this->belongsTo('App\Core\Models\Salario', 'salario_id');
    }

}
