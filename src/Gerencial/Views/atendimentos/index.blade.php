
@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )



@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Listagem dos Atendimentos  @if($apagados) Apagados @endif
		@endsection

@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )
			@if($apagados)
				@permissao('gerencialAtendimentos')
					<li><a href="{{ route('gerencialAtendimentos.index')}}"><i class="fa fa-circle-o text-blue"></i> <span>Atendimentos Ativos</span></a></li>
				@endpermissao
			@else
				
				@permissao('gerencialAtendimentos-apagados')
					<li><a href="{{  route('gerencialAtendimentos.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Atendimentos Apagados</span></a></li>
				@endpermissao
			@endif			
		@endsection


		
@push( Config::get('app.templateMasterScript' , 'script')  )
        	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
        @endsection

		
		@section('css')				
			<style type="text/css">
					.btn-sm{
						padding: 1px 10px;
					}
					.pagination{
						margin:0px;
						display: unset;
						font-size:12px;
					}
			</style>
		@endpush

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
	
			<section class="row Listagens">
				<div class="col-12 col-sm-12 lista">		
					@if(Session::has('success'))
						<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
						{{Session::get('success')}}
						</div>
					@endif
				</div>
			</section>


			
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">

							@if(isset($dataForm))
								{!! $models->appends($dataForm)->links() !!}
							@else
								{!! $models->links() !!}
							@endif


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
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover table-striped">
								<tr>
									<th>Cliente</th>
									<th>Data</th>
									<th>Valor</th>				
									<th>Ações</th>
								</tr>
								@forelse($models as $model)				
									<tr>
										<td> {{ $model->cliente->name }}  </td>		
										<td> {{$model->created_at->format('d/m/Y')}} </td>				
										<td> R$ {{number_format($model->valor, 2 , ',' , '' )}} </td>
										<td>
										
											@if($apagados)
												@permissao('gerencialAtendimentos-show-apagados')								
														<a class="btn btn-success btn-sm" href='{{route("gerencialAtendimentos.showapagado", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao	

												@permissao('gerencialAtendimentos-restore')
													<a class="btn btn-warning btn-sm" href='{{route("gerencialAtendimentos.restore", $model->id)}}'>
														<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Reativar</a>
												@endpermissao 														
														
												@permissao('gerencialAtendimentos-delete-mater-ulta-mega')	
													<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="$(this).find('form').submit();" >
														{!! Form::open(['route' => ['gerencialAtendimentos.destroy', $model->id ],  'method' => 'DELETE' ])!!}                                        
														{!! Form::close()!!}    
														<i class="fa fa-trash" aria-hidden="true"></i>Extinguir</a> 		        
													
												@endpermissao
											@else
												@permissao('gerencialAtendimentos-show')								
														<a class="btn btn-success btn-sm" href='{{route("gerencialAtendimentos.show", $model->id)}}'>
															<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
												@endpermissao																
											
												@perfil('gerencialAtendimentos-soft-delete')			
													<a class="btn btn-danger btn-sm"  href="javascript:void(0);" onclick="$(this).find('form').submit();" >
															{!! Form::open(['route' => ['gerencialAtendimentos.destroySoft', $model->id ],  'method' => 'DELETE' ])!!}                                        
															{!! Form::close()!!}    
															<i class="fa fa-trash" aria-hidden="true"></i>Apagar</a>													
												@endperfil
											@endif
											
										</td>
									</tr>
								@empty
									
								@endforelse
								

							</table>
					</div>


					
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				</div>
			</div>

@endsection