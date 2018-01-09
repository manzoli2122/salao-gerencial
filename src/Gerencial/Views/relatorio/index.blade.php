@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Relátorio
@endsection


		

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">

        <div class="box-body">


            <form method="post" action="{{route('relatorio-pagamentos-chart')}}" class="form-inline">
				{{csrf_field()}}
				<div class="form-group mx-sm-3 mb-2">
						<label for="dia" class="sr-only">Dias</label>
						<input name="dia" type="number" class="form-control" id="dia" placeholder="Dia" required>
				</div>
				<div class="form-group mx-sm-3 mb-2">
				  <label for="data" class="sr-only">Data</label>
				  <input name="data" type="date" class="form-control" id="data" placeholder="Data" required>
				</div>
				<button type="submit" class="btn btn-primary mb-2">Gerar Relatorio</button>
			  </form>	


        </div>
    </div>
</div>

@endsection

				