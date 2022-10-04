<template>
  <div>
    <b-card>
      <b-alert variant="primary" show>
        <div class="alert-body">
          <span>Boletín por Estudiante.</span>
        </div>
      </b-alert>
      <div class="d-flex">
        <div class="p-1">
          <b-form-group label="Año Electivo" label-for="ano_electivo">
            <b-form-input id="ano_electivo" />
          </b-form-group>
        </div>
        <div class="p-1">
          <b-form-group label="Periodo Academico" style="margin-top:-6px" >
            <v-select
              v-model="selected"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              :options="option"
            />
          </b-form-group>
        </div>
        <div class="ml-auto p-2">
          <b-form-input
            v-model="searchTerm"
            placeholder="Buscar"
            type="text"
            class="d-inline-block"
          />
        </div>
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
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.SEC_ID}-preview-icon`"
              icon="FileMinusIcon"
              size="16"
              class="cursor-pointer"
              @click="modalAsistencia()"
            />
            <b-tooltip
              title="Acta de Matricula"
              :target="`invoice-row-${data.item.SEC_ID}-preview-icon`"
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
              v-on:input="Listvsabsent"
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

import store from "@/store";
import useModule from "./UseModule";

import Modules from "./Modules";
import EventBus from "@/assets/js/EventBus";

import { kFormatter } from "@core/utils/filter";

const axios = require("axios").default;

export default {
  components: {
    vSelect,
  },
  setup() {
    const INVOICE_APP_STORE_MODULE_NAME = "vslibstd";
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });
    let selected=ref(null)
    const  option= [
        { title: "Opcion 1" },
        { title: "Opcion 2" },
        { title: "Opcion 3" },
        { title: "Opcion 4" },
     ]

    if (!store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
      store.registerModule(INVOICE_APP_STORE_MODULE_NAME, Modules);

    onUnmounted(() => {
      if (store.hasModule(INVOICE_APP_STORE_MODULE_NAME))
        store.unregisterModule(INVOICE_APP_STORE_MODULE_NAME);
    });
    onMounted(() => {
      Listvsabsent();
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const Listvsabsent = () => {
      let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vslibstd/records/" + search + "?page=" + state.currentPage;
      axios({
        method: "GET",
        url: url,
      }).then((response) => {
        //   console.log(response);
        const { result, total } = response.data;
        // state.rows = result.total;
        state.total_pages = result.pagination.total_pages;
        state.items = result.data;
      });
    };
    const detailMalla = (id) => {
      //  EventBus.$emit("ModalAsistencia", null);
    };
    const viewFicha = (id) => {};
    const modalAsistencia = () => {
      EventBus.$emit("ModalAsistencia", null);
    };

    const exportExcel = () => {
      let url = "/vsabsent/excel/";
      window.open(url, "_blank");
    };
    const exportPdf = () => {
      let url = "/vsabsent/pdf/";
      window.open(url, "_blank");
    };
    const acta = () => {
      console.log("click");
      //:to="{ name: 'apps-acta'}"
      router.push({ name: "apps-acta" });
    };
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
      Listvsabsent,
      modalAsistencia,
      acta,
      selected,
      option
    };
  },

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
