<template>
	<div class="main-content">
    <div>
      <div class="container-fluid pt-3">

        <h4 class="text-center">Estadística zonas wifi P/Rondón</h4>
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
                <h6 class="text-center">Barrios conectados</h6>
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
   :type="tipoEdad"
   :width="width"
   :height="height"
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
<div class="row mt-4 mb-4  p-3 bg-white">
  <div class="col-md-12">
   <fusioncharts
   :type="type"
   :width="width"
   :height="height"
   :dataformat="dataFormat"
   :dataSource="dataNacionalidad"

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


          
          

          //
          datacollection: {},
          //Data chart
          dataGenero:{},
          dataEdad:{},
          dataPoblacion:{},
          dataBarrio:{},
          dataHorario:{},
          dataOcupacion:{},
          dataNacionalidad:{},



          
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
          axios.get('api/graficaRondon').then(response=>{

            this.totalConexion = response.data.totalConexion;
            this.totalBarrioConectado=response.data.totalBarrioConectado;
            this.totalDispositivo=response.data.totalDispositivo;
            this.dataOcupacion= {
              chart: {
                caption: "Conexión por ocupación ( Total: " + response.data.totalOcupacion +  ')',

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
                value: response.data.otro
              },


              ],

            };
            this.dataNacionalidad= {
              chart: {
                caption: "Conexión nacionalidad ( Total: " + response.data.totalNacionalidad + ' '+ ')',

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
               paletteColors: '#681D0D,#8944CE,#f2c500',


              },
              data: [
              {
                label: "Colombiano",
                value: response.data.colombiano
              },
              {
                label: "Ecuatoriano",
                value: response.data.ecuatoriano
              },
              {
                label: "Venezolano",
                value: response.data.venezolano
              },
              


              ],

            };
            //Edades
            this.dataEdad= {
              chart: {
                caption: "Conexión por rango de  edad (  Total: "  +response.data.totalEdad + ' '+ ')',

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
          //Género
          this.dataGenero= {
            chart: {
              caption: "Conexión por género ( Total: " + response.data.totalGenero +' '+')',

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
                value: response.data.otroGenero
              },


              ],

            };
            //población
            this.dataPoblacion= {
              chart: {
                caption: "Conexión por tipo de población ( Total: " + response.data.totalPoblacion + ' '+')',

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
          //barrio
          this.dataBarrio= {
            chart: {
              caption: "Conexión por barrio ( Total: " + response.data.totalBarrio +' '+ ')',

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
              label: "Centro (Malecón)",
              value: response.data.barrioCentro
            },
            {
              label: "La virgen",
              value: response.data.barrioDos
            },
            {
              label: "20 de enero",
              value: response.data.barrioTres
            },
            {
              label: "Biblioteca",
              value: response.data.barrioBiblioteca
            },
            {
              label: "Barrio nuevo",
              value: response.data.barrioCinco
            },
            {
              label: "San ignacio",
              value: response.data.barrioSeis
            },
            {
              label: "Doble calzada",
              value: response.data.barrioSiete
            },
            {
              label: "Colegio la inmaculada",
              value: response.data.barrioOcho
            },
            {
              label: "Tachuelo",
              value: response.data.barrioNueve
            },
            {
              label: "El paraiso",
              value: response.data.barrioParaiso
            }




            ],

          };
          //horario
          this.dataHorario= {
            chart: {
              caption: "Horario de conexión ( Total: " + response.data.totalNavegacionHora+ ' '+ ')',

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
          this.isLoading = false
        }).catch(errors => {
          this.isLoading = false
        });


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


