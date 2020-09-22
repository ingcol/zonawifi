<template>
  <div class="main-content">
    <div class="contenedor">
      <div class="container-fluid">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
               <div class="d-inline">
                <h5>Informe de ayuda humanitaria</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <a  @click="getExcel" v-for='policy in policies'  v-if="policy.title=='Exportar infome múltiple' && cantidadBeneficiario>0" class="float-right btn-standar border-0 font-weight-bold text-white bg-success mt-1"><i class="ik file-text ik-file-text"></i>
            Informe en excel</a>
          </div>

        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-2 mb-2">
          <label class="display-block">Fecha incial</label>
          <date-pick
          v-model="fechaInicio" :displayFormat="'YYYY-MM-DD'"
          :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
          ></date-pick>

        </div>
        <div class="col-md-2 mb-4">
         <label>Fecha final</label>
         <br>
         <date-pick
         v-model="fechaFin" :displayFormat="'YYYY-MM-DD'"
         :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
         ></date-pick>
       </div>

       <div class="col-md-2 mb-2">
         <label>Edad inicial</label>
         <input type="number"  min="1" v-model="edadInicial"  class="form-control">
       </div>
       <div class="col-md-2 mb-2">
         <label>Edad final</label>
         <input type="number"  min="1" v-model="edadFinal" class="form-control">
       </div>
       <div class="col-md-2 mb-2">
         <label>Barrio</label>
         <select class="form-control"  v-model="barrio_id">
          <option value="-1">Todos</option>
          <option v-for="data in barrios" :value='data.id'>
            {{data.NombreBarrio}}

          </option>
        </select>
      </div>
      <div class="col-md-2 mb-2">
       <label>Género</label>
       <select class="form-control" v-model="generoBeneficiario">
         <option value="-1">Todos</option>
         <option value="Femenino">Femenino</option>
         <option value="Masculino">Masculino</option>
         <option value="Otro">Otro</option>
       </select>

     </div>

   </div>
   <div class="text-center bg-fa p-3">
     <a  @click="getBeneficiarios"  class=" btn-standar border-0 font-weight-bold text-white bg-info mt-1"><i class="ik filter
      ik-filter"></i>
    Filtrar datos</a>
  </div>
  <hr>
  <div class="row mt-4">
    <div class="col-md-3">
     <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar </span>
      </div>
      <select v-model="length" @change="resetPagination()" class="form-control input-custom">
        <option value="50">50</option>
        <option value="200">200</option>
        <option value="1000">1000</option>
      </select>
    </div>
  </div>
  <div class="col-md-6 ">
    <div class=" mb-3">
      <div class="text-center">
        <span class="mb-2 ml-1 mr-1 border-0 rounded-0 text-dark fondo-filtro span-responsive"  v-text="'Femenino: ' + cantidadFemenino " ></span>
        <span class="mb-2 ml-1 mr-1  border-0 rounded-0 text-dark fondo-filtro  span-responsive"  v-text="'Masculino: ' + cantidadMasculino " ></span>
        <span class="border-0 mb-2 ml-1 mr-1  rounded-0  text-dark fondo-filtro span-responsive"v-text="'Otro: ' + cantidadGeneroOtro"  ></span>
        <span class="ml-1 mr-1  border-0 rounded-0 text-dark fondo-filtro mb-2 span-responsive"  v-text="'Beneficiarios: '+ cantidadBeneficiario " ></span>


      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">Buscar </span>
      </div>

      <input type="text" v-model="search" placeholder="" @change="resetPagination()" class="form-control input-custom">
    </div></div>
  </div>

  <br>
  <div class="table-responsive" >
   <table class="table  jambo_table bulk_action  " id="table_grupo" >
    <thead>
      <tr class=" tabla-fondo">
        <th>Documento</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Género</th>
        <th>Edad</th>
        <th>Ayudas recibidas</th>
      </tr>
    </thead>
    <tbody>

      <tr v-for="item in paginatedBeneficiarios" :key="item.id">

        <td>{{item.DocumentoBeneficiario}}</td>
        <td>{{item.NombreBeneficiario}} {{item.ApellidoBeneficiario}}</td>
        <td>Barrio {{item.NombreBarrio}} , {{item.DireccionBeneficiario}}</td>
        <td>{{item.TelefonoBeneficiario}}</td>
        <td>{{item.GeneroBeneficiario}}</td>
        <td>{{item.EdadBeneficiario}}</td>
        <td>{{item.CantidadAyuda}}</td>
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
      {{pagination.from}} - {{pagination.to}} de un total {{filteredBeneficiarios.length}}
      <span v-if="`filteredBeneficiarios.length < pagination.total`"></span>
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
<!--- modal ---->

<loading :active.sync="isLoading"
:can-cancel="false"></loading>
</div>
</template>

<script>
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import moment from 'moment';
    moment.lang('es');
    export default {
      components: {DatePick,   Loading},
      mounted() {
        this.getBarrios();
        this.getPolicy();
    //this.getBeneficiarios();
  },

  data() {
    let sortOrders = {};


    return {
      beneficiarios:[],
      barrios:[],
      policies: [],
      edadInicial:'',
      edadFinal:'',
      barrio_id:-1,
      generoBeneficiario:-1,
      fechaInicio:'',
      fechaFin:'',
      //Cantidades
      cantidadBeneficiario:0,
      cantidadFemenino:0,
      cantidadMasculino:0,
      cantidadGeneroOtro:0,
      //loading
      isLoading: false,

      nextMonthCaption:  'Sig mes',
      prevMonthCaption:'Ant mes',
      weekdays: [
      'lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab', 'Dom'
      ],
      months: [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
      ],
      sortOrders: sortOrders,
      length: 50,
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

    }
  },

  methods: {
    getPolicy: function(){
      axios.get('/api/policy').then(response=>{
        this.policies = response.data;})
    },

    getExcel() {
      this.isLoading = true;
      var url = '/exportarExcel';
      axios.get(url, {
        responseType: 'arraybuffer',
        params: {
         fechaInicio: this.fechaInicio,fechaFin: this.fechaFin,edadInicial:this.edadInicial,edadFinal:this.edadFinal,generoBeneficiario:this.generoBeneficiario,barrio_id:this.barrio_id
       }

     }).then(response => {
    //RESPUESTA
    this.isLoading = false;
    let blob = new Blob([response.data], { type: 'application/vnd.ms-excel' })
    let link = document.createElement('a')
    link.href = window.URL.createObjectURL(blob)
    link.download = 'beneficiarios.xlsx'
    link.click()

  }) .catch(error => {
    _.forEach(error.response.data.errors, function(value, key) {


    });


  });
},
getBarrios(){
 axios.get('/api/listaBarrio').then(response=>{
  this.barrios = response.data;
})
},

getBeneficiarios() {
  this.isLoading = true;
  axios.get('/api/informeExcel',{
   params: {
     fechaInicio: this.fechaInicio,fechaFin: this.fechaFin,showdata:true,edadInicial:this.edadInicial,edadFinal:this.edadFinal,generoBeneficiario:this.generoBeneficiario,barrio_id:this.barrio_id
   }
 }).then(response => {
  this.isLoading = false;
  this.beneficiarios = response.data.ayuda;
  this.pagination.total = this.beneficiarios.length;
  this.cantidadFemenino=response.data.cantidadFemenino;
  this.cantidadMasculino=response.data.cantidadMasculino;
  this.cantidadGeneroOtro=response.data.cantidadGeneroOtro;
  this.cantidadBeneficiario=response.data.cantidadBeneficiario;




}) .catch(error => {
  _.forEach(error.response.data.errors, function(value, key) {
    $.toast({
      heading: '¡Atención!',
      text: value,
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#f2a654',
      position: 'top-right',
      hideAfter: 5700

    });

  });


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

  filteredBeneficiarios() {
    let beneficiarios = this.beneficiarios;
    if (this.search) {
      beneficiarios = beneficiarios.filter((row) => {
        return Object.keys(row).some((key) => {
          return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
        })
      });
    }
    let sortKey = this.sortKey;
    let order = this.sortOrders[sortKey] || 1;
    if (sortKey) {
      beneficiarios = beneficiarios.slice().sort((a, b) => {
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
    return beneficiarios;
  },
  paginatedBeneficiarios() {
    return this.paginate(this.filteredBeneficiarios, this.length, this.pagination.currentPage);
  }
}
};
</script>
<style>
.vdpArrowPrev:after {
  border-right-color: #cc99cd;
  font-size: 16px;
}

.vdpArrowNext:after {
  border-left-color: #cc99cd;font-size: 16px;

}


.vdpCell.selectable:hover .vdpCellContent,
.vdpCell.selected .vdpCellContent {
  background: #cc99cd;
}

.vdpCell.today {
  color: white;
  border-radius: 5px;
  background: orange;
}

.vdpTimeUnit > input:hover,
.vdpTimeUnit > input:focus {
  border-bottom-color: #cc99cd;

}
.vdpComponent{
  /* position: relative; */
  display: block;
  font-size: 10px;
  color: #303030;
}
.vdpWithInput>input{

  position: none;
  width: 100% !important;
  height: 35px;
  padding: .375rem .75rem;
  font-size: 13px;

  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #eaeaea;
  border-radius: .25rem;
}
.calendar-desing > input{

  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

}
.btn-standar{
  border-radius: 20px;
  padding: 3px 12px;
  color: white;
  box-shadow: 2px 3px 2px #ddd;
  border: 0;
  font-size: 14px;
  cursor: pointer;}
  </style>
