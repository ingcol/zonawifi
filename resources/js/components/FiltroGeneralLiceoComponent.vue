<template>
	<div class="main-content">

    <div  class="contenedor-home  shadow-sm">
      <div class="container-fluid">
        <div class="page-header">
          <div class="row">
            <div class="col-md-6">

              <div class="widget  border-home-green">
                <div class="widget-body">
                  <div class="">
                    <div class="state">
                      <h6 class="text-center">Conexión total </h6>
                      <h4 class="text-center" v-text="totalConexion"></h4>
                    </div>
                  </div>

                </div>

              </div>
              
            </div>
            <div class="col-md-6">
             <div class="widget border-home-orange">
              <div class="widget-body">
                <div class="">
                  <div class="state">
                    <h6 class="text-center">Dispositivos </h6>
                    <h4 class="text-center" v-text="totalDispositivo"></h4>
                  </div>
                </div>

              </div>

            </div>


          </div>
        </div>

      </div>
    </div>

  </div>
  <br>
  <div  class="contenedor-home shadow-sm">
   <div class="container-fluid">
    <div class="page-header">
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
          <option value="2">Grado</option>
          <option value="4">Sede</option>
          <option value="5">Horario de conexión</option>
          <option value="6">Género</option>
        </select>
      </div>
    </div>
    <div class="text-center bg-fa p-3  border">
     <a  @click="getFiltro"  class=" btn-standar border-0 font-weight-bold text-white bg-success mt-1"><i class="ik filter
      ik-filter"></i>
    Filtrar datos</a>
  </div>
  <hr>

</div>
</div>

</div>
<br>
<div  class="contenedor-home"  v-if="filtroDiv">
  <div class="row mt-4 mb-4  p-3 bg-white"  v-if="verGrado" >
    <div class="col-md-12">
     <fusioncharts
     :type="tipoEdad"
     :width="width"
     :height="height"
     :dataformat="dataFormat"
     :dataSource="dataGrado"

     >
   </fusioncharts>

 </div>

</div>



<div class="row mt-4 mb-4 p-3 bg-white" v-if="verZona">
  <div class="col-md-12">
   <fusioncharts
   :type="tipoZona"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataZona"

   >
 </fusioncharts>

</div>
</div>


<div class="row mt-4 mb-4  p-3 bg-white"  v-if="verHorario" >
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
<loading :active.sync="isLoading"
:can-cancel="false"></loading>
</div>
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

        this.getDatos();

      },
      data() {


        return {
          filtroDiv:false,
           //show filter
           verGenero:false,
           verGrado:false,
           verHorario:false,
           verZona:false,

           type: "column3d",
           renderAt: "chart-container",
           width: "100%",
           height: "350",
           dataFormat: "json",
          //eda
          tipoEdad: "column2d",

          //
          datacollection: {},
          //Data chart
          dataGenero:{},
          dataEdad:{},
          dataPoblacion:{},
          dataZona:{},
          dataHorario:{},
          dataGrado:{},

          height:"680",

          tipoZona: "bar2d",


          //
          isLoading:false, 
          totalDispositivo:0,
          totalConexion:0,
          totalZonaConectado:0,
          fechaInicio:'',
          fechaFin:'',
          filtrarDatos:'',
          nextMonthCaption:  'Sig mes',
          prevMonthCaption:'Ant mes',
          weekdays: [
          'lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab', 'Dom'
          ],
          months: [
          'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
          ]
        }
      },

      methods: {

       getDatos() {
        axios.get('/api/filtroGeneralLiceoDatos')
        .then(response => {
         this.totalDispositivo=response.data.totalDispositivo
         this.totalConexion=response.data.totalConexion
       })
        .catch(errors => {
          console.log(errors);
        });
      },
      getFiltro(){


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

      let url = 'api/filtroGeneralLiceo';
      axios.get(url, {

        params: {
         fechaInicio: this.fechaInicio,fechaFin: this.fechaFin,filtrarDatos:this.filtrarDatos}

       }).then(response => {
        this.isLoading = false;
        this.filtroDiv=true


        //Grado
       if (response.data.filtro==2) {
          this.verGenero=false;
          this.verGrado=true;
          this.verHorario=false;
          this.verZona=false;

          this.dataGrado={
            chart: {
              caption: "Conexión por grados " + '( Total:' +' '+ response.data.totalGrado +' '+ ')',

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
              paletteColors: '#FF5733,#f2c500,,#e6e6e6,#8944CE,#1C95BF,#5F1CBF,#ff0000,#FF4433,#f1c5C0,#681D0D,#4966CE,#339aac,#4f399c,#ff0000'
              ,


            },
            data: [
            
            {
              label: "Primero",
              value: response.data.gradoPrimero
            },
            {
              label: "Segundo",
              value: response.data.gradoSegundo
            },
            {
              label: "Tercero",
              value: response.data.gradoTercero
            },
            {
              label: "Cuarto",
              value: response.data.gradoCuarto
            },
            {
              label: "Quinto",
              value: response.data.gradoQuinto
            },
            {
              label: "Sexto",
              value: response.data.gradoSexto
            },
            {
              label: "Séptimo",
              value: response.data.gradoSeptimo
            },
            {
              label: "Octavo",
              value: response.data.gradoOctavo
            },
            {
              label: "Noveno",
              value: response.data.gradoNoveno
            },
            {
              label: "Décimo",
              value: response.data.gradoDecimo
            },
            {
              label: "Once",
              value: response.data.gradoOnce
            },
            



            ],

          };


        }



        //Zona
        else if (response.data.filtro==4) {

          this.verGenero=false;
          this.verGrado=false;
          this.verHorario=false;
          this.verZona=true;
          this.dataZona= {
            chart: {
              caption: "Conexión por sede " + '( Total:' +' '+ response.data.totalZona +' '+ ')',
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
              paletteColors: '#0075c2,#1aaf5d,#f2c500,#FF5733,#681D0D,#8944CE,#1C95BF,#5F1CBF,#ff0000',

            },
            data: [
            {
              label: "Sede Principal",
              value: response.data.zonaUno
            },
            {
              label: "Sede Primaria",
              value: response.data.zonaDos
            },
            {
              label: "Sede Simón Bolivar",
              value: response.data.zonaTres
            },
            {
              label: "Sede San Pablo",
              value: response.data.zonaCuatro
            },
            {
              label: "Sede Bello Oriente",
              value: response.data.zonaCinco
            },
            {
              label: "Sede Granja",
              value: response.data.zonaSeis
            }
            ],

          };
        }

        else if (response.data.filtro==5) {
          this.verGenero=false;
          this.verGrado=false;
          this.verHorario=true;
          this.verZona=false;

          this.dataHorario={
            chart: {
              caption: "Horario de conexión " + '( Total:' +' '+ response.data.totalNavegacionHora +' '+ ')',

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
          this.verGrado=false;
          this.verHorario=false;
          this.verZona=false;
  //Género
  this.dataGenero= {
    chart: {
      caption: "Conexión por género " + '( Total:' +' '+ response.data.totalGenero +' '+ ')',

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
              }
              


              ],

            };


          }
          else {
          this.verGenero=true;
          this.verGrado=true;
          this.verHorario=true;
          this.verZona=true;
          this.dataGenero= {
    chart: {
      caption: "Conexión por género " + '( Total:' +' '+ response.data.totalGenero +' '+ ')',

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
              }
              


              ],

            };
            this.dataHorario={
            chart: {
              caption: "Horario de conexión " + '( Total:' +' '+ response.data.totalNavegacionHora +' '+ ')',

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
          this.dataZona= {
            chart: {
              caption: "Conexión por sede " + '( Total:' +' '+ response.data.totalZona +' '+ ')',
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
              paletteColors: '#0075c2,#1aaf5d,#f2c500,#FF5733,#681D0D,#8944CE,#1C95BF,#5F1CBF,#ff0000',

            },
            data: [
            {
              label: "Sede Principal",
              value: response.data.zonaUno
            },
            {
              label: "Sede Primaria",
              value: response.data.zonaDos
            },
            {
              label: "Sede Simón Bolivar",
              value: response.data.zonaTres
            },
            {
              label: "Sede San Pablo",
              value: response.data.zonaCuatro
            },
            {
              label: "Sede Bello Oriente",
              value: response.data.zonaCinco
            },
            {
              label: "Sede Granja",
              value: response.data.zonaSeis
            }
            ],

          };
           this.dataGrado={
            chart: {
              caption: "Conexión por grados " + '( Total:' +' '+ response.data.totalGrado +' '+ ')',

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
              paletteColors: '#FF5733,#f2c500,,#e6e6e6,#8944CE,#1C95BF,#5F1CBF,#ff0000,#FF4433,#f1c5C0,#681D0D,#4966CE,#339aac,#4f399c,#ff0000'
              ,


            },
            data: [
            
            {
              label: "Primero",
              value: response.data.gradoPrimero
            },
            {
              label: "Segundo",
              value: response.data.gradoSegundo
            },
            {
              label: "Tercero",
              value: response.data.gradoTercero
            },
            {
              label: "Cuarto",
              value: response.data.gradoCuarto
            },
            {
              label: "Quinto",
              value: response.data.gradoQuinto
            },
            {
              label: "Sexto",
              value: response.data.gradoSexto
            },
            {
              label: "Séptimo",
              value: response.data.gradoSeptimo
            },
            {
              label: "Octavo",
              value: response.data.gradoOctavo
            },
            {
              label: "Noveno",
              value: response.data.gradoNoveno
            },
            {
              label: "Décimo",
              value: response.data.gradoDecimo
            },
            {
              label: "Once",
              value: response.data.gradoOnce
            },
            



            ],

          };
        }

        }).catch(error => {
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

  .home-liceo{
    background: #e6e6e6;
  }
  .contenedor-home {
    background: white;
    padding: 15px;
    margin: 0 5px 0 5px;
  }
</style>

