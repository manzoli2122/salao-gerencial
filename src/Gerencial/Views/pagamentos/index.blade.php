@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem dos Pagamentos
@endsection

@push( Config::get('app.templateMasterCss' , 'css')  )			
	<style type="text/css">
		.btn-group-sm>.btn, .btn-sm {
			padding: 1px 10px;
			font-size: 15px;		
		} 
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 5.5px;
		}
	</style>
@endpush

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
        <div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th pesquisavel style="max-width:20px">ID</th>						
                        <th pesquisavel style="max-width:50px">Data</th>
						<th pesquisavel style="max-width:60px">Forma Pag.</th>
						<th pesquisavel>Operadora</th>
						<th pesquisavel>Bandeira</th>
						<th pesquisavel>Cliente</th>
						<th>Valor</th>			
						<th pesquisavel style="max-width:30px">V.P.O.</th>	
						<th pesquisavel style="max-width:40px">Na Conta</th>										
						<th class="align-center" style="width:100px">Ação</th>
						
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
					{ data: 'created_at', name: 'created_at' },
					{ data: 'formaPagamento', name: 'formaPagamento' , orderable: false},
					{ data: 'bandeira', name: 'bandeira' , orderable: false},
					{ data: 'nome', name: 'nome' , orderable: false},		
					{ data: 'cliente', name: 'cliente' , orderable: false},				
					{ data: 'valor', name: 'valor' , orderable: false},
					{ data: 'operado', name: 'operado' , orderable: false },	
					{ data: 'na_conta', name: 'na_conta' , orderable: false },									
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

			dataTable.on('draw', function () {
				$('[btn-confirmar-banco]').click(function (){
					confirmarOperadoraPagamentoPeloId($(this).data('id'), "@lang('msg.conf_banco_o', ['1' => 'Pagamento'])", "{{ route('pagamentos.confirmarBanco') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush							