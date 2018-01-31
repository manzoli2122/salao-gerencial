@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem dos Pagamentos
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
        <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th pesquisavel style="max-width:30px">ID</th>						
                        <th pesquisavel style="max-width:120px">Data</th>
                        <th pesquisavel>Forma de Pagamento</th>
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
				order: [[ 0, "desc" ]],
				ajax: { 
					url:'{{ route('pagamentos.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'created_atd', name: 'created_atd' },
					{ data: 'formaPagamento', name: 'formaPagamento' },					
					{ data: 'valor', name: 'valor' },				
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-confirmar-operadora]').click(function (){
					confirmarOperadoraPagamentoPeloId($(this).data('id'), "@lang('msg.conf_operadora_o', ['1' => 'Pagamento'])", "{{ route('pagamentos.confirmarOperadora') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush							