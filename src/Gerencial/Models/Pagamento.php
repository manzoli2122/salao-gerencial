<?php

namespace Manzoli2122\Salao\Gerencial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use SoftDeletes;

    protected $table = 'pagamentos';
    
    
    protected $fillable = [
        'valor',  'atendimento_id' , 'compensado' , 'parcelas' , 'operadora_confirm', 'na_conta_at' , 'operadora_id' ,
         'porcentagem_cartao' , 'operadora_id', 'formaPagamento' , 'caiu_conta' , 'valor_liquido' , 'bandeira' ,
    ];




    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Gerencial\Models\Atendimento', 'atendimento_id');
    }



    public function operadora()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\Operadora', 'operadora_id');
    }

    
    public function cliente()
    {
        return $this->belongsTo('Manzoli2122\Salao\Atendimento\Models\Cliente', 'cliente_id');
    }



}
