<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>{{$title or 'Salão' }}</title>
		<!-- Bootstrap -->
		 <!-- Bootstrap 3.3.7 -->
  		<link rel="stylesheet" href="{{url('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  		<!-- Font Awesome -->
  		<link rel="stylesheet" href="{{url('/bower_components/font-awesome/css/font-awesome.min.css')}}">

		
		@stack('head-scripts')		
		<!--Favicon-->		
	</head>
<body>


	<div class="container-fluid">
		<div class="row">  
			<main role="main" class="col-sm-12 ml-sm-auto col-md-12 pt-3">
				
				<section class="row text-center placeholders">
					<div class="col-12 col-sm-12 placeholder">
						<h1 style="text-align:center;">Listagem dos Atendimentos </h1>
					</div>        
				</section>

				<section class="row text-center Listagens">
					<div class="col-12 col-sm-12 lista">		
						
						<table class="table table-hover table-striped table-bordered table-sm">
							<tr class="thead-dark">
								<th>Cliente</th>
								<th>Data</th>
								<th>Valor</th>
														
							</tr>
							@forelse($models as $model)				
								<tr>
									<td>{{ $model->cliente->name }}</td>						
									<td> {{$model->created_at->format('d/m/Y')}} </td>
									<td> R$ {{number_format($model->valor, 2 , ',' , '')}} </td>							
																	
								</tr>
							@empty
								<tr>						
									<td>Nenhum atendimento encontrado</td>
								</tr>
							@endforelse
						</table>			
					</div>
			
				</section>

				<section class="row text-center placeholders">
					<div class="col-12 col-sm-12 placeholder">
						<h1 style="text-align:center;">Listagem dos Serviços </h1>
					</div>        
				</section>



				


				<section class="row text-center Listagens">
					<div class="col-12 col-sm-12 lista">		
						
							
						<table class="table table-bordered table-sm">
							<tr class="thead-dark">
								<th>Serviço</th>
								<th>Cliente</th>
								<th>Funcionário</th>
								<th>Valor</th>
														
							</tr>
							@forelse($models as $atendimento)	
								
								@forelse($atendimento->servicos as $model)					
									<tr>
										<td>{{ $model->servico->nome }} </td>		
										<td>{{ $model->cliente->name }} </td>					
										<td> {{$model->funcionario->apelido}} </td>
										<td>R${{ number_format( $model->valor , 2 , ',' , '' ) }} </td>																	
									</tr>
								@empty					
								@endforelse
							@empty					
							@endforelse
						</table>
						
					</div>
					
				</section>





					
				<section class="row text-center placeholders">
					<div class="col-12 col-sm-12 placeholder">
						<h1 style="text-align:center;">Listagem dos Produtos </h1>
					</div>        
				</section>


				
				<section class="row text-center Listagens">
					<div class="col-12 col-sm-12 lista">		
						
							
						<table class="table table-bordered table-sm">
							<tr class="thead-dark">
								<th>Produto</th>
								<th>Cliente</th>
								
								<th>Valor</th>
														
							</tr>
							@forelse($models as $atendimento)	
								
								@forelse($atendimento->produtos as $model)					
									<tr>
										<td>{{ $model->produto->nome }} </td>		
										<td>{{ $model->cliente->name }} </td>					
										
										<td>R${{ number_format( $model->valor , 2 , ',' , '' ) }} </td>																	
									</tr>
								@empty					
								@endforelse
							@empty					
							@endforelse
						</table>
						
					</div>
					
				</section>


				<section class="row text-center placeholders">
					<div class="col-12 col-sm-12 placeholder">
						<h1 style="text-align:center;">Listagem dos Pagamentos </h1>
					</div>        
				</section>






				<section class="row text-center Listagens">
					<div class="col-12 col-sm-12 lista">		
						
							
						<table class="table table-bordered table-sm" style="font-size:13px;">
							<tr class="thead-dark">
								<th>Pagamento</th>
								<th>Cliente</th>
								<th>Data</th>
								<th>Operadora</th>
								<th>Bandeira</th>
								<th>Valor</th>
														
							</tr>
							@forelse($models as $atendimento)	
								
								@forelse($atendimento->pagamentos as $model)					
									<tr>
										<td>{{ $model->formaPagamento }} </td>	
										<td>{{ $model->cliente->name }} </td>						
										<td> {{$model->created_at->format('d/m/Y')}} </td>
										<td>@if(isset($model->operadora)){{$model->operadora->nome }} @endif </td>
										<td>{{ $model->bandeira }} </td>
										<td> R$ {{number_format($model->valor, 2)}} </td>																	
									</tr>
								@empty					
								@endforelse
							@empty					
							@endforelse
						</table>					
					</div>
					
				</section>



			</main>        

		</div>
	</div>

	<!-- jQuery 3 -->
	<script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{url('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	
	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
	<!-- jS Bootstrap -->
	<script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>


	@stack('scripts')


</body>
</html>