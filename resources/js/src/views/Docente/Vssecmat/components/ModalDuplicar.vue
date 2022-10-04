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
              <b-form-group label="Seccion Origen" >
                <v-select
                  v-model="seccion"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="SEC_NM"
                  item-value="SEC_NO"
                  placeholder="Seleccione Seccion"
                  :options="seccions"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group label="Seleccione Destino" >
                <v-select
                  v-model="seccionEnd"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="SEC_NM"
                  item-value="SEC_NO"
                  placeholder="Seleccione Destino"
                  :options="seccions"
                />
              </b-form-group>
            </b-col>
        
            <b-col md="6">
              <b-form-group label="Año Periodo" label-for="mc-company">
                 <b-form-input v-model="model.PERIOS"  type="number" />
              </b-form-group>
            </b-col>        
          
          </b-row>
          <hr>
          <b-row >
             <b-col md="12">
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
      title:'Duplicar Reparto de Trabajo',
      name_button:'Guardar',
      seccion: null,
      seccionEnd: null,
      asignatura: null,   
      show: false,
      fecha: null,   
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
    EventBus.$on("ModalDuplicar", (SEC_ID) => {
      this.clearForm();
      this.show = true;        
    });
    this.defaultPerio();   
    this.selectVsection();  
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
     store(){
      let me =this;
      me.model.SEC_NO=me.seccion.SEC_NO;
      me.model.SEC_NO_END=me.seccionEnd.SEC_NO;
  
      let data =me.model;
      let url = "/vssecmat/vsdupmat/";     
      axios({
          method: "POST",
          url: url,
          data:data
        }).then((response) => {     
          //  console.log(response);      
             if (response.data.status==200) {      
                 me.show=false;                      
                 me.success(response.data.message);
                 EventBus.$emit("ListarMalla",null);
            }else if (response.data.status==400) {
                me.warning(response.data.message);
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
    warning(message) {
      this.$swal({
        title: 'Upps!',
        text: message,
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