<template>
  <div>
    <div id="accordion-proyectos">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            Proyectos
            <button
              class="btn btn-link"
              data-toggle="collapse"
              data-target="#accordion-body"
              aria-expanded="true"
              aria-controls="accordion-body"
            >
              Ocultar
            </button>
            <button class="btn btn-primary" @click="createProyecto">crear</button>
          </h2>
        </div>

        <div
          id="accordion-body"
          class="collapse show"
          aria-labelledby="headingOne"
          data-parent="#accordion-proyectos"
        >
          <div class="card-body d-flex flex-wrap justify-content-center">
            <div
              v-for="(proyecto, index) in proyectos"
              :key="index"
              class="p-2"
            >
            <router-link :to="'/proyecto/'+ proyecto.id"> 
              <div class="card" style="width: 18rem">
                <div class="card-body">
                  <h5 class="card-title">{{ proyecto.nombre }}</h5>
                </div>
              </div>
            </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h2>Listados para Favoritos</h2>
  </div>
</template>

<script>
import { BASE_URL } from "../../../constants/constants.js";
export default {
  props: ["user_id"],
  data() {
    return {
      proyectos: [],
      favoritos: [],
    };
  },
  methods: {
    getProyectos: async function () {
      const response = axios.get(
        BASE_URL + "/api/"+this.user_id +"/proyecto"
      );
      response.then((res) => (this.proyectos = res.data.data));
    },
    getFavoritos: async function () {
      const response = axios.get(
        BASE_URL + "/api/" + this.user_id + "/favorito"
      );
      response.then((res) => (this.favoritos = res.data.data));
    },
  },
  mounted() {
    this.getProyectos();
    this.getFavoritos();
  },
};
</script>

<style>
</style>