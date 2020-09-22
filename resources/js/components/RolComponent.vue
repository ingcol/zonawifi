<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
               <div class="d-inline">
                 <h5> Módulo de roles</h5>
               </div>
             </div>
           </div>
           <div class="col-lg-4">
            <!--
            <button type="button" class="btn-guardar float-right" v-for='policy in policies'  v-if="policy.title=='Registrar roles'"  @click="ModalNuevo()"><i class="ik ik-check-circle"></i> Registrar</button>

          -->
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <label>Filtrar</label>

          <select v-model="length" @change="resetPagination()" class="form-control input-custom">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
          </select>

        </div>

        <div class="col-md-4"> </div>
        <div class="col-md-4">
          <label>Búsqueda</label>

          <input type="text" v-model="search" placeholder="" @input="resetPagination()" class="form-control input-custom">
        </div>
      </div>

      <br>
      <div class="table-responsive" >

       <table class="table  jambo_table bulk_action  " id="table_grupo" >
        <thead>
          <tr class=" tabla-fondo">
            <th>Nombre</th>
            <!--<th>Permisos</th>
            <th v-for='policy in policies'  v-if="policy.title=='Actualizar roles'">Editar</th>-->
          </tr>
        </thead>
        <tbody>

          <tr v-for="item in paginatedRoles" :key="item.id">
            <td>{{item.title}}</td>
            <!--<td>
              

              <span class="badge badge-light mb-2 ml-2 mr-2" v-for='items in item.permissions'>{{items.title}}</span>

            </td>
            <td><a v-for='policy in policies'  v-if="policy.title=='Actualizar roles'" @click="ModalEditar(item)" class="btn-editar"><i class="ik refresh-ccw ik-refresh-ccw
              "></i> </a></td>-->

            </tr>
          </tbody>

        </table>
      </div>
      <hr>
      <div  class="paginator">
        <nav class="pagination" v-if="!tableShow.showdata" >
          <span class="page-stats cantidad-registro" >{{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>
          <a v-if="pagination.prevPageUrl"  class=" margin-button" @click="--pagination.currentPage">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
          <a class="margin-button" v-else disabled >
            <i class="fa fa-arrow-circle-left"></i>
          </a>
          <a v-if="pagination.nextPageUrl" class=" margin-button"  @click="++pagination.currentPage">
            <i class="fa fa-arrow-circle-right"></i>
          </a>
          <a class="margin-button"  v-else disabled>
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </nav>
        <nav class="pagination" v-else>
          <span class="page-stats cantidad-registro" >Mostrando
            {{pagination.from}} - {{pagination.to}} de un total {{filteredRoles.length}}
            <span v-if="`filteredRoles.length < pagination.total`"></span>
          </span>
          <a v-if="pagination.prevPage" class=" margin-button" @click="--pagination.currentPage" ><i class="fa fa-arrow-circle-left"></i>

          </a>
          <a class="margin-button" v-else disabled >
            <i class="fa fa-arrow-circle-left"></i>
          </a>
          <a v-if="pagination.nextPage" class="margin-button" @click="++pagination.currentPage" ><i class="fa fa-arrow-circle-right"></i>

          </a>
          <a class="margin-button"  v-else disabled ><i class="fa fa-arrow-circle-right"></i>
          </a>
        </nav>
      </div>
      <br><br><br>


    </div>
    <!--modal-->
    <div class="modal fade" id="ModalRol" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
     <div class="modal-dialog " role="document">
      <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title" id="demoModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
                ik-x-square" style=""></span></button>
      </div>
      <form @submit.prevent="ModoEditar ? ActualizarRol(rol) : CrearRol()">
        <div class="modal-body">

          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control"   placeholder="" v-model="rol.title">
          </div>
          <div class="form-group" >
            <label >Permisos</label>
            <hr>
            <input type="checkbox" @click='checkAll()' v-model='isCheckAll' >
            <label >Seleccionar todos</label>
            <hr>
            <div style="max-height: 200px; overflow-y: auto;">
             <ul>
              <li v-for='data in permisos' style="list-style:none;margin-bottom: 3px;">
                <input type="checkbox" v-bind:value='data.id' v-model="checkpermissions" @change='updateCheckall()' >
                <label>{{ data.title }}</label>
              </li></ul>
            </div>

          </div>


        </div>
        <div class="modal-footer">
          <button  class="btn-cerrar" data-dismiss="modal"><i class=" ik x-circle
            ik-x-circle"></i> Cerrar</button>
            <button type="submit" class=""  id="BtnAccion"><i class="" id="icon-save"> </i></button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div></div>
</template>

<script>

export default {
  created() {
    this.getRoles();
    this.getPermisos();
    this.getPolicy();

  },
  data() {
    let sortOrders = {};
    let columns = [
    {label: 'Nombre', name: 'title' },


    ];
    columns.forEach((column) => {
     sortOrders[column.title] = -1;
   });

    return {
      isCheckAll: false,
      ModoEditar: false,
      roles: [],
      policies: [],
      checkpermissions: [],
      permisos: [],
      columns: columns,
        //sortKey: 'title',
        sortOrders: sortOrders,
        length: 10,
        search: '',
        tableShow: {
          showdata: true,
        },

        pagination: {
          currentPage: 1,
          total: '',
          nextPage: '',
          prevPage: '',
          from: '',
          to: ''
        },
        rol: {
         title: ''

       },
       errors: []
     }
   },

   methods: {
    getPolicy: function(){
      axios.get('/api/policy').then(response=>{
        this.policies = response.data;})
    },
    checkAll: function(){

      this.isCheckAll = !this.isCheckAll;
      this.checkpermissions = [];
      if(this.isCheckAll){ // Check all

        for (var data in this.permisos) {
          //this.checkpermissions.push(this.permisos[key]);
          this.checkpermissions.push(this.permisos[data].id);

        }
      }
    },
    updateCheckall: function(){
      if(this.checkpermissions.length == this.permisos.length){
       this.isCheckAll = true;
     }else{
       this.isCheckAll = false;
     }
   },

   ModalNuevo()
   {

     this.checkpermissions = [];
     this.isCheckAll='';

     this.errors = [];

     $('.modal-title').text('Registrar un nuevo rol');
     $('#icon-save').removeClass('ik refresh-ccw ik-refresh-ccw');
     $('#icon-save').addClass('ik ik-check-circle');
     $('#BtnAccion').removeClass('btn-editar');
     $('#BtnAccion').addClass('btn-guardar');
     $("#ModalRol").modal("show");
     $('#icon-save').text(' Guardar');

     this.reset();
     this.ModoEditar = false;


   },
   CrearRol()
   {
    let obj={ title:this.rol.title,permissions:this.checkpermissions}
    axios.post('/rol',obj
     )
    .then(response => {

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

     this.getRoles();

     this.checkpermissions = [];
     this.isCheckAll='';

     /*$("#ModalPrioridad").modal("hide");*/

   })

    .catch(error => {
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
    this.rol.title = '';
      //this.checkpermissions = '';

    },ModalEditar(item){
      this.errors = [];
      $('.modal-title').text('Editar rol');
      $("#icon-save").removeClass( "ik-check-circle" );
      $('#icon-save').addClass('ik refresh-ccw ik-refresh-ccw');
      $('#BtnAccion').removeClass('btn-guardar ');
      $('#BtnAccion').addClass('btn-editar');
      $("#ModalRol").modal("show");
      $('#icon-save').text(' Editar');

//llenar checkbox
this.checkpermissions = [];

axios.get(`/api/rolPermisoCheck/${item.id}`).then(response=>{
  var check = response.data;
  for (var data in check) {

    this.checkpermissions.push(check[data].id);

  }
})

this.rol.title = item.title;
this.rol.id = item.id;
this.ModoEditar = true;
this.isCheckAll='';

},ActualizarRol(rol){



  const params = {title: rol.title, permissions:this.checkpermissions};


  axios.put(`/rol/${rol.id}`, params)
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
    $("#ModalRol").modal("hide");
    this.getRoles();



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
getRoles() {
  axios.get('/api/rol', {params: this.tableShow})
  .then(response => {
    this.roles = response.data;
    this.pagination.total = this.roles.length;
  })
  .catch(errors => {
    console.log(errors);
  });
},
getPermisos: function(){
  axios.get('/api/rolCheckbox').then(response=>{
    this.permisos = response.data;
  })

},


paginate(array, length, pageNumber) {
  this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
  this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
  this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
  this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
  return array.slice((pageNumber - 1) * length, pageNumber * length);
},
resetPagination() {
  this.pagination.currentPage = 1;
  this.pagination.prevPage = '';
  this.pagination.nextPage = '';
},
sortBy(key) {
  this.resetPagination();
  this.sortKey = key;
  this.sortOrders[key] = this.sortOrders[key] * -1;
},
getIndex(array, key, value) {
  return array.findIndex(i => i[key] == value)
},
},
computed: {

  filteredRoles() {
    let roles = this.roles;
    if (this.search) {
      roles = roles.filter((row) => {
        return Object.keys(row).some((key) => {
          return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
        })
      });
    }
    let sortKey = this.sortKey;
    let order = this.sortOrders[sortKey] || 1;
    if (sortKey) {
      roles = roles.slice().sort((a, b) => {
        let index = this.getIndex(this.columns, 'name', sortKey);
        a = String(a[sortKey]).toLowerCase();
        b = String(b[sortKey]).toLowerCase();
        if (this.columns[index].type && this.columns[index].type === 'date') {
          return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
        } else if (this.columns[index].type && this.columns[index].type === 'number') {
          return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
        } else {
          return (a === b ? 0 : a > b ? 1 : -1) * order;
        }
      });
    }
    return roles;
  },
  paginatedRoles() {
    return this.paginate(this.filteredRoles, this.length, this.pagination.currentPage);
  }
}
};
</script>

