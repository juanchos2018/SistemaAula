<template>
  <b-card >
    <b-row class="pb-10">
      <b-card-text class="font-weight-bold mb-2 ml-1">
        {{ title }}
      </b-card-text>
    </b-row>

    <b-row class="avg-sessions" v-for="item in asignatura" :key="item.nombre">
      <b-col cols="12" class="mb-1">
        <div class="d-flex justify-content-between align-items-center">
          <b-card-text>
            {{ item.nombre }}
          </b-card-text>
          <h4 class="font-weight-bolder mb-0">
            {{ item.cantidad }}
          </h4>
        </div>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import Ripple from "vue-ripple-directive";
import { $themeColors } from "@themeConfig";
import { kFormatter } from "@core/utils/filter";

export default {
  components: {
    VueApexCharts,
  },
  directives: {
    Ripple,
  },

  props: {
   
    asignatura: {
      type: Array,
      default: [],
    },
    title: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      salesBar: {
        chartOptions: {
          chart: {
            sparkline: { enabled: true },
            toolbar: { show: false },
          },
          grid: {
            show: false,
            padding: {
              left: 0,
              right: 0,
            },
          },
          states: {
            hover: {
              filter: "none",
            },
          },
          colors: [
            "#ebf0f7",
            "#ebf0f7",
            $themeColors.primary,
            "#ebf0f7",
            "#ebf0f7",
            "#ebf0f7",
          ],
          plotOptions: {
            bar: {
              columnWidth: "45%",
              distributed: true,
              endingShape: "rounded",
            },
          },
          tooltip: {
            x: { show: false },
          },
          xaxis: {
            type: "numeric",
          },
        },
      },
    };
  },
  methods: {
    kFormatter,
  },
};
</script>
