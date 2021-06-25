<template>
  <div class="row h-100">
    <div class="col-12 text-center ">
      <div class="d-flex align-items-center">
      <h1 class="mr-auto">
        {{ proyecto.nombre }}
      </h1>
      <favoritos-component
        :user_id="user_id"
        :proyect_id="$route.params.id"
        :favs="userFavs"
      />
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <actor-list-component
        :proyecto_id="$route.params.id"
        :canUpdate="canUpdate"
      />
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <diagrama-list-component
        :proyecto_id="$route.params.id"
        :canUpdate="canUpdate"
      />
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <especificacion-list-component
        :proyecto_id="$route.params.id"
        :canUpdate="canUpdate"
      />
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <message-component :proyecto_id="$route.params.id" :user_id="user_id" />
    </div>
  </div>
</template>

<script>
import MessageComponent from "../../MessageComponent.vue";
import { BASE_URL } from "../../../constants/constants.js";
import ActorListComponent from "./Actor/ActorListComponent.vue";
import EspecificacionListComponent from "./Especificacion/EspecificacionListComponent.vue";
import DiagramaListComponent from "./Diagrama/DiagramaListComponent.vue";
import FavoritosComponent from "../../FavoritosComponent.vue";

export default {
  components: {
    MessageComponent,
    ActorListComponent,
    EspecificacionListComponent,
    DiagramaListComponent,
    FavoritosComponent,
  },
  props: ["proyecto_id", "user_id"],
  data() {
    return {
      actor: {
        nombre: "test",
        descripcion: "",
      },
      especificacion: {},
      diagrama: {},
      actores: [],
      especificaciones: [],
      diagramas: [],
      grupo: [],
      proyecto: {
        id: 0,
        nombre: "Ocurrio un error",
      },
      favoritos: [],
      userFavs: [],
    };
  },
  computed: {
    canUpdate() {
      if (!Boolean(this.user_id)) return false;
      return this.grupo.some((x) => x.user_id == this.user_id);
    },
  },
  methods: {
    getDiagrama: async function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id + "/diagrama"
      );
      response.then((res) => (this.diagramas = res.data.data));
    },
    getEspecificacion: async function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id + "/especificacion"
      );

      response.then((res) => (this.especificaciones = res.data.data));
    },
    getProyecto: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id
      );
      response.then((res) => (this.proyecto = res.data.data));
    },
    getFavoritos: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id + "/favorito"
      );
      response.then((res) => (this.favoritos = res.data.data));
    },
    getUserFavs: function () {
      if (!Boolean(this.user_id)) return;
      const response = axios.get(
        BASE_URL + "/api/user/" + this.user_id + "/favorito"
      );
      response.then((res) => (this.userFavs = res.data.data));
    },
    getGrupo: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id + "/grupo"
      );
      response.then((res) => (this.grupo = res.data.data));
    },
  },
  mounted() {
    this.getEspecificacion();
    this.getDiagrama();
    this.getProyecto();
    this.getFavoritos();
    this.getGrupo();
    this.getUserFavs();
  },
};
</script>

<style>
</style>