<template>
  <div>
    <b-card no-body>
      <div class="m-2">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-between flex-wrap">
            <div>          
           
               <b-button
                size="sm"
                variant="info"
                class="mr-1"
                @click="modalNotificacion()"
              >
                <b-icon icon="plus-circle" aria-hidden="true"></b-icon> Agregar Notificacion
              </b-button>
             
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
            <b-badge pill variant="light-warning"> Interno </b-badge>
          </template>
          <template v-else>
            <b-badge pill variant="light-success"> Malla </b-badge>
          </template>
        </template>

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <div class="text-nowrap">
            <feather-icon
              :id="`invoice-row-${data.item.id}-send-icon`"
              icon="EditIcon"
              class="cursor-pointer"
              size="16"
            
            />
            <b-tooltip
              title="Editar"
              class="cursor-pointer"
              :target="`invoice-row-${data.item.id}-send-icon`"
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
              v-on:input="Listvsnotify"
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

     <modal-notify/>

  </div>
</template>

<script>
import { avatarText } from "@core/utils/filter";
import vSelect from "vue-select";
import { onUnmounted, reactive, onMounted, toRefs, ref } from "@vue/composition-api";


import store from "@/store";
import useModule from "./UseModule";

//import Modules from "./Modules";
import EventBus from "@/assets/js/EventBus";

import { kFormatter } from "@core/utils/filter";
import ModalNotify from "./components/ModalNotify";
const axios = require("axios").default;

export default {
  components: {
    vSelect,
   
 
    ModalNotify
 
  },
  setup() {
    const MODULE_NAME = "vsnotify";
    const state = reactive({
      items: [],
      model: {},
      data: {},
      perPage: ref(1),
      currentPage: ref(1),
      total_pages: ref(0),
    });
   

    onUnmounted(() => {
      if (store.hasModule(MODULE_NAME))
        store.unregisterModule(MODULE_NAME);
    });
    onMounted(() => {
      Listvsnotify()
    });

    const statusOptions = ["Opcion 1", "Opcion 2", "Opcion 3"];
    const Listvsnotify = () => {
      let a = "";
      let sea = "";
      let search = a == "" ? "all" : sea;
      let url = "/vsnotify/records/" + search + "?page=" + state.currentPage;
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
    const modalNotificacion = (id) => {
      EventBus.$emit("ModalNotify", null);
    };
    const viewFicha = (id) => {};

    const exportExcel = () => {
   
    };
    const exportPdf = () => {
     
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
    
      searchTerm,
      Listvsnotify,
      modalNotificacion
    
  
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
