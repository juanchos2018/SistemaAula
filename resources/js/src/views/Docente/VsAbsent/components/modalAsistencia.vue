<template>
  <b-modal
    id="modal-1"
    title="Nueva Asistencia"
    hide-footer
    v-model="show"
    size="lg"
  >
    <b-form @submit.prevent>
      <b-row>
        <b-col md="6">
          <b-form-group label="Año Electivo" label-for="ano_electivo">
             <b-form-input id="ano_electivo"  />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Fecha Asistencia" label-for="fecha-asistencia">
             <flat-pickr
              v-model="dateDefault"
              class="form-control"
            />           
          </b-form-group>
        </b-col>
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
        <b-col md="12">
          <b-form-group label="Estudiante" label-for="mc-country">
          <v-select
              v-model="selected"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Periodo" >
            <v-select
              v-model="selected"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Tipo Falta">
            <v-select
              v-model="selected"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              :options="option"
            />
          </b-form-group>
        </b-col>

        <b-col md="12">
          <b-form-group label="Justificacion" label-for="mc-city">
              <b-form-textarea
                  id="textarea-default"
                  placeholder="Justificacion"
                  rows="3"
                />
          </b-form-group>
        </b-col>

        <b-col>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                type="submit"
                variant="primary"
                class="mr-1"
              >
                Guardar
              </b-button>
              <b-button
                v-ripple.400="'rgba(186, 191, 199, 0.15)'"
                variant="outline-secondary"
              >
                Cancelar
              </b-button>
            </b-col>

        <!-- submit and reset -->
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
import flatPickr from 'vue-flatpickr-component'
export default {
  components: { vSelect, Cleave,flatPickr },
  directives: { Ripple },
  data() {
    return {
      show: false,
      selected: { title: "Square" },
       dateDefault: null,
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
          //datePattern: ['Y', 'm', 'd'],
          datePattern: ["d", "m", "Y"],
        },
      },
    };
  },
  computed: {},
  mounted() {
    EventBus.$on("ModalAsistencia", (id) => {
      this.show = true;
    });
  },
  methods: {},
};
</script>

<style lang="scss">
@import '~@resources/scss/vue/libs/vue-flatpicker.scss';
</style>
 