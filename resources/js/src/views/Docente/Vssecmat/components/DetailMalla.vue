<template>
  <b-modal
    id="modal-1"
    :title="title"
    hide-footer
    v-model="show"
  > 
    <b-form @submit.prevent="store()">  
          <b-row>
            <b-col md="12">
              <b-form-group label="Seccion" >
                <v-select
                  v-model="seccion"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="SEC_NM"
                  item-value="SEC_NO"
                  :options="seccions"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group label="Asignatura" >
                <v-select
                  v-model="asignatura"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="MAT_NM"
                  item-value="MAT_NO"
                  :options="asignaturas"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group label="Docente" label-for="mc-city">
              <v-select
                  v-model="docente"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="LAS_NM"
                  :options="docentes"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Orden" label-for="mc-country">
                <b-form-input v-model="model.ORDERS" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Año Periodo" label-for="mc-company">
                 <b-form-input v-model="model.PERIOS"  type="number" />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group  label="Link Clase">
                <b-form-input v-model="model.CLINKS" />
              </b-form-group>
            </b-col>           

           <b-col>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                type="submit"
                variant="primary"
                class="mr-1"
              >
                {{name_button}}
              </b-button>
              <b-button
                v-ripple.400="'rgba(186, 191, 199, 0.15)'"
                variant="outline-secondary"
                @click="show=false"
              >
                Cancelar
              </b-button>
            </b-col>
          </b-row>
    
    </b-form>
  </b-modal>
</template>

<script>
import EventBus from "@/assets/js/EventBus";
import Ripple from "vue-ripple-directive";
import vSelect from "vue-select";
import Cleave from "vue-cleave-component";
import "cleave.js/dist/addons/cleave-phone.us";
const axios = require("axios").default;
const queryString = require('query-string');
export default {
  components: { vSelect, Cleave },
  directives: { Ripple },

  data() {
    return {
      title:'Nuevo Reparto',
      name_button:'Guardar',
      seccion: null,
      asignatura: null,
      docente: null,
      show: false,
      fecha: null,
      asignaturas:[],
      docentes:[],
      seccions:[],
      model:{
        EMP_NO:null,
        MAT_NO:null,
        ORDERS:null,
        PERIOS:null,
        SEC_ID:null,
        SEC_NO:null,
      },

      optionsInput: {
        creditCard: {
          creditCard: true,
        },
        date: {
          date: true,
          delimiter: "-",        
          datePattern: ["d", "m", "Y"],
        },
      },
    };
  },
  computed: {},
  mounted() {
    EventBus.$on("DetailMalla", (SEC_ID) => {
      this.clearForm();
      this.show = true;      
      if(SEC_ID) {        
        this.fntEditVssecmat(SEC_ID); 
        this.title="Editar Reparto";
        this.name_button="Actualizar";
      }else{
        this.defaultPerio();
        this.title="Nuevo Reparto";
        this.name_button="Guardar";
      }
    });
     this.selectVsection(); 
     this.selectVsemplox(); 
  },
  methods: {
      getQueryParameters() {
        return queryString.stringify({
          page: 1,
          limit: 50,       
        });
      },
      selectVsection () {
        let me =this;
        let a = "";
        let sea = "";
        let search = a == "" ? "all" : sea;
        let url = "/vsection/selectVsmatter/";
        axios({
          method: "GET",
          url: url,
        }).then((response) => {
   
          const { matter, total,secction } = response.data;  
           secction.forEach(item=>{
                me.seccions.push({SEC_NO:item.SEC_NO, SEC_NM:item.SEC_NM+'-'+item.PARALE});         
            }); 

            matter.forEach(item => {          
              me.asignaturas.push({SEC_ID:item.SEC_ID,MAT_NM:item.MAT_NM+'-'+item.REGIME+'-'+item.SEC_NM+'-'+item.PARALE,MAT_NO:item.MAT_NO});           
            });  
             
        });
    },
    selectVsemplox () {
        let me =this;      
        let url = "/vsection/selectVsemplox/";
        axios({
          method: "GET",
          url: url,
        }).then((response) => {           
            if (response.data.status==200) {
                let result =response.data.result;             
                result.forEach(item=>{
                  me.docentes.push({EMP_NO:item.EMP_NO,LAS_NM:item.LAS_NM+' '+item.FIR_NM});
                });  
            }                     
        });
     },
     clearForm(){
        this.seccion= null;
        this.asignatura= null;
        this.docente= null;      
        this.model.EMP_NO=null;
        this.model.MAT_NO=null;
        this.model.ORDERS=null;      
        this.model.SEC_ID=null;
        this.model.SEC_NO=null;   

     },
     fntEditVssecmat(SEC_ID){
        let me =this;      
        let url = "/vsection/oneVssecmat/"+SEC_ID;
        axios({
          method: "GET",
          url: url,
        }).then((response) => {     
            if (response.data.status==200) {                            
                me.model=response.data.result;    
                me.seccion=me.seccions.find(x=>x.SEC_NO==me.model.SEC_NO);
                me.asignatura=me.asignaturas.find(x=>x.SEC_ID==me.model.SEC_ID)
                me.docente=me.docentes.find(x=>x.EMP_NO==me.model.EMP_NO)
          
            }else{
              alert("no hay registrios");
            }                     
        });
     },
     store(){
      let me =this;
      me.model.SEC_NO=me.seccion.SEC_NO;
      me.model.MAT_NO=me.asignatura.MAT_NO;
      me.model.SEC_ID=me.asignatura.SEC_ID;
      me.model.EMP_NO=me.docente.EMP_NO;
      let data =me.model;
      let url = "/vssecmat/store/";     
      axios({
          method: "POST",
          url: url,
          data:data
        }).then((response) => {     
         // console.log(response);
            if (response.data.status==200) {      
                 me.show=false;                      
                 me.success(response.data.message);
                 EventBus.$emit("ListarMalla",null);
            }else if (response.data.status==400) {
                me.warning();
            }else{
               me.error();
            }                     
        });
     },
     defaultPerio(){
         let me =this;      
        let url = "/vsdefault/default/"
        axios({
          method: "GET",
          url: url,
        }).then((response) => {     
           let {result}=response.data;   
           me.model.PERIOS =  result.PERIOS; 
        });
     },
     success(message) {          
        this.$swal({
          title: 'Personal',
          text: message,
          icon: 'success',
          customClass: {
            confirmButton: 'btn btn-primary',
          },
          buttonsStyling: false,
        })
    },
    error() {
      this.$swal({
        title: 'Error!',
        text: ' Hubo  Algun error!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary',
        },
        buttonsStyling: false,
      })
    },
    warning() {
      this.$swal({
        title: 'Upps!',
        text: ' Paso Algo !',
        icon: 'warning',
        customClass: {
          confirmButton: 'btn btn-primary',
        },
        buttonsStyling: false,
      })
    },

  },
};
</script>

<style>
</style>