<template>
  <div class="main-content">
    <div class="contenedor">
      <div class="container-fluid">
        <div class="page-header">
          <div class="row align-items-end">
            <div class="col-lg-8">
              <div class="page-header-title">
               <div class="d-inline">
                <h5>Filtro general por rango de fecha</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">

          </div>

        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-2">
          <label class="display-block">Fecha incial</label>
          <date-pick
          v-model="fechaInicio" :displayFormat="'YYYY-MM-DD'"
          :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
          ></date-pick>

        </div>
        <div class="col-md-4 mb-2">
         <label>Fecha final</label>
         <br>
         <date-pick
         v-model="fechaFin" :displayFormat="'YYYY-MM-DD'"
         :nextMonthCaption="nextMonthCaption" :weekdays="weekdays" :months="months":prevMonthCaption="prevMonthCaption" :inputAttributes="{readonly: true}"  class="calendar-desing"
         ></date-pick>
       </div>


       <div class="col-md-4 mb-2">
         <label>Filtro</label>
         <select class="form-control"  v-model="filtrarDatos">
          <option value="">Seleccione</option>
          <option value="1">Todos</option>
          <option value="2">Edad</option>
          <option value="3">Tipo de población</option>
          <option value="4">Barrio</option>
          <option value="5">Horario de conexión</option>
          <option value="6">Género</option>
        </select>
      </div>
      

    </div>
    <div class="text-center bg-fa p-3">
     <a  @click="getDatos"  class=" btn-standar border-0 font-weight-bold text-white bg-info mt-1"><i class="ik filter
      ik-filter"></i>
    Filtrar datos</a>
  </div>
  <hr>
  <div class="row mt-4 mb-4 p-3 bg-white" v-if="verEdad">
    <div class="col-md-12">
     <fusioncharts
     :type="tipoEdad"
     :width="width"
     :height="height"
     :dataformat="dataFormat"
     :dataSource="dataEdad">
   </fusioncharts>

 </div>
</div>
<div class="row mt-4 mb-4 p-3 bg-white"  v-if="verPoblacion">
  <div class="col-md-12">
   <fusioncharts
   :type="tipoEdad"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataPoblacion">
 </fusioncharts>

</div>
</div>
<div class="row mt-4 mb-4 p-3 bg-white"  v-if="verBarrio">
  <div class="col-md-12">
   <fusioncharts
   :type="tipoBarrio"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataBarrio"

   >
 </fusioncharts>

</div>
</div>

<div class="row mt-4 mb-4  p-3 bg-white"  v-if="verHorario">
  <div class="col-md-12">
   <fusioncharts
   :type="tipoEdad"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataHorario"

   >
 </fusioncharts>

</div>
</div>

<div class="row mt-4 mb-4  p-3 bg-white"  v-if="verGenero">
  <div class="col-md-12">
   <fusioncharts
   :type="type"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataGenero"

   >
 </fusioncharts>

</div>
</div>


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
        //this.getDatos();

        
      },

      data() {
        let sortOrders = {};


        return {
          //show filter
          verGenero:false,
          verEdad:false,
          verPoblacion:false,
          verHorario:false,
          verBarrio:false,
          type: "column3d",
          renderAt: "chart-container",
          width: "100%",
          height: "600",
          dataFormat: "json",
          //eda
          tipoEdad: "column2d",

          //
          datacollection: {},
          //Data chart
          dataGenero:{},
          dataEdad:{},
          dataPoblacion:{},
          dataBarrio:{},
          dataHorario:{},

          fechaInicio:'',
          fechaFin:'',
          filtrarDatos:'',
          height:"680",

          tipoBarrio: "bar2d",

          isLoading: false,

          nextMonthCaption:  'Sig mes',
          prevMonthCaption:'Ant mes',
          weekdays: [
          'lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab', 'Dom'
          ],
          months: [
          'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
          ],


        }
      },

      methods: {
        getDatos(){

          if (this.fechaInicio=="") {
           $.toast({
            heading: '¡Error!',
            text: 'Ingrese una fecha inicial',
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'top-right',
            hideAfter: 5000
          });

           return

         }
         if (this.fechaFin=="") {

          $.toast({
            heading: '¡Error!',
            text: 'Ingrese una fecha final',
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'top-right',
            hideAfter: 5000
          });

          return

        }
        if (this.filtrarDatos=="") {
          $.toast({
            heading: '¡Error!',
            text: 'Seleccione una opción para el filtro',
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'top-right',
            hideAfter: 5000
          });
          return

        }
        this.isLoading = true;
        var url = 'api/filtroTameGeneral';
        axios.get(url, {

          params: {
           fechaInicio: this.fechaInicio,fechaFin: this.fechaFin,filtrarDatos:this.filtrarDatos}

         }).then(response => {
    //RESPUESTA
    if (response.data.filtro==1) {

      this.verGenero=true;
      this.verEdad=true;
      this.verPoblacion=true;
      this.verHorario=true;
      this.verBarrio=true;

          //Género
          this.dataGenero= {
            chart: {
              caption: "Conexión por género",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",
              xaxisname: "",
              yaxisname: "Cantidad de personas",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",


              theme: "fusion",
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#666666",
              "borderThickness": "4",
                /* color de fondo
                "bgColor": "#FAFAFA",
                "bgAlpha": "50",*/


              },
              data: [
              {
                label: "Femenino",
                value: response.data.femenino
              },
              {
                label: "Masculino",
                value: response.data.masculino
              },
              {
                label: "LGTBI",
                value: response.data.lgtbi
              },
              {
                label: "Otro",
                value: response.data.otro
              },


              ],

            };
            //poblacion
            this.dataPoblacion= {
              chart: {
                caption: "Conexión por tipo de población",
                SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
                subcaptionFontSize: "17",
                "subcaptionFontColor": "#333333",
                "subcaptionFontBold": "0",

                xaxisname: "",
                yaxisname: "Cantidad de personas",

                theme: "fusion",
                exportEnabled:1,
                "showValues": "1",
                "rotateValues": "0",
                "valueFontColor": "#000000",
                "valueBgColor": "#FFFFFF",
                "valueBgAlpha": "50",
                "borderColor": "#666666",
                "borderThickness": "4",
                "thousandSeparator": ".",
                "numberScaleValue": "1000,1000,1000",


              },
              data: [
              {
                label: "No aplica",
                value: response.data.poblacionNinguna
              },
              {
                label: "Víctima del conflicto",
                value: response.data.poblacionVictima
              },
              {
                label: "Afrocolombianos",
                value: response.data.poblacionAfrocolombia
              },
              {
                label: "Comunidad indígena",
                value: response.data.poblacionIndigena
              },
              {
                label: "Adulto mayor",
                value: response.data.poblacionMayor
              },


              ],

            };
          //Edades
          this.dataEdad= {
            chart: {
              caption: "Conexión por rango de  edad",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",

              xaxisname: "",
              yaxisname: "Personas",
              theme:"fusion",

              
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#FFFFFF",
              "borderThickness": "0",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",
              
              paletteColors: '#0075c2,#1aaf5d,#f2c500,#FF5733',


            },
            data: [
            {
              label: "Entre 10 y 20 años",
              value: response.data.rangoUnoEdad
            },
            {
              label: "Entre 21 y 30 años",
              value: response.data.rangoDosEdad
            },
            {
              label: "Entre 31 y 40 años",
              value: response.data.rangoTresEdad
            },
            {
              label: "Entre 41 y 50 años",
              value: response.data.rangoCuatroEdad
            },
            {
              label: "Mayores de 50 años",
              value: response.data.rangoCincoEdad
            },


            ],

          };
          //Barrio
          this.dataBarrio= {
            chart: {
              caption: "Conexión por barrio",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",

              xaxisname: "",
              yaxisname: "Cantidad de personas",

              theme: "fusion",
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#666666",
              "borderThickness": "4",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",
              paletteColors: '#1aaf5d',

            },
            data: [


            {label:"Alibei",
            value: response.data.barrioUno},
            {label:"Acasias II",
            value: response.data.barrioDos},  
            {label:"Bajo cusay II",
            value: response.data.barrioTres},  
            {label:"Banco purare",
            value: response.data.barrioCuatro},  
            {label:"Betoyes ",
            value: response.data.barrioCinco}, 
            {label:"Brisas de satena",
            value: response.data.barrioSeis},  
            {label:"Brisas de tamacay",
            value: response.data.barrioSiete},  
            {label:"Brisas del cravo",
            value: response.data.barrioOcho},  
            {label:"Caño limón",
            value: response.data.barrioNueve},  
            {label:"Corocito ",
            value: response.data.barrioDiez}, 
            {label:"Caño corozo",
            value: response.data.barrioDuno},  
            {label:"El pesebre",
            value: response.data.barrioDdos},  
            {label:"El susto",
            value: response.data.barrioDtres},  
            {label:"Filipinas",
            value: response.data.barrioDcuatro},  
            {label:"La arenosa",
            value: response.data.barrioDcinco},  
            {label:"La holanda",
            value: response.data.barrioDseis},  
            {label:"La unión",
            value: response.data.barrioDsiete},  
            {label:"Lejanías",
            value: response.data.barrioDocho},  
            {label:"Marquelandia",
            value: response.data.barrioDnueve},  
            {label:" Napoles ",
            value: response.data.barrioVeinte}, 
            {label:"Nuevo amanecer",
            value: response.data.barrioVuno},  
            {label:"Rincón de la esperanza",
            value: response.data.barrioVdos},  
            {label:"Rincón hondo",
            value: response.data.barrioVtres},  
            {label:"San antonio",
            value: response.data.barrioVcuatro},  
            {label:"San salvador",
            value: response.data.barrioVcinco},  
            {label:"Santo domingo caserio",
            value: response.data.barrioVseis},  
            {label:"Saparay ",
            value: response.data.barrioVsiete}, 
            {label:"Vereda santo domingo",
            value: response.data.barrioVocho},  
            ],

          };
          //Horario
          this.dataHorario= {
            chart: {
              caption: "Horario de conexión",

              xaxisname: "",
              yaxisname: "Cantidad de personas",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",

              theme: "fusion",
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#666666",
              "borderThickness": "4",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",


            },
            data: [
            {
              label: "12  AM",
              value: response.data.navegacionCero
            },
            {
              label: "1",
              value: response.data.navegacionUno
            },
            {
              label: "2",
              value: response.data.navegacionDos
            },
            {
              label: "3",
              value: response.data.navegacionTres
            },
            {
              label: "4",
              value: response.data.navegacionCuatro
            },
            {
              label: "5",
              value: response.data.navegacionCinco
            },
            {
              label: "6",
              value: response.data.navegacionSeis
            },
            {
              label: "7",
              value: response.data.navegacionSiete
            },
            {
              label: "8",
              value: response.data.navegacionOcho
            },
            {
              label: "9",
              value: response.data.navegacionNueve
            },
            {
              label: "10",
              value: response.data.navegacionDiez
            },
            {
              label: "11",
              value: response.data.navegacionDuno
            },
            {
              label: "12  PM",
              value: response.data.navegacionDdos
            },
            {
              label: "1",
              value: response.data.navegacionDtres
            },
            {
              label: "2",
              value: response.data.navegacionDcuatro
            },{
              label: "3",
              value: response.data.navegacionDquinto
            },
            {
              label: "4",
              value: response.data.navegacionDsexto
            },
            {
              label: "5",
              value: response.data.navegacionDseptimo
            },
            {
              label: "6",
              value: response.data.navegacionDoctavo
            },
            {
              label: "7",
              value: response.data.navegacionDnoveno
            },{
              label: "8",
              value: response.data.navegacionVeinte
            },
            {
              label: "9",
              value: response.data.navegacionVuno
            },
            {
              label: "10",
              value: response.data.navegacionVdos
            },
            {
              label: "11",
              value: response.data.navegacionVtres
            },



            ],

          };

        }
        //Edad
        else if (response.data.filtro==2) {
          this.verGenero=false;
          this.verEdad=true;
          this.verPoblacion=false;
          this.verHorario=false;
          this.verBarrio=false;

          this.dataEdad= {
            chart: {
              caption: "Conexión por rango de  edad",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",

              xaxisname: "",
              yaxisname: "Personas",
              theme:"fusion",

              
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#FFFFFF",
              "borderThickness": "0",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",
              
              paletteColors: '#0075c2,#1aaf5d,#f2c500,#FF5733',


            },
            data: [
            {
              label: "Entre 10 y 20 años",
              value: response.data.rangoUnoEdad
            },
            {
              label: "Entre 21 y 30 años",
              value: response.data.rangoDosEdad
            },
            {
              label: "Entre 31 y 40 años",
              value: response.data.rangoTresEdad
            },
            {
              label: "Entre 41 y 50 años",
              value: response.data.rangoCuatroEdad
            },
            {
              label: "Mayores de 50 años",
              value: response.data.rangoCincoEdad
            },


            ],

          };

        }

        //Población
        else if (response.data.filtro==3) {
          //poblacion
          this.verGenero=false;
          this.verEdad=false;
          this.verPoblacion=true;
          this.verHorario=false;
          this.verBarrio=false;
          this.dataPoblacion= {
            chart: {
              caption: "Conexión por tipo de población",
              SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
              subcaptionFontSize: "17",
              "subcaptionFontColor": "#333333",
              "subcaptionFontBold": "0",

              xaxisname: "",
              yaxisname: "Cantidad de personas",

              theme: "fusion",
              exportEnabled:1,
              "showValues": "1",
              "rotateValues": "0",
              "valueFontColor": "#000000",
              "valueBgColor": "#FFFFFF",
              "valueBgAlpha": "50",
              "borderColor": "#666666",
              "borderThickness": "4",
              "thousandSeparator": ".",
              "numberScaleValue": "1000,1000,1000",


            },
            data: [
            {
              label: "No aplica",
              value: response.data.poblacionNinguna
            },
            {
              label: "Víctima del conflicto",
              value: response.data.poblacionVictima
            },
            {
              label: "Afrocolombianos",
              value: response.data.poblacionAfrocolombia
            },
            {
              label: "Comunidad indígena",
              value: response.data.poblacionIndigena
            },
            {
              label: "Adulto mayor",
              value: response.data.poblacionMayor
            },


            ],

          };
        }
//barrio
else if (response.data.filtro==4) {



  this.verGenero=false;
  this.verEdad=false;
  this.verPoblacion=false;
  this.verHorario=false;
  this.verBarrio=true;
  this.dataBarrio= {
    chart: {
      caption: "Conexión por barrio",
      SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
      subcaptionFontSize: "17",
      "subcaptionFontColor": "#333333",
      "subcaptionFontBold": "0",

      xaxisname: "",
      yaxisname: "Cantidad de personas",


      theme: "fusion",
      exportEnabled:1,
      "showValues": "1",
      "rotateValues": "0",
      "valueFontColor": "#000000",
      "valueBgColor": "#FFFFFF",
      "valueBgAlpha": "50",
      "borderColor": "#666666",
      "borderThickness": "4",
      "thousandSeparator": ".",
      "numberScaleValue": "1000,1000,1000",
      paletteColors: '#1aaf5d',
    },
    data: [


    {label:"Alibei",
    value: response.data.barrioUno},
    {label:"Acasias II",
    value: response.data.barrioDos},  
    {label:"Bajo cusay II",
    value: response.data.barrioTres},  
    {label:"Banco purare",
    value: response.data.barrioCuatro},  
    {label:"Betoyes ",
    value: response.data.barrioCinco}, 
    {label:"Brisas de satena",
    value: response.data.barrioSeis},  
    {label:"Brisas de tamacay",
    value: response.data.barrioSiete},  
    {label:"Brisas del cravo",
    value: response.data.barrioOcho},  
    {label:"Caño limón",
    value: response.data.barrioNueve},  
    {label:"Corocito ",
    value: response.data.barrioDiez}, 
    {label:"Caño corozo",
    value: response.data.barrioDuno},  
    {label:"El pesebre",
    value: response.data.barrioDdos},  
    {label:"El susto",
    value: response.data.barrioDtres},  
    {label:"Filipinas",
    value: response.data.barrioDcuatro},  
    {label:"La arenosa",
    value: response.data.barrioDcinco},  
    {label:"La holanda",
    value: response.data.barrioDseis},  
    {label:"La unión",
    value: response.data.barrioDsiete},  
    {label:"Lejanías",
    value: response.data.barrioDocho},  
    {label:"Marquelandia",
    value: response.data.barrioDnueve},  
    {label:" Napoles ",
    value: response.data.barrioVeinte}, 
    {label:"Nuevo amanecer",
    value: response.data.barrioVuno},  
    {label:"Rincón de la esperanza",
    value: response.data.barrioVdos},  
    {label:"Rincón hondo",
    value: response.data.barrioVtres},  
    {label:"San antonio",
    value: response.data.barrioVcuatro},  
    {label:"San salvador",
    value: response.data.barrioVcinco},  
    {label:"Santo domingo caserio",
    value: response.data.barrioVseis},  
    {label:"Saparay ",
    value: response.data.barrioVsiete}, 
    {label:"Vereda santo domingo",
    value: response.data.barrioVocho},  
    ],

  };

}
//Conexión
else if (response.data.filtro==5) {



  this.verGenero=false;
  this.verEdad=false;
  this.verPoblacion=false;
  this.verHorario=true;
  this.verBarrio=false;
  this.dataHorario= {
    chart: {
      caption: "Horario de conexión",

      xaxisname: "",
      yaxisname: "Cantidad de personas",
      SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
      subcaptionFontSize: "17",
      "subcaptionFontColor": "#333333",
      "subcaptionFontBold": "0",

      theme: "fusion",
      exportEnabled:1,
      "showValues": "1",
      "rotateValues": "0",
      "valueFontColor": "#000000",
      "valueBgColor": "#FFFFFF",
      "valueBgAlpha": "50",
      "borderColor": "#666666",
      "borderThickness": "4",
      "thousandSeparator": ".",
      "numberScaleValue": "1000,1000,1000",


    },
    data: [
    {
      label: "12  AM",
      value: response.data.navegacionCero
    },
    {
      label: "1",
      value: response.data.navegacionUno
    },
    {
      label: "2",
      value: response.data.navegacionDos
    },
    {
      label: "3",
      value: response.data.navegacionTres
    },
    {
      label: "4",
      value: response.data.navegacionCuatro
    },
    {
      label: "5",
      value: response.data.navegacionCinco
    },
    {
      label: "6",
      value: response.data.navegacionSeis
    },
    {
      label: "7",
      value: response.data.navegacionSiete
    },
    {
      label: "8",
      value: response.data.navegacionOcho
    },
    {
      label: "9",
      value: response.data.navegacionNueve
    },
    {
      label: "10",
      value: response.data.navegacionDiez
    },
    {
      label: "11",
      value: response.data.navegacionDuno
    },
    {
      label: "12  PM",
      value: response.data.navegacionDdos
    },
    {
      label: "1",
      value: response.data.navegacionDtres
    },
    {
      label: "2",
      value: response.data.navegacionDcuatro
    },{
      label: "3",
      value: response.data.navegacionDquinto
    },
    {
      label: "4",
      value: response.data.navegacionDsexto
    },
    {
      label: "5",
      value: response.data.navegacionDseptimo
    },
    {
      label: "6",
      value: response.data.navegacionDoctavo
    },
    {
      label: "7",
      value: response.data.navegacionDnoveno
    },{
      label: "8",
      value: response.data.navegacionVeinte
    },
    {
      label: "9",
      value: response.data.navegacionVuno
    },
    {
      label: "10",
      value: response.data.navegacionVdos
    },
    {
      label: "11",
      value: response.data.navegacionVtres
    },



    ],

  };
  

}
//Género
else if (response.data.filtro==6) {



  this.verGenero=true;
  this.verEdad=false;
  this.verPoblacion=false;
  this.verHorario=false;
  this.verBarrio=false;
  //Género
  this.dataGenero= {
    chart: {
      caption: "Conexión por género",
      SubCaption:"Conexión de:"+' ' + moment(response.data.InicioFiltro).format("D, MMMM YYYY")+'. '+ "Hasta:" +' '+ moment(response.data.finFiltro).format("D, MMMM YYYY"),
      subcaptionFontSize: "17",
      "subcaptionFontColor": "#333333",
      "subcaptionFontBold": "0",
      xaxisname: "",
      yaxisname: "Cantidad de personas",
      "thousandSeparator": ".",
      "numberScaleValue": "1000,1000,1000",


      theme: "fusion",
      exportEnabled:1,
      "showValues": "1",
      "rotateValues": "0",
      "valueFontColor": "#000000",
      "valueBgColor": "#FFFFFF",
      "valueBgAlpha": "50",
      "borderColor": "#666666",
      "borderThickness": "4",
                /* color de fondo
                "bgColor": "#FAFAFA",
                "bgAlpha": "50",*/


              },
              data: [
              {
                label: "Femino",
                value: response.data.femenino
              },
              {
                label: "Masculino",
                value: response.data.masculino
              },
              {
                label: "LGTBI",
                value: response.data.lgtbi
              },
              {
                label: "Otro",
                value: response.data.otro
              },


              ],

            };


          }
          else{


            this.verGenero=false;
            this.verEdad=false;
            this.verPoblacion=false;
            this.verHorario=false;
            this.verBarrio=false;

          }
          this.isLoading = false;

        }) .catch(error => {
         this.isLoading = false;
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

      }

    },
    computed: {

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
