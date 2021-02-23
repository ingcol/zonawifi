<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						
           <div class="col-lg-6 page-header-title">
            <h6 class="font-weight-bold" v-text="'Usuarios conectados:  ' +personaCantidadConectado"></h6>

          </div>
          <div class="col-lg-6 page-header-title">
            <h6 class="text-right font-weight-bold" v-text="'Cantidad total de usuarios:  ' +personaCantidad"></h6>

          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4">
          <label>Filtrar</label>

          <select v-model="length" @change="resetPagination()" class="form-control input-custom">
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
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
            <th>Cant. Conexiones</th>
            <th>Ver</th>
            <th>Nombres</th>
            <th>Documento</th>
            <th>Género</th>
            <th>Grado</th>
          </tr>
        </thead>
        <tbody>

          <tr v-for="item in paginatedPersonas" :key="item.id">
            <td>{{item.cantConexion}}</td>
            <th><a class="btn-editar" @click="infoConexion(item.id,item.nombre,item.nombre_grado,item.cantConexion)"><i class="ik wifi ik-wifi"></i></a></th>
            <td>{{item.nombre}}</td>
            <td>{{item.documento}}</td>
            <td>{{item.genero}}</td>
            <td>{{item.nombre_grado}}</td>

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
          {{pagination.from}} - {{pagination.to}} de un total {{filteredPersonas.length}}
          <span v-if="`filteredPersonas.length < pagination.total`"></span>
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

</div>
<div class="modal fade" id="ModalConexion" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <div class="modal-header">
      <h5 class="modal-title" id="demoModalLabel">{{nombreAlumno}} </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
        ik-x-square" style=""></span></button>
      </div>
      <div class="modal-body mt-3 ">
        <div class="table-responsive" >
          <h6>Cantidad de conexiones: {{cantidadConexionUsuario}}</h6>

          <table class="table  jambo_table bulk_action  " id="table_grupo" >
            <thead>
              <tr class=" tabla-fondo">
                <th>Fecha</th>

              </tr>
            </thead>
            <tbody>

              <tr v-for="item in conexiones" >

                <td>{{fechaFormateada(item.created_at)}}</td>


              </tr>
            </tbody>

          </table>
        </div>


      </div>

    </div>
  </div>
</div>

<loading :active.sync="isLoading"
:can-cancel="false"></loading>
</div>
</template>

<script>
  import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import 'vue-date-pick/dist/vueDatePick.css';
    import moment from 'moment';
    moment.lang('es');
    export default {
      created() {
        this.getPersonas();
        
      },
      data() {
        let sortOrders = {};
        let columns = [
      /*
      {label: 'Nombre', name: 'NombreBarrio' },
      {label: 'Descripcion', name: 'DescripcionBarrio'},
      {label: 'Estado', name: 'EstadoBarrio'},
      */

      ];
      columns.forEach((column) => {
       sortOrders[column.NombrePersona] = -1;
     });

      return {
        conexiones:[],

        personas: [],
        isLoading:false,
        personaCantidad:'',
        personaCantidadConectado:'',
        cantidadConexionUsuario:'',

        columns: columns,
        //sortKey: 'EstadoBarrio',
        sortOrders: sortOrders,
        length: 100,
        search: '',
        tableShow: {
          showdata: true,
        },
        nombreAlumno:'',
        gradoAlumno:'',

        pagination: {
          currentPage: 1,
          total: '',
          nextPage: '',
          prevPage: '',
          from: '',
          to: ''
        },
        

      }
    },
    components: {

     Loading
   },
   methods: {

    infoConexion(id,nombreAlumno,gradoAlumno,cantidadConexionUsuario){
      this.conexiones=[]
      this.cantidadConexionUsuario=cantidadConexionUsuario
      this.nombreAlumno=nombreAlumno
      this.gradoAlumno=gradoAlumno
      $("#ModalConexion").modal("show");
      axios.get('/api/conexioPorUsuarioLiceo', {params:{idUsuario:id}})
      .then(response => {

        this.conexiones = response.data.conexiones;

        //this.personaCantidad=response.data.personaCantidad;
      })
      .catch(errors => {


        console.log(errors);
      });

    },
    fechaFormateada(fecha){
     return moment(fecha).format("D, MMMM YYYY, h:mm a");
 //return moment(fecha).format(" h:mm a");
},

getPersonas() {
  this.isLoading=true;
  axios.get('/api/listadoUsuarioLiceo', {params: this.tableShow})
  .then(response => {
    this.isLoading=false
    this.personas = response.data.persona;
    this.personaCantidad=response.data.personaCantidad;
    this.personaCantidadConectado=response.data.personaCantidadConectado;
    this.pagination.total = this.personas.length;
  })
  .catch(errors => {
    this.isLoading=false

    console.log(errors);
  });
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

  filteredPersonas() {
    let personas = this.personas;
    if (this.search) {
      personas = personas.filter((row) => {
        return Object.keys(row).some((key) => {
          return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
        })
      });
    }
    let sortKey = this.sortKey;
    let order = this.sortOrders[sortKey] || 1;
    if (sortKey) {
      personas = personas.slice().sort((a, b) => {
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
    return personas;
  },
  paginatedPersonas() {
    return this.paginate(this.filteredPersonas, this.length, this.pagination.currentPage);
  }
}
};
</script>

