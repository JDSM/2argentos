<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ven->idventa}}">
	
	{{Form::Open(array('action'=>array('InicioController@destroy',$ven->idventa),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>

				</button>
				<h4 class="modal-title">CANCELAR VENTA</h4>
			</div>
			<div class="modal-body">
				<p>CONFIRME SI DESEA CANCELAR LA VENTA</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
				<button type="submit" class="btn btn-primary">CONFIRMAR</button>
			</div>
		</div>
	</div>	
	{{Form::Close()}}
</div>