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
              <div class="card" style="width: 18rem">
                <div class="card-body">
                  <h5 class="card-title">{{ proyecto.nombre }}</h5>
                  <a href="/proyecto/1" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h2>Listado para Proyectos</h2>
    <ul>
      <li><router-link to="/proyecto/1"> Ir a proyecto 1</router-link></li>
    </ul>
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
        //BASE_URL + "/api/"+this.user_id +"/proyecto"
        BASE_URL + "/api/user/1/proyecto"
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