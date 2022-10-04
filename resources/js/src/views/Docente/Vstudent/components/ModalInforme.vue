<template>
  <b-modal
    id="modal-1"
    title="Informe Estudiantes"
    hide-footer
    v-model="show"
    size="lg"
  >
    <!--  ok-title="Accept"     size="lg" -->
    <b-form @submit.prevent>  
          <b-row>
            <b-col md="12">
              <b-form-group label="Seccion" >
                <v-select
                  v-model="selected"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="option"
                />
              </b-form-group>
            </b-col>
            <b-col md="3">
              <b-form-group label="Tipo Infrome" >
                <v-select
                  v-model="selected"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="option"
                />
              </b-form-group>
            </b-col>
            <b-col md="3">
              <b-form-group label="Ordenamiento">
              <v-select
                  v-model="selected"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="option"
                />
              </b-form-group>
            </b-col>
            <b-col md="3">
              <b-form-group label="Año Electivo" >
                <b-form-input />
              </b-form-group>
            </b-col>                          

         
          </b-row>
          <hr>
          <b-row>
             <b-col md="12">
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                type="submit"
                variant="primary"
                class="mr-1"
              >
                Aceptar
              </b-button>
              <b-button
                v-ripple.400="'rgba(186, 191, 199, 0.15)'"
                variant="outline-secondary"
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
export default {
  components: { vSelect, Cleave },
  directives: { Ripple },
  data() {
    return {
      show: false,
      selected: { title: "Square" },
      fecha: null,
      option: [
        { title: "Opcion 1" },
        { title: "Opcion 2" },
        { title: "Opcion 3" },
        { title: "Opcion 4" },
      ],
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
    EventBus.$on("ModalInforme", (id) => {
      this.show = true;
    });
  },
  methods: {},
};
</script>

<style>
</style>