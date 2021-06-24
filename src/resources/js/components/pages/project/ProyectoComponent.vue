<template>
  <div class="row h-100">
    
    <h1 class="col-12 text-center">{{ proyecto.nombre }}</h1>
    <div class="col-md-6 col-lg-3 mt-2">
      <actor-list-component :proyecto_id="$route.params.id" />
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <diagrama-list-component :proyecto_id="$route.params.id"/>
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <especificacion-list-component :proyecto_id="$route.params.id"/>
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
import EspecificacionListComponent from "./Especificacion/EspecificacionListComponent.vue"
import DiagramaListComponent from './Diagrama/DiagramaListComponent.vue';

export default {
  components: { MessageComponent, ActorListComponent, EspecificacionListComponent, DiagramaListComponent },
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
      proyecto: {
        id: 0,
        nombre: "Ocurrio un error",
      },
      favoritos: []
    };
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
        BASE_URL + "/api/proyecto/" + this.$route.params.id
      );
      response.then((res) => (this.proyecto = res.data.data));
    }
  },
  mounted() {
    this.getEspecificacion();
    this.getDiagrama();
    this.getProyecto();
    this.getFavoritos();
  },
};
</script>

<style>
</style>