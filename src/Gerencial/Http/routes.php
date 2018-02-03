<?php

use Illuminate\Support\Facades\Route;



    Route::group(['prefix' => 'gerencial', 'middleware' => 'auth' ], function(){
    
        Route::get('relatorio/geral', 'GerencialController@home')->name('gerencial.relatorio.geral');
        

        Route::get('relatorio', 'GerencialController@index')->name('gerencial.relatorio.index');
        
        Route::post('relatorio/pagamentos', 'GerencialController@pagamentos')->name('relatorio-pagamentos-chart');
        Route::post('relatorio/atendimentos', 'GerencialController@atendimentos')->name('relatorio-atendimentos-chart');

        Route::post('atendimentos/pesquisarPorData', 'AtendimentoController@pesquisarPorData')->name('gerencialAtendimentos.pesquisarPorData');
        









        Route::get('atendimentos/apagados/{id}', 'AtendimentoController@showApagado')->name('gerencialAtendimentos.showapagado');        
        Route::get('atendimentos/apagados', 'AtendimentoController@indexApagados')->name('gerencialAtendimentos.apagados');
        Route::delete('atendimentos/apagados/{id}', 'AtendimentoController@destroySoft')->name('gerencialAtendimentos.destroySoft');
        Route::post('atendimentos/getDatatable/apagados', 'AtendimentoController@getDatatableApagados')->name('gerencialAtendimentos.getDatatable.apagados');        
        Route::post('atendimentos/getDatatable', 'AtendimentoController@getDatatable')->name('gerencialAtendimentos.getDatatable');               
        Route::get('atendimentos/restore/{id}', 'AtendimentoController@restore')->name('gerencialAtendimentos.restore');
        Route::resource('gerencialAtendimentos', 'AtendimentoController' , ['except' => [
            'create', 'store' , 'edit' , 'update' , 
        ]] ); 








        Route::post('pagamentos/getDatatable', 'PagamentosController@getDatatable')->name('pagamentos.getDatatable');               
        
        Route::get('pagamentos', 'PagamentosController@index')->name('pagamentos.index');  
        
        

        Route::post('pagamentos/filtro', 'PagamentosController@filtrar')->name('pagamentos.filtrar');
        Route::post('pagamentos/confirma-operadora/{id}', 'PagamentosController@confirmarOperadora')->name('pagamentos.confirmarOperadora.id');
        Route::post('pagamentos/confirma-operadora', 'PagamentosController@confirmarOperadora')->name('pagamentos.confirmarOperadora');

        Route::post('pagamentos/confirma-banco/{id}', 'PagamentosController@confirmarBanco')->name('pagamentos.confirmarBanco.id');
        Route::post('pagamentos/confirma-banco', 'PagamentosController@confirmarBanco')->name('pagamentos.confirmarBanco');

    
    });