
@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem dos Atendimentos Apagados
@endsection



@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )	
		<li><a href="{{  route('gerencialAtendimentos.index')}}"><i class="fa fa-circle-o text-green"></i> <span>Atendimentos Ativos</span></a></li>
@endsection


		

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
		<div class="box-header align-right">			
				{!! Form::open(['route' => 'gerencialAtendimentos.pesquisarPorData' ]) !!}
								<div class="input-group input-group-sm" style="width: 250px; margin-left:auto;">
									{!! Form::date('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar', 'required']) !!}
									<div class="input-group-btn">
										<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit" >
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>	
									</div>
								</div>									
							{!!  Form::close()  !!}		           
        	</div>
			
        <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th pesquisavel style="max-width:30px">ID</th>
						<th pesquisavel >Cliente</th>
						
						<th pesquisavel style="max-width:120px">Data</th>
						<th>Valor</th>		
						
                        <th class="align-center" style="width:100px">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection


@push(Config::get('app.templateMasterScript' , 'script') )
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 2, "desc" ]],
				ajax: { 
					url:'{{ route('gerencialAtendimentos.getDatatable.apagados') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'cliente', name: 'cliente' },
					
					{ data: 'created_at', name: 'created_at' },
					{ data: 'valor', name: 'valor' },
				
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'Atendimentos'])", "{{ route('gerencialAtendimentos.index') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush



						