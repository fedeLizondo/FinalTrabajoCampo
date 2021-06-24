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
            <button class="btn btn-primary" @click="createProyecto">
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
              class="card m-1"
              style="width: 18rem"
              v-for="(proyecto, index) in proyectos"
              :key="index"
            >
              <div class="card-body d-flex">
                <router-link
                  :to="'/proyecto/' + proyecto.proyecto_id"
                  class="mr-auto"
                >
                  <div>
                    <h5>{{ proyecto.nombre }}</h5>
                  </div>
                </router-link>

                <button
                  id="editActor"
                  type="button"
                  class="close mx-1"
                  aria-label="Update"
                  style="color: #e67e22"
                  v-on:click="toggleUpdate(proyecto)"
                >
                  <font-awesome-icon :icon="['fas', 'edit']" />
                </button>
                <button
                  type="button"
                  class="close"
                  aria-label="Close"
                  style="color: #e74c3c"
                  v-on:click="deleteProyecto(proyecto)"
                >
                  <font-awesome-icon :icon="['fas', 'times']" />
                </button>
              </div>
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
              class="card m-1"
              style="width: 18rem"
              v-for="(favorito, index) in favoritos"
              :key="index"
            >
              <div class="card-body d-flex">
                <div class="mr-auto">
                  <router-link :to="'/proyecto/' + favorito.proyecto_id">
                    {{ favorito.nombre }}
                  </router-link>
                </div>

                <button
                  type="button"
                  class="close"
                  aria-label="Close"
                  style="color: #e74c3c"
                  v-on:click="deleteFav(favorito, index)"
                >
                  <font-awesome-icon :icon="['fas', 'times']" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <proyecto-modal-component
      ref="proyectoModal"
      :user_id="this.user_id"
      :proyecto="this.proyecto"
      :proyectos="this.proyectos"
      :isUpdate="this.editMode"
    />
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
      editMode: false,
      proyecto: {
        id: "",
        nombre: "",
        user_id: "",
      },
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
      this.editMode = false;
      this.proyecto = {
        id: "",
        nombre: "",
        user_id: "",
      };
      this.$refs.proyectoModal.openModal();
    },
    deleteProyecto: function (proyecto) {
      //TODO ELIMINAR PROYECTO
    },
    toggleUpdate: function (proyecto) {
      //TODO UPDATE PROYECTO
    },
    deleteFav: function (favorito, index) {
      this.favoritos.splice(index, 1);

      axios.delete(
        BASE_URL + "/api/user/" + this.user_id + "/favorito/" + favorito.id
      );
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