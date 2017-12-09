<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>{{$title or 'Salão' }}</title>
		
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
						<h5 style="text-align:center;">Relatorio Geral </h5>
					</div>        
				</section>

				<section class="row text-center Listagens">
					
                    <div class="col-12 col-sm-12 lista">						
						<p>Receita Bruta</p>		
					</div>
                    <div class="col-12 col-sm-12 lista">						
						<p>R$ {{number_format($pagamentos, 2,',','')}}</p>		<br>
					</div>

                    <div class="col-12 col-sm-12 lista">						
						<p>Despesas</p>		
					</div>
                    <div class="col-12 col-sm-12 lista">						
						<p>R$ {{ number_format($despesas, 2,',','')}}</p>	<br>	
					</div>

                    <div class="col-12 col-sm-12 lista">						
						<p>Liquido (não descontados as taxas dos cartões)</p>		
					</div>
                    <div class="col-12 col-sm-12 lista">						
						<p>R$ {{number_format($pagamentos - $despesas, 2,',','')}}</p>	<br><br>	
					</div>
			
					
					<div class="col-12 col-sm-12 lista" style="color:red;">						
						<p>Fiados à Receber</p>		
					</div>
                    <div class="col-12 col-sm-12 lista">						
						<p>R$ {{number_format($pagamentosFiados, 2,',','')}}</p>		
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