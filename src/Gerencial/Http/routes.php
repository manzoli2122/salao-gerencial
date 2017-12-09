<?php

use Illuminate\Support\Facades\Route;



    Route::group(['prefix' => 'gerencial', 'middleware' => 'auth' ], function(){
    
        Route::get('relatorio/geral', 'GerencialController@index')->name('gerencial.relatorio.geral');
        
        

        Route::post('atendimentos/pesquisarPorData', 'AtendimentoController@pesquisarPorData')->name('gerencialAtendimentos.pesquisarPorData');
        
        Route::get('atendimentos/apagados/{id}', 'AtendimentoController@showApagado')->name('gerencialAtendimentos.showapagado');        
        Route::get('atendimentos/apagados', 'AtendimentoController@indexApagados')->name('gerencialAtendimentos.apagados');
        Route::post('atendimentos/pesquisarApagados', 'AtendimentoController@pesquisarApagados')->name('gerencialAtendimentos.pesquisarApagados');
        Route::post('atendimentos/pesquisar', 'AtendimentoController@pesquisar')->name('gerencialAtendimentos.pesquisar');
        Route::delete('atendimentos/destroySoft/{id}', 'AtendimentoController@destroySoft')->name('gerencialAtendimentos.destroySoft');
        Route::get('atendimentos/restore/{id}', 'AtendimentoController@restore')->name('gerencialAtendimentos.restore');
        Route::resource('gerencialAtendimentos', 'AtendimentoController' , ['except' => [
            'create', 'store' , 'edit' , 'update' , 
        ]] ); 




    
    });