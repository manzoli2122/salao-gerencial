@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Relátorio
@endsection


		

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">

        <div class="box-body">


            <form class="form-inline">
				<div method="post" action="{{route('relatorio-pagamentos-chart')}}" class="form-group mb-2">
				  <label for="staticEmail2" class="sr-only">Email</label>
				  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com" >
				</div>
				<div class="form-group mx-sm-3 mb-2">
				  <label for="inputPassword2" class="sr-only">Data</label>
				  <input type="date" class="form-control" id="data" placeholder="Data" required>
				</div>
				<button type="submit" class="btn btn-primary mb-2">Gerar Relatorio</button>
			  </form>	


        </div>
    </div>
</div>

@endsection

				