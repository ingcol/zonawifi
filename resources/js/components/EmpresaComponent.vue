<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
               <div class="d-inline">
                 <h5>Información empresarial</h5>
               </div>
             </div>
           </div>

         </div>
       </div>
       <hr>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control"   placeholder=""  v-model="NombreEmpresa">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Slogan</label>
              <input type="text" class="form-control"   placeholder=""  v-model="SloganEmpresa">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Teléfono</label>
              <input type="number" min="0" class="form-control"   placeholder="" v-model="TelefonoEmpresa">
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" class="form-control"   placeholder="" v-model="DireccionEmpresa">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control"   placeholder="" v-model="EmailEmpresa">
            </div>
          </div>
        </div>
       <hr>
      <button type="submit"  class="btn-guardar float-right mb-4" v-for='policy in policies'  v-if="policy.title=='Actualizar datos de la empresa'" @click="actualizarDatoEmpresa"><i class=" ik refresh-cw
        ik-refresh-cw"></i> Actualizar</button>

      <br>




    </div>


  </div></div>
</template>

<script>

export default {
  created() {
    this.getEmpresa();
    this.getPolicy();
  },
  data() {

    return {
      policies:[],
      chekcLimiteTiempo:false,
      TiempoMinimoTurnoEmpresa:'',
      SecuenciaTurnoEmpresa:1,
      NombreEmpresa:'',
      SloganEmpresa:'',
      TelefonoEmpresa:'',
      DireccionEmpresa:'',
      EmailEmpresa:'',
      id:'',
    }
  },

  methods: {
   getPolicy: function(){
    axios.get('/api/policy').then(response=>{
      this.policies = response.data;})
  },
  mostrarLimiteTurno(){

    if (this.chekcLimiteTiempo) {
      this.TiempoMinimoTurnoEmpresa="";
    }
  },

  actualizarDatoEmpresa(){

    const params = {NombreEmpresa: this.NombreEmpresa,
      SloganEmpresa:this.SloganEmpresa,TelefonoEmpresa:this.TelefonoEmpresa,DireccionEmpresa:this.DireccionEmpresa,
      EmailEmpresa:this.EmailEmpresa,SecuenciaTurnoEmpresa:this.SecuenciaTurnoEmpresa,TiempoMinimoTurnoEmpresa:this.TiempoMinimoTurnoEmpresa,chekcLimiteTiempo:this.chekcLimiteTiempo
    };


    axios.put(`/empresa/${this.id}`, params)
    .then(response=>{

      $.toast({
        heading: '¡Hecho!',
        text: 'Datos actualizados con éxito',
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right',
        hideAfter: 1700
      });



    })
    .catch(error => {

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
  getEmpresa: function(){
    axios.get('/api/empresa').then(response=>{
     this.NombreEmpresa = response.data.NombreEmpresa;
     this.SloganEmpresa = response.data.SloganEmpresa;

     this.TelefonoEmpresa = response.data.TelefonoEmpresa;
     this.DireccionEmpresa = response.data.DireccionEmpresa;
     this.EmailEmpresa = response.data.EmailEmpresa;
     this.SecuenciaTurnoEmpresa = response.data.SecuenciaTurnoEmpresa;
     this.TiempoMinimoTurnoEmpresa=response.data.TiempoMinimoTurnoEmpresa;
     if (this.TiempoMinimoTurnoEmpresa) {
      this.chekcLimiteTiempo=true;
    }
    this.id = response.data.id;


  })


  },
}};
</script>


