@extends( Config::get('app.templateMaster' , 'templates.templateMaster') ) 

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page') ) 
Pagamentos 
@endsection @section( Config::get('app.templateMasterContent' , 'content') )

<div class="col-xs-12">
	<div class="box box-success">

		<div class="box-body">


			


			<form method="post" action="{{route('pagamentos.filtrar')}}" class="form-inline">
				{{csrf_field()}}
				
                

                <div class="form-group mx-sm-3 mb-2">                    
                    <select class="form-control" name="formaPagamento" required >
                            <option value="">Selecione a forma de pagamento</option>                               
                            <option value="dinheiro"> Dinheiro  </option>
                            <option value="Pic Pay"> Pic Pay  </option>
                            <option value="Transferência Bancária"> Transferência Bancária  </option>
                            <option value="credito"> Credito  </option>
                            <option value="debito"> Debito  </option>
                            <option value="cheque"> Cheque  </option>    
                            <option value="fiado"> Fiado  </option>                           
                    </select> 
                </div>

                <div class="form-group mx-sm-3 mb-2">                    
                        <select class="form-control" name="operadora_confirm" required>
                                <option value="">Verificado a operadora? </option>                               
                                <option value="1"> Sim  </option>
                                <option value="0"> Não  </option>                                                           
                        </select> 
                </div>

				
				<div class="form-group mx-sm-3 mb-2">
					<label for="data" class="sr-only">Data</label>
					<input name="data" type="date" class="form-control" id="data" placeholder="Data" >
				</div>
				<button type="submit" class="btn btn-primary mb-2">Filtrar</button>
			</form>






			
            

            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						
						<th>CLIENTE</th>
						<th style="max-width:120px">Data</th>
						<th>Valor</th>		
						
                        <th class="align-center" style="width:100px">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($models as $model)
                        <tr>
                            
                            <td>{{$model->cliente->name }}</td>

                            <td>{{ $model->created_at->format('d/m/Y') }}</td>
                            <td>{{$model->valor}}</td>
                            <td> {{$model->getValor()}} </td>
                            
                        </tr>
                    @empty
                       
                    @endforelse
                    
                </tbody>


                        
            </table>





		</div>
	</div>
</div>

@endsection