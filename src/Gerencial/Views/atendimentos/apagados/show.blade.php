@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )
    
@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
		Cliente : <b> {{ $model->cliente->name}}
@endsection

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
    
    
    <section class="text-center atendimentos"> 

        <div class="col-12 col-sm-4 servicos" style="margin-bottom:10px;">
           <h3>Serviços</h3>
            @forelse($model->servicos as $servico) 
                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                @if($servico->deleted_at)
                                    <h3 class="box-title" style="color: red">{{$servico->servico->nome}}  </h3>
                                @else
                                    <h3 class="box-title">{{$servico->servico->nome}}  </h3>
                                @endif
                                                                                                                        
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg">
                                        
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left">Funcionário: {{$servico->funcionario->apelido}} </span>
                                            <span class="pull-right badge bg-green"> Total R${{ number_format($servico->valor , 2 ,',', '')}} </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>
			@empty			
			@endforelse             
        </div>
        
        <div class="col-12 col-sm-4 produtos" style="margin-bottom:0px;">
            <h3>Produtos</h3>
            @forelse($model->produtos as $produto)

                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">

                                @if($produto->deleted_at)
                                    <h3 class="box-title" style="color: red">{{$produto->produto->nome}} </h3>
                                @else
                                    <h3 class="box-title">{{$produto->produto->nome}}  </h3>
                                @endif
                               
                                                          
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg">
                                        
                                        <div class="direct-chat-info clearfix">                               
                                            <span class="pull-left"> quant.: {{$produto->quantidade}} </span>
                                            <span class="pull-right badge bg-blue"> Total R${{ number_format($produto->valor , 2 ,',', '')}} </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>
               
			@empty
			
			@endforelse  
            <hr style="margin-top:15px;">
        </div>

        
        <div class="col-12 col-sm-4 pagamentos">            
            <h3>Pagamentos</h3>
            @forelse($model->pagamentos as $pagamento)
                <div class="row">        
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                @if($pagamento->deleted_at)
                                    <h3 class="box-title" style="color: red">{{$pagamento->formaPagamento}} </h3>
                                @else
                                    <h3 class="box-title">{{$pagamento->formaPagamento}}  </h3>
                                @endif
                                <h3 class="box-title"></h3>                                                          
                            </div>                        
                            <div class="box-body">                               
                                    <div class="direct-chat-msg"> 
                                        @if($pagamento->formaPagamento == 'credito' or $pagamento->formaPagamento == 'debito')                                       
                                            <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left"> @if(isset($pagamento->operadora)) {{ $pagamento->operadora->nome }} @endif </span>
                                                <span class="pull-right"> {{ $pagamento->bandeira }}  </span>
                                            </div>
                                            <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left">  {{ $pagamento->parcelas }}X </span>
                                                <span class="pull-right badge bg-orange"> Valor R${{ number_format($pagamento->valor , 2 ,',', '') }} </span>
                                            </div>
                                        @else
                                             <div class="direct-chat-info clearfix">                               
                                                <span class="pull-left">  </span>
                                                <span class="pull-right badge bg-orange"> Valor R${{ number_format($pagamento->valor , 2 ,',', '') }} </span>
                                            </div>
                                        @endif
                                       
                                    </div>
                            </div>
                        </div>
                    </div>                    
                </div>                     	
            @empty			
			@endforelse 

          

            <hr style="margin-top:15px;"> 
             <h3 style="text-align:right;">Total R$ {{number_format($model->valor, 2 ,',', '') }} </h3>
        </div>      

    </section>
@endsection