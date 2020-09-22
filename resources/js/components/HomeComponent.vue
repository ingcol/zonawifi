<template>
	<div class="main-content">
    <div>
      <div class="container-fluid ">
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
                  <h6 class="text-center">Barrios alcanzados</h6>
                  <h4 class="text-center" v-text="totalBarrioConectado"></h4>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
      <div class="row mt-4 ">
        <div class="col-md-6 grafica p-4">
          <h6 class="text-center">Conexiones por meses</h6>

          <line-chart :chart-data="datacollection" :height="280":options="options" ></line-chart>
        </div>
        <div class="col-md-6 grafica p-4">
          <h6 class="text-center">Conexiones por géneros</h6>
          <line-chart :chart-data="generos" :height="280":options="options" ></line-chart>
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
    import LineChart from './LineChart.js'
    export default {
      mounted () {
        this.fillData();
        this.getGeneros();
        this.datosBeneficiario();

      },
      data() {
        return {
          datacollection: {},
          
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
        datosBeneficiario(){
          axios.get('/homeBeneficiario').then(response=>{
            this.totalConexion = response.data.totalConexion;
            this.totalBarrioConectado=response.data.totalBarrioConectado;
            this.totalDispositivo=response.data.totalDispositivo;
          })

        },
        fillData ()
        {
          axios.get('homeGrafica').then(response=>{
           this.datacollection = {
            labels: response.data.meses,

            datasets: [
            {
              label: "Conexiones por mes",
              fill: true,
              borderColor: "orange",
              pointRadius: 3,
              borderWidth: 2,
              backgroundColor:"rgba(79, 44, 51, 0.1)",

              data: response.data.personas
            },
            ]
          }
        });
        },
        getGeneros ()
        {
          this.isLoading = true;
          axios.get('homeGrafica').then(response=>{
            this.isLoading = false;
           this.generos = {
            labels: response.data.generos,

            datasets: [
            {
              label: "Conexiones por género",
              fill: true,
              borderColor: "#F22613",
              pointRadius: 3,
              borderWidth: 2,
              backgroundColor:  "rgba(47, 170, 176, 0.4)",
              data: response.data.cantidadGenero
            },
            ]
          }
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


