<template>
  <b-modal
    id="modal-1"
    title="Editar Personal"
    hide-footer
    v-model="show"
    size="lg"
    modal-class="modal-info"
  >
    <b-form @submit.prevent="updateFicha"  >
      <b-tabs>
        <b-tab title="Datos Personales" active>
          <b-row>
            <!-- <p>{{model}}</p> -->
            <b-col md="6">
              <b-form-group label="Condicion">
                <v-select
                  v-model="condicion"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemCondicion"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Perfil">
                <v-select
                  v-model="perfil"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemPerfil"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Apellidos">
                <b-form-input v-model="model.LAS_NM"  placeholder="Apellidos" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Nombres">
                <b-form-input v-model="model.FIR_NM"  placeholder="Nombres" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Tipo de Identificacion">
                <v-select
                  v-model="identificacion"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemIdentificacion"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Numero de Identificacion">
                <b-form-input v-model="model.IDE_NO" />
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group label="Genero">
                <v-select
                  v-model="genero"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemGenero"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Estado Civil">
                <v-select
                  v-model="estadoCivil"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemEstadoCivil"
                />
              </b-form-group>
            </b-col>         
            <b-col md="6">
              <b-form-group label="Fecha Nacimiento" >
                <cleave
                  id="date"
                  v-model="model.FECBIR" 
                  class="form-control"
                  :raw="false"
                  :options="optionsInput.date"
                  placeholder="DD-MM-YYYY"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Fecha Ingreso" >
                <cleave
                  id="date2"
                  v-model="model.FECING" 
                  class="form-control"
                  :raw="false"
                  :options="optionsInput.date"
                  placeholder="DD-MM-YYYY"
                />
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group label="Correo Electronico" >
                <b-form-input v-model="model.EMPMAI"  placeholder="Correo" />
              </b-form-group>
            </b-col>

            <!-- submit and reset -->
          </b-row>
        </b-tab>
        <b-tab title="Ubicacion">
          <b-row>
            <b-col md="6">
              <b-form-group label="Parroquia Reside" >
                <b-form-input v-model="model.PARROQ" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Ciudad Reside" >
                <b-form-input v-model="model.CIUDAD"  />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Provincia Reside" >
                <b-form-input v-model="model.PROVIN" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Pais Reside" >
                <b-form-input v-model="model.PAISES" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Direccion" >
                <b-form-textarea
                  v-model="model.ADDRES" 
                  id="textarea-default"
                  placeholder="Direccion"
                  rows="3"
                />
              </b-form-group>
            </b-col>
             <b-col md="6">
              <b-form-group  label="Telefono">
                <b-form-textarea
                  v-model="model.TPHONE" 
                  id="textarea-default"
                  placeholder="Telefono"
                  rows="3"
                />
              </b-form-group>
            </b-col>
          </b-row>
        </b-tab>
        <b-tab title="Servicios">
          <b-row>
            <b-col md="6">
              <b-form-group label="Años de Servicio" label-for="mc-city">
                <b-form-input v-model="model.SERVIC"  placeholder="Años" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Años de Magisterio" label-for="mc-country">
                <b-form-input v-model="model.MAGIST" placeholder="Magisterio" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Codigo Sectorial" label-for="mc-city">
                <b-form-input v-model="model.SECCOD"  placeholder="Codigo Sectorial" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Codigo Postal" label-for="mc-country">
                <b-form-input v-model="model.POSCOD"   placeholder="Country" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Religion" label-for="mc-country">
                <v-select
                  v-model="religion"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemReligion"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="No Cargas Familiares" label-for="mc-country">
                <b-form-input
                  v-model="model.CARGAS"
                  placeholder="No Cargas Familiares"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Titulos Obtenidos" label-for="mc-company">
                <b-form-textarea
                  v-model="model.TITULO"
                  id="textarea-default"
                  placeholder="Textarea"
                  rows="3"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group  label="Observaciones">
                <b-form-textarea
                      v-model="model.REMARK"
                  id="textarea-default"
                  placeholder="Observaciones"
                  rows="3"
                />
              </b-form-group>
            </b-col>
          </b-row>
        </b-tab>
        <b-tab title="Informacion Financiera">
          <b-row>
            <b-col md="6">
              <b-form-group label="Grupo Nomina" >
                <v-select
                  v-model="nomina"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="item_grupoNomina"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Sueldo" >
                <b-form-input v-model="model.SALARY" placeholder="Sueldo" />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="Tipo Cuenta Bancaria" >
                <v-select
                  v-model="cuenta"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="label"
                  :options="itemCuenta"
                />
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group label="No Cuenta Bancaria" label-for="mc-country">
                <b-form-input v-model="model.CTABAN"  placeholder="o Cuenta Bancaria" />
              </b-form-group>
            </b-col>
            <b-col>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                type="submit"
                variant="primary"
                class="mr-1"
              >
                Actualizar
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
        </b-tab>
      </b-tabs>
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

export default {
  components: { vSelect, Cleave },
  directives: { Ripple },
  data() {
    return {
      show: false,
      EMP_NO: null,
      selected: { title: "Square" },
      perfil: null,
      condicion: null,
      religion: null,
      cuenta: null,
      nomina: null,
      identificacion: null,
      estadoCivil: null,
      genero: null,
      model: {
          EMP_NO:null,
          LAS_NM:null,
          FIR_NM:null,
          IDTYPE:null,
          IDE_NO:null,
          CAT_NO:null,
          ADDRES:null,
          TPHONE:null,
          PARROQ:null,
          CIUDAD:null,
          PROVIN:null,
          PAISES:null,
          EMPGEN:null,
          ESTADO:null,
          FECBIR:null,
          FECING:null,
          EMPMAI:null,
          BAN_NO:null,
          CTATYP:null,
          CTABAN:null,
          SERVIC:null,
          MAGIST:null,
          SECCOD:null,
          POSCOD:null,
          EMPRLG:null,
          CARGAS:null,
          ESTATU:null,
          PROFIL:null,
          TITULO:null,
          REMARK:null,
          SALARY:null,

      },
      fecha: null,
      itemCondicion: [
        { value: "1", label: "Activo" },
        { value: "0", label: "Inactivo" },
      ],
      itemPerfil: [
        { value: "1", label: "System Manager" },
        { value: "2", label: "Autoridad" },
        { value: "3", label: "Coordinación" },
        { value: "4", label: "Secretariado" },
        { value: "5", label: "Docencia" },
        { value: "6", label: "Inspección" },
        { value: "7", label: "Cajero Facturación" },
      ],
      itemIdentificacion: [
        { value: "05", label: "Cédula" },
        { value: "04", label: "RUC" },
        { value: "06", label: "Pasaporte" },
      ],
      itemGenero: [
        { value: "1", label: "Masculino" },
        { value: "2", label: "Femenino" }, 
      ],
      itemCuenta: [
        { value: "1", label: "Ahorro" },
        { value: "2", label: "Corriente" }, 
        { value: "3", label: "Virtual" }, 
      ],
      itemEstadoCivil: [
        { value: "1", label: "Soltero" },
        { value: "2", label: "Casado" }, 
        { value: "3", label: "Divorciado" }, 
        { value: "4", label: "Viudo" }, 
        { value: "5", label: "Unión Libre" }, 
      ],
      itemReligion: [
        { value: "1", label: "Católica" },
        { value: "2", label: "Evangélica" }, 
        { value: "3", label: "Testigo de Jehová" }, 
        { value: "4", label: "Cristiana Ecuménica" }, 
        { value: "5", label: "Mormón" }, 
        { value: "6", label: "Judía" }, 
        { value: "7", label: "Musulmán" }, 
      ],
      option: [
        { title: "Opcion 1" },
        { title: "Opcion 2" },
        { title: "Opcion 3" },
        { title: "Opcion 4" },
      ],
      item_grupoNomina:[],
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
    this.tables();
    EventBus.$on("DetailFicha", (EMP_NO) => {
      this.show = true;
      this.EMP_NO = EMP_NO;
      this.infoFicha(EMP_NO);
    });

  },
  methods: {
    tables(){
      let me = this;
      let tabla='CAT';
      let url = "/vstables/records/" + tabla;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {        
        const { status, result } = response.data;
        me.item_grupoNomina=result;
      });
    },
    infoFicha(EMP_NO) {
      let me = this;
      let url = "/vsemblox/record/" + EMP_NO;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        const { status, result } = response.data;
        if (status == 200) {
          me.model = result;
          me.perfil = me.itemPerfil.find((x) => x.value == me.model.PROFIL);
          me.condicion = me.itemCondicion.find(
            (x) => x.value == me.model.ESTATU
          );
          me.identificacion = me.itemIdentificacion.find(
            (x) => x.value == me.model.IDTYPE
          );
          me.genero = me.itemGenero.find(
            (x) => x.value == me.model.EMPGEN
          );
          me.estadoCivil = me.itemEstadoCivil.find(
            (x) => x.value == me.model.ESTADO
          ); 
          me.religion = me.itemReligion.find(
            (x) => x.value == me.model.EMPRLG
          );
          me.nomina = me.item_grupoNomina.find(
            (x) => x.value == me.model.CAT_NO
          ); 
          me.cuenta = me.itemCuenta.find(
            (x) => x.value == me.model.CTATYP
          );
        }
      });
    },
    updateFicha(){
      let me =this;
      me.model.ESTATU=me.condicion.value;
      me.model.IDTYPE=me.identificacion.value;
      me.model.EMPGEN=me.genero.value;
      me.model.ESTADO=me.estadoCivil.value;
      me.model.EMPRLG=me.religion.value;
      me.model.CAT_NO=me.nomina.value;
      me.model.CTATYP=me.cuenta.value;
     let data =me.model;    
     let url = "/vsemblox/store";
      axios({
        method: "POST",
        url: url,
        data:data,
      }).then((response) => {     
        let {status,message}=response.data;
        if (status==200) {         
             EventBus.$emit("ListarFicha",null);
             me.success(message);
             me.show=false;
        }else{
             console.log("errror",response);
             me.error();
        }       
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
  },
};
</script>
<style lang="scss">
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';
</style>
