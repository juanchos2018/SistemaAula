<template>
  <div>
    <b-card no-body>
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

              <label>Mostrar</label>
              <v-select
                v-model="perPage"
                :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="perPageOptions"
                :clearable="false"
                class="per-page-selector d-inline-block mb-2"
              />
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
        <template #cell(REGIME)="data">
          <template v-if="data.value == '1'">
            <b-badge pill variant="light-success"> Malla </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="light-warning"> Interno </b-badge>
          </template>
        </template>

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_ID}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
              @click="modalCalificacion(data.item.SEC_ID)"
            />
            <b-tooltip
              title="Editar"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.SEC_ID}-send-icon`"
            />
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
              v-on:input="vsactsav"
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

   
    <modal-calificacion />
  </div>
</template>

<script>
import { avatarText } from "@core/utils/filter";
import vSelect from "vue-select";
import { onUnmounted, reactive, onMounted, toRefs,ref } from "@vue/composition-api";



import store from "@/store";
import useModule from "./UseModule";

import Modules from "./Modules";
import EventBus from "@/assets/js/EventBus";
import ModalCalificacion from "./components/ModalCalificacion.vue";
import { kFormatter } from "@core/utils/filter";
const axios = require("axios").default;

export default {
  components: {
    vSelect,
    ModalCalificacion 
  },
  setup() {
    const INVOICE_APP_STORE_MODULE_NAME = "vssecmat";
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });

    // Register module
    if (!store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
      store.registerModule(INVOICE_APP_STORE_MODULE_NAME, Modules);

    onUnmounted(() => {
      if (store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
        store.unregisterModule(INVOICE_APP_STORE_MODULE_NAME);
    });
    onMounted(() => {
      
      vsactsav()
      //   console.log("res we :",res);
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const vsactsav = () => {
        let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vsactsav/records/" + search + "?page=" + state.currentPage;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        console.log(response);
        const { result, total } = response.data;      
       // state.rows = result.total;
        state.total_pages = result.pagination.total_pages;
        state.items = result.data;
      });
    };
    const modalCalificacion = (id) => {
      EventBus.$emit("ModalCalificacion", null);
    };
    const viewFicha = (id) => {};

    const exportExcel = () => {
      let url = "/vsactsav/excel/";
      window.open(url, "_blank");
    };
    const exportPdf = () => {
      let url = "/vsactsav/pdf/";
      window.open(url, "_blank");
    };
    const searchTerm = "";
    const {

    
      totalInvoices,
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,

      statusFilter,

      refetchData,

      Columns,
     
      asignatura,
      regimens,
      ordens,
    } = useModule();

    return {
    
      totalInvoices,
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refInvoiceListTable,

      statusFilter,

      refetchData,

      statusOptions,

      avatarText,

      Columns,
     
      asignatura,
      regimens,
      ordens,
      ...toRefs(state),
      exportExcel,
      exportPdf,
      modalCalificacion,
      viewFicha,
      searchTerm,
      vsactsav
    };
  },
  mounted() {
    //this.vsemblox();
    this.$http.get("/analytics/data").then((response) => {
      //  console.log("data:",response)
      this.data = response.data;
    });
  },
  methods: {
    kFormatter,
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
</style>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";
</style>
