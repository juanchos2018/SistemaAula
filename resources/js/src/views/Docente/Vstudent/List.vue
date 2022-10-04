<template>
  <div>
    <b-card >
       <b-alert variant="primary" show>
        <div class="alert-body">
         
          <span> Ficha Estudiantil</span>
         
           <b-button
                size="sm"            
                variant="warning"
                style="float:right;margin-top:-3px; "
               
              >               
                Informe Estudiantes
            </b-button>
          
        </div>
      </b-alert>
      <div class="m-2">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-between flex-wrap">
            <div>
              <b-button
                size="sm"
                class="mr-1"
                variant="success"
                @click="exportExcel"
              >
                <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon>
                Excel
              </b-button>
              <b-button
                size="sm"
                variant="danger"
                class="mr-1"
                @click="exportPdf"
              >
                <b-icon icon="file-pdf" aria-hidden="true"></b-icon> PDF
              </b-button>

              <!-- <label>Mostrar</label>
              <v-select
                v-model="perPage"
                :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="perPageOptions"
                :clearable="false"
                class="per-page-selector d-inline-block mb-2"
              /> -->
            </div>

            <div>
              <div class="justify-content-end">
                <b-form-input
                  v-model="searchTerm"
                  placeholder="Buscar"
                  type="text"
                  class="d-inline-block"
                />
              </div>
            </div>
          </b-col>
        </b-row>
      </div>

      <b-table
        ref="refInvoiceListTable"
        :items="items"
        responsive
        :fields="Columns"
        primary-key="id"
        :sort-by.sync="sortBy"
        show-empty
        empty-text="No matching records found"
        :sort-desc.sync="isSortDirDesc"
        class="position-relative"
      >
        <template #cell(IDTYPE)="data">
          <template v-if="data.value === '05'">
            <b-badge pill variant="light-success"> Cèdula </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> otro </b-badge>
          </template>
        </template>

        <template #cell(ESTATU)="data">
          <template v-if="data.value === 2">
            <b-badge pill variant="light-success"> Matriculado </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="danger"> No Matriculado </b-badge>
          </template>
        </template>
        <template #cell(actions)="data">
          <div class="text-nowrap">        
            
             <feather-icon
              :id="`invoice-row-${data.item.STD_NO}-preview-icon`"
              icon="FileMinusIcon"
              size="16"
              class="cursor-pointer"
              @click="$router.push({ name: 'apps-acta', params: { id: '5035' }})"
                     
            />
            <b-tooltip
              title="Acta de Matricula"
              :target="`invoice-row-${data.item.STD_NO}-preview-icon`"
            />
            
            <feather-icon
              :id="`invoice-row-${data.item.STD_NO}-send-icon`"
              icon="BookOpenIcon"
              class="cursor-pointer"
              size="16"
    
            />
            <b-tooltip
              title="Convenio Servicio"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.STD_NO}-send-icon`"
            />
            <!-- <input v-on:keyup.enter="onEnter(data.item.STD_NO)" /> -->
          </div>
        </template>
      </b-table>
      <div class="mx-2 mb-2">
        <b-row>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-start
            "
          >
            <span class="text-muted"
              >Mostrando {{ dataMeta.from }} a {{ dataMeta.to }} de
              {{ dataMeta.of }} registros</span
            >
          </b-col>
          <b-col
            cols="12"
            sm="6"
            class="
              d-flex
              align-items-center
              justify-content-center justify-content-sm-end
            "
          >
            <b-pagination
              v-model="currentPage"
              :total-rows="total_pages"
              :per-page="perPage"
              v-on:input="Listvssecmat"
              first-number
              last-number
              class="mb-0 mt-1 mt-sm-0"
              prev-class="prev-item"
              next-class="next-item"
            >
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>
          </b-col>
        </b-row>
      </div>
    </b-card>

    <modal-informe />
  </div>
</template>

<script>
import { avatarText } from "@core/utils/filter";
import vSelect from "vue-select";
import {
  onUnmounted,
  reactive,
  onMounted,
  toRefs,
  ref,
} from "@vue/composition-api";

import StatisticCardWithAreaChart from "@core/components/statistics-cards/StatisticCardWithAreaChart.vue";

import store from "@/store";
import useModule from "./UseModule";

import Modules from "./Modules";
import EventBus from "@/assets/js/EventBus";
import ModalInforme from "./components/ModalInforme.vue";
import { kFormatter } from "@core/utils/filter";
//import { useRouter, useRoute } from 'vue-router'
const axios = require("axios").default;

export default {
  components: {
    vSelect,
    ModalInforme,
    StatisticCardWithAreaChart,
  },
  setup() {
   // const router = useRouter()
   // const route = useRoute()
    const INVOICE_APP_STORE_MODULE_NAME = "vstudent";
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });

    if (!store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
      store.registerModule(INVOICE_APP_STORE_MODULE_NAME, Modules);

    onUnmounted(() => {
      if (store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
        store.unregisterModule(INVOICE_APP_STORE_MODULE_NAME);
    });
    onMounted(() => {
      Listvssecmat();
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const Listvssecmat = () => {
      let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vsstudent/records/" + search + "?page=" + state.currentPage;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {  
        const { result, total } = response.data;
        state.total_pages = result.pagination.total_pages;
        state.items = result.data;
     
      });
    };
    const detailMalla = (id) => {
      //  EventBus.$emit("DetailMalla", null);
    };
    const viewFicha = (id) => {};

    const exportExcel = () => {
      let url = "/vsstudent/excel/";
      window.open(url, "_blank");
    };
    const exportPdf = () => {
      let url = "/vsstudent/pdf/";
      window.open(url, "_blank");
    }
    const acta=()=>{
      console.log("click");
         //:to="{ name: 'apps-acta'}"
         router.push({name:'apps-acta'})
    }
    const searchTerm = "";
    const {
      dataMeta,

      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,
      statusFilter,
      Columns,
    } = useModule();

    return {
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,

      statusFilter,

      statusOptions,
      avatarText,
      Columns,

      ...toRefs(state),
      exportExcel,
      exportPdf,
      detailMalla,
      viewFicha,
      searchTerm,
      Listvssecmat,
      acta
    };
  },
  // mounted() {

  //   this.$http.get("/analytics/data").then((response) => {
  //     //  console.log("data:",response)
  //     this.data = response.data;
  //   });
  // },
  methods: {
    kFormatter,
    onEnter: function (id) {
      console.log("enterwe", id);
    },
    rout() {
      $router.push({
        name: "apps-invoice-preview",
        params: { id: data.item.id },
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.per-page-selector {
  width: 90px;
}

.invoice-filter-select {
  min-width: 190px;

  ::v-deep .vs__selected-options {
    flex-wrap: nowrap;
  }

  ::v-deep .vs__selected {
    width: 100px;
  }
}
a {

   text-decoration: none;
}
</style>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";
</style>
