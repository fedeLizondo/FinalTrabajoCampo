<template>
  <div>
    <div id="accordion-proyectos">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0 d-flex">
            <div class="mr-auto">Proyectos</div>
            <button
              class="btn btn-link"
              data-toggle="collapse"
              data-target="#accordion-body"
              aria-expanded="true"
              aria-controls="accordion-body"
              @click="mostrarProyectos = !mostrarProyectos"
            >
              {{ mostrarProyectos ? "Ocultar" : "Mostrar" }}
            </button>
            <button class="btn btn-primary" @click="createProyecto" disabled>
              crear
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
              <router-link :to="'/proyecto/' + proyecto.proyecto_id">
                <div class="card" style="width: 18rem">
                  <div class="card-body">
                    <h5 class="card-title">{{ proyecto.nombre }}</h5>
                  </div>
                </div>
              </router-link>

              <button
              type="button"
              class="close ml-1"
              aria-label="Close"
              style="color: #e74c3c"
              v-on:click="deleteProyecto(proyecto)"
            >
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
            <button
              id="editActor"
              type="button"
              class="close"
              aria-label="Update"
              style="color: #e67e22"
              v-on:click="toggleUpdate(proyecto)"
            >
              <font-awesome-icon :icon="['fas', 'edit']" />
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="accordion-favoritos" class="mt-3">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0 d-flex">
            <div class="mr-auto">Favoritos</div>
            <button
              class="btn btn-link"
              data-toggle="collapse"
              data-target="#accordion-body2"
              aria-expanded="true"
              aria-controls="accordion-body2"
              @click="mostrarFavoritos = !mostrarFavoritos"
            >
              {{ mostrarFavoritos ? "Ocultar" : "Mostrar" }}
            </button>
          </h2>
        </div>

        <div
          id="accordion-body2"
          class="collapse show"
          aria-labelledby="headingOne"
          data-parent="#accordion-favoritos"
        >
          <div class="card-body d-flex flex-wrap justify-content-center">
            <div
              v-for="(favorito, index) in favoritos"
              :key="index"
              class="p-2"
            >
              <router-link :to="'/proyecto/' + favorito.proyecto_id">
                <div class="card" style="width: 18rem">
                  <div class="card-body">
                    <h5 class="card-title">{{ favorito.nombre }}</h5>
                  </div>
                </div>
              </router-link>

              <button
                type="button"
                class="close ml-1"
                aria-label="Close"
                style="color: #e74c3c"
                v-on:click="deleteFav(favorito)"
              >
                <font-awesome-icon :icon="['fas', 'times']" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { BASE_URL } from "../../../constants/constants.js";
export default {
  props: ["user_id"],
  data() {
    return {
      mostrarProyectos: true,
      mostrarFavoritos: true,
      proyectos: [],
      favoritos: [],
    };
  },
  methods: {
    getProyectos: async function () {
      const response = axios.get(
        BASE_URL + "/api/user/" + this.user_id + "/proyecto"
      );
      response.then((res) => (this.proyectos = res.data.data));
    },
    getFavoritos: async function () {
      const response = axios.get(
        BASE_URL + "/api/user/" + this.user_id + "/favorito"
      );
      response.then((res) => (this.favoritos = res.data.data));
    },
    createProyecto: function () {
      /* 
        this.editMode = false;
        this.diagrama = {
          type: "CU",
          nombre: "",
          descripcion: "",
          entidades: {},
          relaciones: {}
        };
        this.$refs.modalDiagrama.openModal();
      */
    },
    deleteProyecto: function(proyecto) {
      //TODO ELIMINAR PROYECTO
    },
    toggleUpdate: function(proyecto) {
      //TODO UPDATE PROYECTO
    },
    deleteFav: function (favorito) {
      //Delete favorito
    }
  },
  mounted() {
    this.getProyectos();
    this.getFavoritos();
  },
};
</script>

<style>
</style>