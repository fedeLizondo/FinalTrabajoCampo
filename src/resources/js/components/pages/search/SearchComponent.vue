<template>
  <div class="container-fluid">
    <div class="card sticky-top">
      <!-- Search box -->
      <div class="row">
        <div class="col-12">
          <div class="input-group">
            <input
              class="form-control ds-input"
              type="text"
              placeholder="Ingrese nombre del proyecto"
              v-model.trim="inputText"
              v-on:input="update($event.target.value)"
            />
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">
                <font-awesome-icon :icon="['fas', 'search']" />
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- List of elements -->
    <div class="card">
      <p
        v-if="seleccionados.length === 0"
        class="text-muted h2 text-center align-middle m-5"
      >
        No hay proyectos que contenga {{ inputText }}
        <font-awesome-icon :icon="['fas', 'exclamation']" />
      </p>

      <div v-else class="card-body">
        <proyecto-row-component
          v-for="(item, index) in seleccionados"
          :key="index"
          :item="item"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ProyectoRowComponent from "./ProyectoRowComponent.vue";
import { BASE_URL } from "../../../constants/constants.js";
export default {
  props:["user_id"],
  components: { ProyectoRowComponent },
  data() {
    return {
      seleccionados: [],
      //showOptionsList: false,
      selectedItem: null,
      inputText: this.$route.query.search || "",
    };
  },
  methods: {
    update: async function (value) {
      //this.showOptionsList = value.length > 0;

      const response = axios.get(
        BASE_URL + "/api/proyecto?search=" + this.inputText + "&page=1"
      );
      response.then((res) => (this.seleccionados = res.data.data));
    },

    getProyectos: async function () {
      if(!this.inputText){
        const response = axios.get(BASE_URL + "/api/proyecto");
        response.then((res) => (this.seleccionados = res.data.data));
      }else{
        this.update();
      }
      
    },
  },
  mounted() {
    this.getProyectos();
  },
};
</script>

<style>
</style>