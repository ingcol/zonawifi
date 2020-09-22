<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
               <div class="d-inline">
                 <h5> Módulo de barrios <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" accept=".XLSX, .CSV" class="form-control">

                  <button v-on:click="EventSubir()" class="btn btn-primary">Subir</button></h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <button type="button"   class="btn-guardar float-right" v-for='policy in policies'  v-if="policy.title=='Registrar roles'"  @click="ModalNuevo()"><i class="ik ik-check-circle"></i> Registrar</button>
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
              <th>Descripción</th>
              <th>Estado</th>
              <th v-for='policy in policies'  v-if="policy.title=='Actualizar barrios'">Editar</th>
            </tr>
          </thead>
          <tbody>

            <tr v-for="item in paginatedBarrios" :key="item.id">
              <td>{{item.NombreBarrio}}</td>
              <td>{{item.DescripcionBarrio}}</td>
              <td>{{item.EstadoBarrio}}</td>
              <td v-for='policy in policies'  v-if="policy.title=='Actualizar barrios'"><a @click="ModalEditar(item)" class="btn-editar"><i class="ik refresh-ccw ik-refresh-ccw
                "></i> </a></td>

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
              {{pagination.from}} - {{pagination.to}} de un total {{filteredBarrios.length}}
              <span v-if="`filteredBarrios.length < pagination.total`"></span>
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
      <div class="modal fade" id="ModalBarrio" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
       <div class="modal-dialog " role="document">
        <div class="modal-content">
         <div class="modal-header">
          <h5 class="modal-title" id="demoModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
            ik-x-square" style=""></span></button>
          </div>
          <form @submit.prevent="ModoEditar ? ActualizarBarrio(barrio) : CrearBarrio()">
            <div class="modal-body">

              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control"   placeholder="" v-model="barrio.NombreBarrio">
              </div>
              <div class="form-group">
                <label >Descripción</label>
                <textarea class="form-control" row="2" v-model="barrio.DescripcionBarrio"></textarea>
              </div>
              <div class="form-group">
                <label>Estado</label>
                <select class="form-control" v-model="barrio.EstadoBarrio">
                 <option value="Activo" selected="">Activo</option>
                 <option value="Inactivo">Inactivo</option>


               </select>
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
  </div></div>
</template>

<script>

  export default {
    created() {
      this.getBarrios();
      this.getPolicy();
    },
    data() {
      let sortOrders = {};
      let columns = [
      {label: 'Nombre', name: 'NombreBarrio' },
      {label: 'Descripcion', name: 'DescripcionBarrio'},
      {label: 'Estado', name: 'EstadoBarrio'},

      ];
      columns.forEach((column) => {
       sortOrders[column.NombreBarrio] = -1;
     });

      return {
        file:'',
        ModoEditar: false,
        barrios: [],
        policies: [],
        columns: columns,
        //sortKey: 'EstadoBarrio',
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
        barrio: {
         NombreBarrio: '',
         DescripcionBarrio: '',
         EstadoBarrio: ''
       },
       errors: []
     }
   },

   methods: {
    EventSubir(){
      let formData = new FormData();
      formData.append('file', this.file);
      axios
      .post( 'api/barrioImportar',
        formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
        ).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });
      },

      handleFileUpload(){
        this.file = this.$refs.file.files[0];
      },
      getPolicy: function(){
        axios.get('/api/policy').then(response=>{
          this.policies = response.data;})
      },

      ModalNuevo()
      {
        this.errors = [];

        $('.modal-title').text('Registrar un nuevo barrio');
        $('#icon-save').removeClass('ik refresh-ccw ik-refresh-ccw');
        $('#icon-save').addClass('ik ik-check-circle');
        $('#BtnAccion').removeClass('btn-editar');
        $('#BtnAccion').addClass('btn-guardar');
        $("#ModalBarrio").modal("show");
        $('#icon-save').text(' Guardar');

        this.reset();
        this.ModoEditar = false;
      },
      CrearBarrio()
      {
        axios.post('/barrio', {
         NombreBarrio:this.barrio.NombreBarrio,DescripcionBarrio:this.barrio.DescripcionBarrio,EstadoBarrio:this.barrio.EstadoBarrio,
       })
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
         this.barrios.push(response.data);
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
      this.barrio.NombreBarrio = '';
      this.barrio.DescripcionBarrio = '';
      this.barrio.EstadoBarrio = 'Activo';
    },ModalEditar(item){
      this.errors = [];
      $('.modal-title').text('Editar barrio');
      $("#icon-save").removeClass( "ik-check-circle" );
      $('#icon-save').addClass('ik refresh-ccw ik-refresh-ccw');
      $('#BtnAccion').removeClass('btn-guardar ');
      $('#BtnAccion').addClass('btn-editar');
      $("#ModalBarrio").modal("show");
      $('#icon-save').text(' Editar')
      this.barrio.NombreBarrio = item.NombreBarrio;
      this.barrio.DescripcionBarrio = item.DescripcionBarrio;
      this.barrio.EstadoBarrio = item.EstadoBarrio;
      this.barrio.id = item.id;
      this.ModoEditar = true;
    },ActualizarBarrio(barrio){
      const params = {NombreBarrio: barrio.NombreBarrio, DescripcionBarrio: barrio.DescripcionBarrio,EstadoBarrio:barrio.EstadoBarrio};
      axios.put(`/barrio/${barrio.id}`, params)
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
        $("#ModalBarrio").modal("hide");

        const index = this.barrios.findIndex(busqueda => busqueda.id === response.data.id)
        this.barrios[index].NombreBarrio=response.data.NombreBarrio;
        this.barrios[index].DescripcionBarrio=response.data.DescripcionBarrio;
        this.barrios[index].EstadoBarrio=response.data.EstadoBarrio; })
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
    getBarrios() {
      axios.get('/api/barrio', {params: this.tableShow})
      .then(response => {
        this.barrios = response.data;
        this.pagination.total = this.barrios.length;
      })
      .catch(errors => {
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

    filteredBarrios() {
      let barrios = this.barrios;
      if (this.search) {
        barrios = barrios.filter((row) => {
          return Object.keys(row).some((key) => {
            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
          })
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        barrios = barrios.slice().sort((a, b) => {
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
      return barrios;
    },
    paginatedBarrios() {
      return this.paginate(this.filteredBarrios, this.length, this.pagination.currentPage);
    }
  }
};
</script>

