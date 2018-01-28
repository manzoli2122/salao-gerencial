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
						
                        <th style="max-width:120px">Data</th>
                        <th>Forma de Pagamento</th>
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
				
		window.confirmarOperadoraPagamentoPeloId = function(id, texto, url, funcSucesso = function() {}) {
			alertConfimacao(texto, '',
				function() {
					alertProcessando();
					var token = document.head.querySelector('meta[name="csrf-token"]').content;

					$.ajax({
						url: url + "/" + id,
						type: 'post',
						data: {  _token: token },
						success: function(retorno) {
							alertProcessandoHide();
							if (retorno.erro) {
								toastErro(retorno.msg);
							} else {
								toastSucesso(retorno.msg);
								funcSucesso();
							}
						},
						error: function(erro) {
							alertProcessandoHide();
							toastErro("Ocorreu um erro");
							console.log(erro);
						}
					});
				}
			);
		}
	</script>

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



							