<template>
	<div class="main-content">
		<div  class="contenedor">
			<div class="container-fluid">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">

								<div class="d-inline">
									<h5> Módulo de usuarios</h5>

								</div>
							</div>
						</div>
						<div class="col-lg-4">


							<button type="button" class="btn-guardar float-right" v-for='policy in policies'  v-if="policy.title=='Registrar usuarios'"  @click="ModalNuevo()"><i class="ik ik-check-circle"></i> Registrar</button>
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

              <th>Nombres</th>
              <th>Documento</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Usuario</th>
              <th>Género</th>
              <th>Estado</th>
              <th>Rol</th>
              <th v-for='policy in policies'  v-if="policy.title=='Actualizar usuarios'">Editar</th>
            </tr>
          </thead>
          <tbody>

            <tr v-for="item in paginatedUsuarios" :key="item.id">
              <td>{{item.NombreUsuario}} {{item.ApellidoUsuario}}</td>
              <td>{{item.DocumentoUsuario}}</td>
              <td>{{item.email}}</td>
              <td>{{item.TelefonoUsuario}}</td>
              <td>{{item.username}}</td>
              <td>{{item.GeneroUsuario}}</td>
              <td>{{item.EstadoUsuario}}</td>

              <td>
                <i v-for='data in item.roles'>{{data.title}}</i>
              </td>
              <td v-for='policy in policies'  v-if="policy.title=='Actualizar usuarios'"><a  @click="ModalEditar(item)" class="btn-editar"><i class="ik refresh-ccw ik-refresh-ccw
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
              {{pagination.from}} - {{pagination.to}} de un total {{filteredUsuarios.length}}
              <span v-if="`filteredUsuarios.length < pagination.total`"></span>
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
      <div class="modal fade" id="ModalUsuario" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <h5 class="modal-title" id="demoModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ik x-square
                ik-x-square" style=""></span></button>
          </div>
          <form @submit.prevent="ModoEditar ? ActualizarUsuario(usuario) : CrearUsuario()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">

                 <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" class="form-control"   placeholder="" v-model="usuario.NombreUsuario">

                </div>
              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control"   placeholder="" v-model="usuario.ApellidoUsuario">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label>Documento</label>
                  <input type="number" class="form-control" min="1"  placeholder="" v-model="usuario.DocumentoUsuario">
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="number" class="form-control" min="1"  placeholder="" v-model="usuario.TelefonoUsuario">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control"   placeholder="" v-model="usuario.email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Usuario</label>
                  <input type="text" class="form-control"   placeholder="" v-model="usuario.username" id="user">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label>Contraseña</label>
                  <input type="password" class="form-control"   placeholder="" v-model="usuario.password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Confirmar contraseña</label>
                  <input type="password" class="form-control"   placeholder="" v-model="usuario.password_confirmation">
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4">
            <div class="form-group">
              <label>Género</label>
              <select class='form-control' v-model='usuario.GeneroUsuario'>
                <option value=''>Seleccione</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
          </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label id="TitleRol"></label>
                  <select class='form-control' v-model='usuario.RolUsuario'>
                    <option value=''>Seleccione</option>
                    <option v-for='data in roles' :value='data.id'>{{ data.title }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">

               <div class="form-group">
                <label>Estado</label>
                <select class="form-control" v-model="usuario.EstadoUsuario">
                 <option value="Activo">Activo</option>
                 <option value="Inactivo">Inactivo</option></select>
             </div>
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
    this.getUsuarios();
    this.getRoles();
    this.getPolicy();


  },

  data() {
    let sortOrders = {};
    let columns = [



    ];
    columns.forEach((column) => {
     sortOrders[column.NombreUsuario] = -1;
   });

    return {
      policies:[],
      ModoEditar: false,
      usuarios: [],
      roles: [],
      columns: columns,
        //sortKey: 'EstadoUsuario',
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
        usuario: {
         NombreUsuario: '',
         ApellidoUsuario: '',
         DocumentoUsuario: '',
         email:            '',
         username:'',
         EstadoUsuario:'',
         TelefonoUsuario:'',
         password:       '',
         password_confirmation: '',
         RolUsuario:'',
         GeneroUsuario:'',

       },
       errors: []
     }
   },

   methods: {
    getPolicy: function(){
      axios.get('/api/policy').then(response=>{
        this.policies = response.data;})
    },
    ModalNuevo()
    {
      this.errors = [];

      $('.modal-title').text('Registrar un nuevo usuario');
      $('#icon-save').removeClass('ik refresh-ccw ik-refresh-ccw');
      $('#icon-save').addClass('ik ik-check-circle');
      $('#BtnAccion').removeClass('btn-editar');
      $('#BtnAccion').addClass('btn-guardar');
      $("#ModalUsuario").modal("show");
      $('#icon-save').text(' Guardar');
      $('#TitleRol').text('Rol');

      this.espacio();

      this.reset();
      this.ModoEditar = false;



    },
    CrearUsuario()
    {
      axios.post('/usuario', {
       NombreUsuario:this.usuario.NombreUsuario,
       ApellidoUsuario:this.usuario.ApellidoUsuario,
       DocumentoUsuario:this.usuario.DocumentoUsuario,
       email:this.usuario.email,
       username:this.usuario.username ,
       EstadoUsuario:this.usuario.EstadoUsuario,
       TelefonoUsuario:this.usuario.TelefonoUsuario,
       password:this.usuario.password,
       password_confirmation:this.usuario.password_confirmation,
       RolUsuario:this.usuario.RolUsuario,GeneroUsuario:this.usuario.GeneroUsuario
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

       //this.usuarios.push(response.data);
       this.getUsuarios();
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
      this.usuario.NombreUsuario='';
      this.usuario.ApellidoUsuario='';
      this.usuario.DocumentoUsuario='';
      this.usuario.email='';
      this.usuario.username='';
      this.usuario.EstadoUsuario='Activo';
      this.usuario.TelefonoUsuario='';
      this.usuario.password='';
      this.usuario.password_confirmation='';
      this.usuario.RolUsuario='';
      this.usuario.GeneroUsuario='';


    },
    espacio(){
      document.getElementById("user").addEventListener('keyup', sanear);
      function sanear(e) {
        let contenido = e.target.value;
        e.target.value = contenido.replace(" ", "");
      }
    },
    ModalEditar(item){
      this.errors = [];
      $('.modal-title').text('Editar usuario');
      $("#icon-save").removeClass( "ik-check-circle" );
      $('#icon-save').addClass('ik refresh-ccw ik-refresh-ccw');
      $('#BtnAccion').removeClass('btn-guardar ');
      $('#BtnAccion').addClass('btn-editar');
      $("#ModalUsuario").modal("show");
      $('#icon-save').text(' Editar');
      $('#TitleRol').text('Actualizar rol');

      this.espacio();

      this.usuario.NombreUsuario=item.NombreUsuario;
      this.usuario.ApellidoUsuario=item.ApellidoUsuario;
      this.usuario.DocumentoUsuario=item.DocumentoUsuario;
      this.usuario.email=item.email;
      this.usuario.username=item.username;
      this.usuario.EstadoUsuario=item.EstadoUsuario;
      this.usuario.TelefonoUsuario=item.TelefonoUsuario;
      this.usuario.RolUsuario='';
      this.usuario.GeneroUsuario=item.GeneroUsuario;


      this.usuario.id = item.id;
      this.ModoEditar = true;
      this.usuario.password='';
      this.usuario.password_confirmation='';
    },ActualizarUsuario(usuario){


      const params = {NombreUsuario:usuario.NombreUsuario,
       ApellidoUsuario:usuario.ApellidoUsuario,
       DocumentoUsuario:usuario.DocumentoUsuario,
       email:usuario.email,
       username:usuario.username ,
       EstadoUsuario:usuario.EstadoUsuario,
       TelefonoUsuario:usuario.TelefonoUsuario,
       password:usuario.password,
       password_confirmation:usuario.password_confirmation,RolUsuario:usuario.RolUsuario,GeneroUsuario:usuario.GeneroUsuario};


       axios.put(`/usuario/${usuario.id}`, params)
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
        $("#ModalUsuario").modal("hide");
        this.usuario.password='';
        this.usuario.password_confirmation='';

        this.getUsuarios();
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
     getUsuarios() {
      axios.get('/api/usuario', {params: this.tableShow})
      .then(response => {
        this.usuarios = response.data;
       this.pagination.total = this.usuarios.length;
      })
      .catch(errors => {
        console.log(errors);
      });
    },
    getRoles: function(){
      axios.get('/api/selectRol').then(response=>{
        this.roles = response.data;
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

    filteredUsuarios() {
      let usuarios = this.usuarios;
      if (this.search) {
        usuarios = usuarios.filter((row) => {
          return Object.keys(row).some((key) => {
            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
          })
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        usuarios = usuarios.slice().sort((a, b) => {
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
      return usuarios;
    },
    paginatedUsuarios() {
      return this.paginate(this.filteredUsuarios, this.length, this.pagination.currentPage);
    }
  }
};
</script>

