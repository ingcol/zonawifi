<template>
	<div class="main-content">
		<div  class="contenedor-beneficiario">
			<div class="container-fluid">
				<div>
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
               <div class="titulo-beneficiario">
                <h5 v-if="ocultarPanelBeneficiario">Módulo de beneficiarios</h5>

              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="registrar-beneficiario" v-for='policy in policies'  v-if="policy.title=='Registrar beneficiarios'">
              <button type="button"  class="btn-ayuda bg-info text-white border-0 "  @click="ModalNuevo()" v-if="ocultarPanelBeneficiario" ><i class="ik user-plus
                ik-user-plus"></i> Registrar</button></div>
              </div>
            </div>
          </div>
          <div v-if="!ocultarPanelBeneficiario" class="text-center">
            <button  type="button" class="float-left btn-atras font-weight-bold text-dark bg-fa mb-2" @click="atrasBeneficiario"><i class="ik arrow-left
              ik-arrow-left"></i> Atrás</button>
              <br><br>
              <h5> Información de ayudas </h5>
              <h6>{{nombreBeneficiario}} {{apellidoBeneficiario}}</h6>
            </div>
            <hr>
            <div v-if="ocultarPanelBeneficiario">

              <div class="container pb-3 pt-3 border" style="background: #fafafa">
                <input type="number" v-model="campoDocumentoBuscar" placeholder="Número de documento" @input="limpiaDatosBeneficiario" class="form-control" min="1" @keyup.enter="buscarBeneficiario()">
                <div class="text-center mt-2" ><button class="btn-ayuda  mb-2 mr-2 text-success"  v-if="campoDocumentoBuscar" type="button" @click="buscarBeneficiario" ><i class="ik search ik-search font-weight-bold" ></i>  Buscar</button>
                  <button v-for='policy in policies'  v-if="policy.title=='Registrar ayudas'&& btnRegistrarAyuda"  @click="ModalCrearAyuda"  class="btn-ayuda text-danger  mb-2"><i class="ik plus-circle
                    ik-plus-circle font-weight-bold"></i> Ayuda</button>

                  </div>

                </div>
                <div class="container mt-2 border culumn-center"style="background: #fafafa" v-if="infBenenficiario"  >
                  <h6 class="text-center pt-2">Información del beneficiario</h6>
                  <hr>
                  <div class="row">
                   <div class="col-md-4 mb-2">
                     Ayudas recibidas: {{cantidadAyudas}}
                   </div>
                   <div class="col-md-4  mb-2 d-center">
                    <span class="">Documento: {{documentoBeneficiario}}</span>
                  </div>
                  <div class="col-md-4 mb-2">
                    <span class="d-float-right">
                     Nombres: {{nombreBeneficiario}} {{apellidoBeneficiario}}
                   </span>
                 </div>
               </div>
               <div class="row mb-1">
                 <div class="col-md-4 mb-1">
                   Barrio:  {{barrioBeneficiario}}
                 </div>
                 <div class="col-md-4  mb-1 d-center">
                  <span class="">Dirección: {{direccionBeneficiario}}</span>
                </div>
                <div class="col-md-4 mb-1">
                  <span v-if="telefonoBeneficiario"   class="d-float-right">
                   Teléfono: {{telefonoBeneficiario}}
                 </span>
                 <span v-else   class="d-float-right">
                   Teléfono: No registra
                 </span>
               </div>
             </div>
             <div class="row mb-1">
               <div class="col-md-4 mb-1">
                 Género:  {{generoBeneficiario}}
               </div>
               <div class="col-md-4  mb-1 d-center">
                <span v-if="edadBeneficiario" class="">Edad: {{edadBeneficiario}}</span>
                <span v-else class="">Edad: No registra </span>
              </div>
              <div class="col-md-4 mb-1">
                <span class="d-float-right">
                 Registrado por: {{usuarioBeneficiario}}
               </span>
             </div>
           </div>
           <div class="text-center p-3">
            <hr>
            <button class="mr-1 mb-2 btn-ayuda text-dark "  v-for='policy in policies'  v-if="policy.title=='Eliminar beneficiarios'"  @click="ModalEliminarBeneficiario"><i class="ik fx-square
              ik-x-square"></i> Eliminar</button>
              <button   v-for='policy in policies'  v-if="policy.title=='Actualizar beneficiarios'&& btnEditar"  class="mr-1 mb-2 btn-ayuda  text-dark" @click="ModalEditar()"><i class="ik edit ik-edit"></i> Editar</button>
              <button class="ml-1 btn-ayuda text-dark "  v-for='policy in policies'  v-if="policy.title=='Ver ayudas'&& cantidadAyudas"  @click="VerAyudas()"><i class="ik eye ik-eye"></i>  Ver ayudas</button>
            </div>
          </div>
        </div>

        <!--Panel Información ayuda-->
        <div class="container mt-2 culumn-center" v-if="verPanelAyuda" >
         <div class="mb-3 mt-2 border"  v-for="ayuda in verAyudas"  >
          <div class="card-header text-center">
            {{ayuda.FechaAyuda}}
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Descripción: {{ayuda.DescripcionAyuda}}</li>
            <li class="list-group-item">Registrado por: {{ayuda.usuario.NombreUsuario}} {{ayuda.usuario.ApellidoUsuario}}</li>
          </ul>
          <div class="text-center p-3 mb-2">
            <button class="mb-2 btn-ayuda  text-dark bg-fa mr-1 border-0" @click="ModalEliminarAyuda(ayuda.id)"v-for='policy in policies'  v-if="policy.title=='Eliminar ayudas'" ><i class=" ik fx-square
              ik-x-square "></i> Eliminar</button><button class="ml-1 btn-ayuda bg-fa text-dark border-0" @click="ModalEditarAyuda(ayuda)" v-for='policy in policies'  v-if="policy.title=='Actualizar ayudas'"><i class="ik edit ik-edit"></i>  Editar</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--Modal registrar y editar beneficiario-->
    <div class="modal fade pr-0" id="ModalBeneficiario" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
         <div class="modal-header">
          <h5 class="modal-title" id="demoModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
            ik-x-square" style=""></span></button>
          </div>
          <form @submit.prevent="ModoEditar ? ActualizarBeneficiario() : CrearBeneficiario()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                  <label>Documento</label>
                  <input type="number" min="0"  class="form-control"   placeholder="" v-model="beneficiario.DocumentoBeneficiario">
                </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label>Nombres</label>
                <input type="text" class="form-control"   placeholder="" v-model="beneficiario.NombreBeneficiario">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label>Apellidos</label>
              <input type="text" class="form-control"   placeholder="" v-model="beneficiario.ApellidoBeneficiario">
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label>Teléfono</label>
            <input type="number" min="0" class="form-control"   placeholder="" v-model="beneficiario.TelefonoBeneficiario">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
         <div class="form-group">
          <label>Barrio</label>
          <select class='form-control' v-model='beneficiario.barrio_id'>
            <option value=''>Seleccione</option>
            <option v-for='data in barrios' :value='data.id'>{{ data.NombreBarrio }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        <label>Dirección</label>
        <input type="text" class="form-control"   placeholder="" v-model="beneficiario.DireccionBeneficiario">

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
     <div class="form-group">
      <label>Género</label>
      <select class='form-control' v-model='beneficiario.GeneroBeneficiario'>
        <option value=''>Seleccione</option>
        <option value="Femenino">Femenino</option>
        <option value="Masculino">Masculino</option>
        <option value="Otro">Otro</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">
    <label>Edad</label>
    <input type="number" min="1" class="form-control" v-model="beneficiario.EdadBeneficiario">
  </div>
</div>
</div>
</div>
<div class="modal-footer">
  <button  class="btn-cerrar" data-dismiss="modal" ><i class=" ik x-circle
    ik-x-circle"></i> Cerrar</button>
    <button type="submit" class=""  id="BtnAccion"><i class="" id="icon-save"> </i></button>
  </div>
</form>
</div>
</div>
</div>
<!--Modal registrar ayuda humanitaria-->
<div class="modal fade pr-0" id="ModalCrearAyuda"  role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
 <div class="modal-dialog " role="document">
  <div class="modal-content">
   <div class="modal-header text-center">

    <h5  class="w-100">Registrar ayuda humanitaria</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
      ik-x-square" style=""></span></button>
    </div>
    <form @submit.prevent="CrearAyuda()">
      <div class="modal-body">
        <label class="text-left">Beneficiario: {{nombreBeneficiario}}  {{apellidoBeneficiario}}</label>
        <hr>

        <div class="form-group">
          <label>Fecha</label>
          <date-pick
          v-model="FechaAyuda" :displayFormat="'YYYY-MM-DD'"
          :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
          ></date-pick>
        </div>
        <div class="form-group">
          <label >Descripción</label>
          <textarea class="form-control" row="2" v-model="DescripcionAyuda"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button  class="btn-cerrar" data-dismiss="modal" ><i class=" ik x-circle
          ik-x-circle"></i> Cerrar</button>
          <button type="submit"  class="btn-guardar "><i class="ik ik-check-circle"></i> Guardar</button>

        </div>
      </form>
    </div>
  </div>
</div>
<!--Modal editar ayuda humanitaria-->
<div class="modal fade pr-0" id="ModalEditarAyuda"  role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static"  >
 <div class="modal-dialog  modal-dialog-centered" role="document">
  <div class="modal-content">
   <div class="modal-header text-center">

    <h5  class="w-100">Editar ayuda humanitaria</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
      ik-x-square" style=""></span></button>
    </div>
    <form @submit.prevent="EditarAyuda()">
      <div class="modal-body">
        <div class="form-group">
          <label>Fecha</label>
          <date-pick
          v-model="editarFechaAyuda" :displayFormat="'YYYY-MM-DD'"
          :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
          ></date-pick>
        </div>
        <div class="form-group">
          <label >Descripción</label>
          <textarea class="form-control" row="2" v-model="editarDescripcionAyuda"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button  class="btn-ayuda bg-red text-white border-0" data-dismiss="modal" ><i class=" ik x-circle
          ik-x-circle"></i> Cerrar</button>
          <button type="submit"  class="btn-ayuda bg-orange text-white border-0"><i class="ik ik-check-circle"></i> Editar</button>

        </div>
      </form>
    </div>
  </div>
</div>
<!---MODAL ELIMINAR AYUDA-->
<div class="modal fade pr-0" id="ModalEliminarAyuda"  role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static"  >
 <div class="modal-dialog " role="document">
  <div class="modal-content">
   <div class="modal-header text-center">

    <h5  class="w-100">¿Desea eliminar esta ayuda?</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
      ik-x-square" style=""></span></button>
    </div>

    <div class="modal-body text-center p-4">
      <button  class="btn-ayuda bg-red text-white border-0 mb-2" data-dismiss="modal" >
      Cancelar</button>
      <button type="submit"  class="btn-ayuda bg-orange text-white border-0   " @click="eliminarAyuda"> Eliminar</button>

    </div>


  </div>
</div>
</div>

<!---MODAL ELIMINAR BENEFICIARIO-->
<div class="modal fade pr-0" id="ModalEliminarBeneficiario"  role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static"  >
 <div class="modal-dialog " role="document">
  <div class="modal-content">
   <div class="modal-header text-center">

    <h5  class="w-100">¿Desea eliminar este beneficiario?</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
      ik-x-square" style=""></span></button>
    </div>
    <div>
      <p v-if="cantidadAyudas>0" class="p-3"><strong> ¡Atención!</strong> Si elimina el beneficiario; también serán eliminadas las ayudas que a este fueron registradas.</p>
    </div>

    <div class="modal-body text-center p-4">
      <button  class="btn-ayuda bg-red text-white border-0 mb-2" data-dismiss="modal" >
      Cancelar</button>
      <button type="submit"  class="btn-ayuda bg-orange text-white border-0   " @click="eliminarBeneficiario"> Eliminar</button>

    </div>


  </div>
</div>
</div>

</div>
</template>

<script>
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
import moment from 'moment';
moment.lang('es');

export default {
  components: {DatePick},
  mounted() {
   this.getPolicy();
   this.getBarrio();
 },
 data() {


  return {
      //Ayuda Humanitaria
      FechaAyuda:'',
      fechaActual:'',
      DescripcionAyuda:'',
      //Configuración date piker
      nextMonthCaption:  'Sig mes',
      prevMonthCaption:'Ant mes',
      weekdays: [
      'lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab', 'Dom'
      ],
      months: [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
      ],
      //Datos de búsqueda
      documentoBeneficiario:'',
      nombreBeneficiario:'',
      apellidoBeneficiario:'',
      telefonoBeneficiario:'',
      direccionBeneficiario:'',
      generoBeneficiario:'',
      edadBeneficiario:'',
      barrioBeneficiario:'',
      usuarioBeneficiario:'',
      id_barrio:'',
      id_beneficiario:'',
      cantidadAyudas:0,
      ///
      infBenenficiario:false,
      btnEditar:false,
      btnRegistrarAyuda:false,
      campoDocumentoBuscar:'',
      ModoEditar: false,
      beneficiarios: [],
      policies: [],
      barrios: [],
      verAyudas: [],
      //Panel ayudas
      ocultarPanelBeneficiario:true,
      verPanelAyuda:false,

      //Editar Ayuda
      editarDescripcionAyuda:'',
      editarFechaAyuda:'',
      editarIdAyuda:'',
      eliminarIdAyuda:'',

      beneficiario: {
       NombreBeneficiario: '',
       ApellidoBeneficiario: '',
       DocumentoBeneficiario: '',
       TelefonoBeneficiario:'',
       DireccionBeneficiario:'',
       GeneroBeneficiario:'',
       barrio_id:'',
       EdadBeneficiario:'',

     },

   }
 },

 methods: {
  limpiaDatosBeneficiario(){
    if (!this.campoDocumentoBuscar) {
      this.infBenenficiario=false;
      this.btnEditar=false;
      this.btnRegistrarAyuda=false;
    }
  },
  getPolicy: function(){
   axios.get('/api/policy').then(response=>{
    this.policies = response.data;})
 },
 buscarBeneficiario(){
   axios.get('api/buscarBeneficiario',{
     params: {
       campoDocumentoBuscar:this.campoDocumentoBuscar
     }
   }).then(response=>{
    this.infBenenficiario=true;
    this.btnEditar=true;
    this.btnRegistrarAyuda=true;
    this.nombreBeneficiario=response.data.datosBeneficiario.NombreBeneficiario;
    this.apellidoBeneficiario=response.data.datosBeneficiario.ApellidoBeneficiario;
    this.documentoBeneficiario=response.data.datosBeneficiario.DocumentoBeneficiario;
    this.telefonoBeneficiario=response.data.datosBeneficiario.TelefonoBeneficiario;
    this.edadBeneficiario=response.data.datosBeneficiario.EdadBeneficiario;
    this.direccionBeneficiario=response.data.datosBeneficiario.DireccionBeneficiario;
    this.generoBeneficiario=response.data.datosBeneficiario.GeneroBeneficiario;
    this.id_barrio=response.data.datosBeneficiario.barrio_id;
    this.id_beneficiario=response.data.datosBeneficiario.id;
    this.barrioBeneficiario=response.data.barrioBeneficiario;
    this.usuarioBeneficiario=response.data.usuarioBeneficiario;
    this.cantidadAyudas=response.data.cantidadAyudas;

  }).catch(error => {
   this.infBenenficiario=false;
   this.btnRegistrarAyuda=false;
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
getBarrio: function(){
 axios.get('/api/listaBarrio').then(response=>{
  this.barrios = response.data;})
},
ModalNuevo()
{
 $('.modal-title').text('Registrar un beneficiario');
 $('#icon-save').removeClass('ik refresh-ccw ik-refresh-ccw');
 $('#icon-save').addClass('ik ik-check-circle');
 $('#BtnAccion').removeClass('btn-editar');
 $('#BtnAccion').addClass('btn-guardar');
 $("#ModalBeneficiario").modal("show");
 $('#icon-save').text(' Guardar');
 this.reset();
 this.ModoEditar = false;
},
CrearBeneficiario()
{
  axios.post('/beneficiario', {
   NombreBeneficiario :this.beneficiario.NombreBeneficiario ,ApellidoBeneficiario:this.beneficiario.ApellidoBeneficiario,DocumentoBeneficiario:this.beneficiario.DocumentoBeneficiario,TelefonoBeneficiario:this.beneficiario.TelefonoBeneficiario,DireccionBeneficiario:this.beneficiario.DireccionBeneficiario,GeneroBeneficiario:this.beneficiario.GeneroBeneficiario,EdadBeneficiario:this.beneficiario.EdadBeneficiario,barrio_id:this.beneficiario.barrio_id,
 })
  .then(response => {
   $("#ModalBeneficiario").modal("hide");
   this.campoDocumentoBuscar=this.beneficiario.DocumentoBeneficiario;
   this.buscarBeneficiario();
   this.reset();

   $.toast({
    heading: '¡Hecho!',
    text: 'Registro exitoso',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right',
    hideAfter: 1700
  });

 }).catch(error => {
   this.errors = [];
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
reset()
{
 this.beneficiario.NombreBeneficiario="";
 this.beneficiario.ApellidoBeneficiario="";
 this.beneficiario.DocumentoBeneficiario="";
 this.beneficiario.TelefonoBeneficiario="";
 this.beneficiario.DireccionBeneficiario="";
 this.beneficiario.GeneroBeneficiario="";
 this.beneficiario.EdadBeneficiario="";
 this.beneficiario.barrio_id="";
},
ModalEditar(){
 $('.modal-title').text('Editar beneficiario');
 $("#icon-save").removeClass( "ik-check-circle" );
 $('#icon-save').addClass('ik refresh-ccw ik-refresh-ccw');
 $('#BtnAccion').removeClass('btn-guardar ');
 $('#BtnAccion').addClass('btn-editar');
 $("#ModalBeneficiario").modal("show");
 $('#icon-save').text(' Editar')
 this.beneficiario.NombreBeneficiario=this.nombreBeneficiario;
 this.beneficiario.ApellidoBeneficiario=this.apellidoBeneficiario;
 this.beneficiario.DocumentoBeneficiario=this.documentoBeneficiario;
 this.beneficiario.TelefonoBeneficiario=this.telefonoBeneficiario;
 this.beneficiario.DireccionBeneficiario=this.direccionBeneficiario;
 this.beneficiario.GeneroBeneficiario=this.generoBeneficiario;
 this.beneficiario.EdadBeneficiario=this.edadBeneficiario;
 this.beneficiario.barrio_id=this.id_barrio;
 this.ModoEditar = true;
},
ActualizarBeneficiario(){
  const params = {NombreBeneficiario :this.beneficiario.NombreBeneficiario ,ApellidoBeneficiario:this.beneficiario.ApellidoBeneficiario,DocumentoBeneficiario:this.beneficiario.DocumentoBeneficiario,TelefonoBeneficiario:this.beneficiario.TelefonoBeneficiario,DireccionBeneficiario:this.beneficiario.DireccionBeneficiario,GeneroBeneficiario:this.beneficiario.GeneroBeneficiario,EdadBeneficiario:this.beneficiario.EdadBeneficiario,barrio_id:this.beneficiario.barrio_id};
  axios.put(`/beneficiario/${this.id_beneficiario}`, params)
  .then(response=>{
    this.ModoEditar = false;
    $("#ModalBeneficiario").modal("hide");
    this.campoDocumentoBuscar=this.beneficiario.DocumentoBeneficiario;
    this.buscarBeneficiario();
    $.toast({
      heading: '¡Hecho!',
      text: 'Registro actualizado con éxito',
      showHideTransition: 'slide',
      icon: 'success',
      loaderBg: '#f96868',
      position: 'top-right',
      hideAfter: 1700
    });

  })
  .catch(error => {
    this.ModoEditar = true;
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
ModalCrearAyuda(){
  $("#ModalCrearAyuda").modal("show");
  this.fechaActual=moment().format('YYYY-MM-DD')
  this.FechaAyuda=this.fechaActual;
  this.DescripcionAyuda="";
},
CrearAyuda(){
  axios.post('/ayuda', {
   beneficiario_id:this.id_beneficiario,FechaAyuda:this.FechaAyuda,DescripcionAyuda:this.DescripcionAyuda
 })
  .then(response => {
   $("#ModalCrearAyuda").modal("hide");
   this.DescripcionAyuda="";
   this.fechaActual=moment().format('YYYY-MM-DD')
   this.FechaAyuda=this.fechaActual;
   this.campoDocumentoBuscar=this.documentoBeneficiario;
   this.buscarBeneficiario();
   this.reset();

   $.toast({
    heading: '¡Hecho!',
    text: 'Registro exitoso',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right',
    hideAfter: 1700
  });

 }).catch(error => {
   this.errors = [];
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
VerAyudas(){

  this.ocultarPanelBeneficiario=false;
  this.verPanelAyuda=true;
  axios.get(`ayuda/${this.id_beneficiario}`).then(response=>{
    this.verAyudas=response.data;


  }).catch(errors => {

  });
},
atrasBeneficiario(){
  this.ocultarPanelBeneficiario=true;
  this.verPanelAyuda=false;
},
ModalEditarAyuda(ayuda){
  $("#ModalEditarAyuda").modal("show");
  this.editarDescripcionAyuda=ayuda.DescripcionAyuda
  this.editarFechaAyuda=ayuda.FechaAyuda;
  this.editarIdAyuda=ayuda.id;
},
EditarAyuda(){
  const params = {FechaAyuda: this.editarFechaAyuda, DescripcionAyuda: this.editarDescripcionAyuda};
  axios.put(`/ayuda/${this.editarIdAyuda}`, params)
  .then(response=>{

    $.toast({
      heading: '¡Hecho!',
      text: 'Registro actualizado con éxito',
      showHideTransition: 'slide',
      icon: 'success',
      loaderBg: '#f96868',
      position: 'top-right',
      hideAfter: 1700
    });
    $("#ModalEditarAyuda").modal("hide");
    this.VerAyudas();
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
ModalEliminarAyuda(ayuda_id){
  this.eliminarIdAyuda=ayuda_id;
  $("#ModalEliminarAyuda").modal("show");

},
eliminarAyuda(){

  axios.delete(`/ayuda/${this.eliminarIdAyuda}`)
  .then(response=>{

    $.toast({
      heading: '¡Hecho!',
      text: 'Registro eliminado con éxito',
      showHideTransition: 'slide',
      icon: 'info',
      loaderBg: '#f96868',
      position: 'top-right',
      hideAfter: 1700
    });
    $("#ModalEliminarAyuda").modal("hide");
    this.VerAyudas();
    this.buscarBeneficiario();
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
ModalEliminarBeneficiario(){

  $("#ModalEliminarBeneficiario").modal("show");

},
eliminarBeneficiario(){

  axios.delete(`/beneficiario/${this.id_beneficiario}`)
  .then(response=>{

    $.toast({
      heading: '¡Hecho!',
      text: 'Registro eliminado con éxito',
      showHideTransition: 'slide',
      icon: 'info',
      loaderBg: '#f96868',
      position: 'top-right',
      hideAfter: 1700
    });
    $("#ModalEliminarBeneficiario").modal("hide");

    this.campoDocumentoBuscar='';
    this.limpiaDatosBeneficiario();

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

},

};
</script>

