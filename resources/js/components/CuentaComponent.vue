<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">

								<div class="d-inline">
									<h5> Mi cuenta</h5>

								</div>
							</div>
						</div>

					</div>
				</div>
				<hr>

				<!--form-->
				<form @submit.prevent=" ActualizarUsuario()">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-4">

								<div class="form-group">
									<label>Nombres</label>
									<input type="text" class="form-control"   placeholder="" v-model="datos.NombreUsuario">

								</div>
							</div>
							<div class="col-md-4">

								<div class="form-group">
									<label>Apellidos</label>
									<input type="text" class="form-control"   placeholder="" v-model="datos.ApellidoUsuario">
								</div>
							</div>
							<div class="col-md-4">

								<div class="form-group">
									<label>Documento</label>
									<input type="number" class="form-control" min="1"  placeholder="" v-model="datos.DocumentoUsuario">
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Télefono</label>
									<input type="number" class="form-control"  min="1" placeholder="" v-model="datos.TelefonoUsuario">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control"   placeholder="" v-model="datos.email">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Género</label>
									<select class='form-control' v-model='datos.GeneroUsuario'>
										<option value=''>Seleccione</option>
										<option value="Femenino">Femenino</option>
										<option value="Masculino">Masculino</option>
										<option value="Otro">Otro</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Usuario</label>
									<input type="text" class="form-control"   placeholder="" v-model="datos.username" id="user">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Contraseña</label>
									<input type="password" class="form-control"   placeholder="" v-model="datos.password">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Confirmar contraseña</label>
									<input type="password" class="form-control"   placeholder="" v-model="datos.password_confirmation">
								</div>
							</div>
						</div>
						<div class="modal-footer">

							<button type="submit" class="btn-editar mt-2 float-right " ><i class="ik refresh-ccw ik-refresh-ccw"> </i> Editar</button>

						</div>
					</div>

				</form>


			</div>

		</div></div>

	</template>
	<script>

	export default {
		created() {
			this.getDatos();

		},

		data() {

			return {

				datos: [],
				errors: []
			}
		},

		methods: {

			ActualizarUsuario(){

				const params = {NombreUsuario:this.datos.NombreUsuario,
					ApellidoUsuario:this.datos.ApellidoUsuario,
					DocumentoUsuario:this.datos.DocumentoUsuario,
					email:this.datos.email,
					username:this.datos.username,TelefonoUsuario:this.datos.TelefonoUsuario,
					password:this.datos.password,
					password_confirmation:this.datos.password_confirmation,GeneroUsuario:this.datos.GeneroUsuario};

					axios.put(`/usuario/${this.datos.id}`, params)
		//axios.post('/cuentaupdate', params)
		.then(response=>{
			this.ModoEditar = false;
			$.toast({
				heading: '¡Hecho!',
				text: 'Registro actualizado con éxito',
				showHideTransition: 'slide',
				icon: 'success',
				loaderBg: '#f96868',
				position: 'top-right',
				hideAfter: 1700
			});
			this.datos.password='';
			this.datos.password_confirmation='';
		})
		.catch(error => {
			this.ModoEditar = true;
			this.errors=[];

			_.forEach(error.response.data.errors, function(value, key) {
				$.toast({
					heading: '¡Error!',
					text: value,
					showHideTransition: 'slide',
					icon: 'error',
					loaderBg: '#f2a654',
					position: 'top-right',

				});

			});


		});




	},

	getDatos: function(){
		axios.get('/api/cuentaVue').then(response=>{
			this.datos = response.data;
			this.espacio();

		})


	},

	espacio(){
		document.getElementById("user").addEventListener('keyup', sanear);
		function sanear(e) {
			let contenido = e.target.value;
			e.target.value = contenido.replace(" ", "");
		}
	},


}

};
</script>
<style>
.input-custom{
	border-radius: 5px;
	height: 35px !important;
	background: #fff;
}
.margin-button{color: #222 !important;  padding: 3px 14px; background: #fafafa; margin-left: 2px; cursor: pointer
}
.cantidad-registro{margin-top: 5px;}
.tabla-fondo{
	background: #f7f7f7;
}
.paginator{
	float: right;
}
.btn-guardar{
	background: #0fb9d8;
	border-radius: 20px;
	padding: 2px 10px;
	color:white;
	box-shadow: 2px 5px 2px #ddd;
	border:0;font-size: 14px;
}

.btn-editar{
	background: orange;
	border-radius: 20px;
	padding: 2px 14px;
	color:white !important;
	box-shadow: 2px 5px 2px #ddd;
	cursor: pointer;
	border:0;
	font-size: 14px;

}
.btn-cerrar{
	background: #F22613;
	border-radius: 20px;
	padding: 2px 14px;
	color:white !important;
	box-shadow: 2px 5px 2px #ddd;
	cursor: pointer;border:0;font-size: 14px;

}
.contenedor{
	background: white;padding: 20px;border: solid 1px #f7f7f7; margin: 0 5px 0 5px
}
</style>