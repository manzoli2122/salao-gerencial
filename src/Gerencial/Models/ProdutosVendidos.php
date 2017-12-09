<?php

namespace Manzoli2122\Salao\Gerencial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosVendidos extends Model
{
    protected $table = 'atendimentos_produtos';
    
    use SoftDeletes ;


    protected $fillable = [
        'quantidade', 'cliente_id', 'valor' , 'atendimento_id' , 'produto_id'
    ];
    


    
    public function cliente()
    {
        return $this->belongsTo('App\Core\User', 'cliente_id');
    }

    public function atendimento()
    {
        return $this->belongsTo('Manzoli2122\Salao\Gerencial\Models\Atendimento', 'atendimento_id');
    }

    public function produto()
    {
        return $this->belongsTo('Manzoli2122\Salao\Cadastro\Models\Produto', 'produto_id');
    }



}
