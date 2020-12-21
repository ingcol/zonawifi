<template>
	<div class="main-content">
    <div>
      <div class="container-fluid pt-3">

        <h4 class="text-center">Estadística zonas wifi de Tame </h4>
        <hr>
        <div class="row pt-4 bg-white">

         <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="widget   bg-home border-home-green" >
            <div class="widget-body">



             <div >
              <div class="state">
                <h6 class="text-dark text-center">Total conexiones</h6>
                <h4 class="text-center" v-text="totalConexion"></h4>
              </div>
            </div>

          </div>

        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="widget bg-home border-home-orange">
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
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="widget bg-home border-home-blue">
          <div class="widget-body">
            <div >
              <div class="state">
                <h6 class="text-center">Zonas conectadas</h6>
                <h4 class="text-center" v-text="totalBarrioConectado"></h4>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
    <div class="row mt-4 mb-4 p-3 bg-white">
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
 <div class="row mt-4 mb-4 p-3 bg-white">
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
<div class="row mt-4 mb-4 p-3 bg-white">
  <div class="col-md-12">
   <fusioncharts
   :type="tipoBarrio"
   :width="width"
   :height="heightBarrio"
   :dataformat="dataFormat"
   :dataSource="dataBarrio"

   >
 </fusioncharts>

</div>
</div>

<div class="row mt-4 mb-4  p-3 bg-white">
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

<div class="row mt-4 mb-4  p-3 bg-white">
  <div class="col-md-12">
   <fusioncharts
   :type="type"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataOcupacion"

   >
 </fusioncharts>

</div>
</div>

<div class="row mt-4 mb-4  p-3 bg-white">
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
<!--
<div class="row mt-4 mb-4  p-3 bg-white">
  <div class="col-md-12 p-4">
    <h5 class="text-center">Conexión por mes</h5>
    <line-chart :chart-data="datacollection" :height="100":options="options" ></line-chart>
  </div>
</div>
-->


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
    import LineChart from './LineChart.js'
    export default {
      mounted () {


        this.getDatos();



      },
      data() {
        return {

          //Grafica 
          type: "column3d",
          renderAt: "chart-container",
          width: "100%",
          height: "350",
          dataFormat: "json",
          //eda
          tipoEdad: "column2d",
          heightBarrio: "680",

          tipoBarrio: "bar2d",


          
          

          //
          datacollection: {},
          //Data chart
          dataGenero:{},
          dataEdad:{},
          dataPoblacion:{},
          dataBarrio:{},
          dataHorario:{},
          dataOcupacion:{},



          
          altura:'280',

          //loading
          isLoading: false,
          totalConexion:'',
          totalBarrioConectado:'',
          totalDispositivo:'',

          generos:{},
          options: {
            legend: {
              display: false
            }
          },

        }
      },
      components: {
        LineChart,
        Loading
      },
      methods: {

        getDatos(){
         this.isLoading = true;
         axios.get('api/graficaGeneralTame').then(response=>{

           this.totalConexion = response.data.totalConexion;
           this.totalBarrioConectado=response.data.totalBarrioConectado;
           this.totalDispositivo=response.data.totalDispositivo;
           this.dataOcupacion= {
            chart: {
              caption: "Conexión por ocupación",

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
                paletteColors: '#b19a26,#FF5733,#1aaf5f,#f2c500,#681D0D,#8944CE,#1C95BF',


              },
              data: [
              {
                label: "Amas de casa",
                value: response.data.amaDeCasa
              },
              {
                label: "Estudiantes",
                value: response.data.estudiante
              },
              {
                label: "Desempleados",
                value: response.data.desempleado
              },
              {
                label: "Empleados",
                value: response.data.empleado
              },
              {
                label: "Empresarios",
                value: response.data.empresario
              },
              {
                label: "Independientes",
                value: response.data.independiente
              },
              {
                label: "Otro",
                value: response.data.otroPersona
              },


              ],

            };
            //GÉNEROS
            this.dataGenero= {
              chart: {
                caption: "Conexión por género",

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
                paletteColors: '#1C95BF',


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
            //POBLACIÓN
            this.dataPoblacion= {
              chart: {
                caption: "Conexión por tipo de población",

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
                paletteColors: '#5F1CBF,#FF5733,#1aaf5f,#f2c500,#681D0D,#8944CE,#1C95BF',


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
          //BARRIOS
          this.dataBarrio= {
            chart: {
              caption: "Conexión por zona",

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
          //HORARIOS
          this.dataHorario= {
            chart: {
              caption: "Horario de conexión",

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
          this.isLoading = false;
        }).catch(errors => {
    this.isLoading = false
  })

},







}
};
</script>
<style>
.bg-home{
  background: #fafafa; box-shadow: none;
  color:#222;
}
.bg-home h6{
  color:#222;
  font-weight: normal;
  font-size: 18px;
  padding-bottom: 5px
}
.bg-home h4{
  color:#222 !important;
}
.grafica {
  background-color: white;
}
</style>


