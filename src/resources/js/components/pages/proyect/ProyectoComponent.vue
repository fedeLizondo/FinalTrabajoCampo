<template>
  <div class="row h-100">
    <h1 class="col-12 text-center">{{ proyecto.id + " - " + proyecto.nombre }}</h1>
    <div class="col-md-6 col-lg-3 mt-2">
      <actor-list-component :proyecto_id="proyecto_id" />
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <div class="card">
        <div class="card-header">
          Diagramas
          <button class="btn btn-primary">crear</button>
        </div>
        <div class="card-body">
          <div id="container">
            <div
              id="row"
              class="shadow-sm row rounded"
              v-for="diagrama in diagramas"
              :key="diagrama.id"
            >
              {{ actor.nombre }}
              <button class="btn btn-warning">modificar</button>
              <button class="btn btn-danger">eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <div class="card">
        <div class="card-header">
          Especificaciónes
          <button class="btn btn-primary">crear</button>
        </div>
        <div class="card-body">
          <div id="container">
            <div
              id="row"
              class="shadow-sm row rounded"
              v-for="especificacion in especificaciones"
              :key="especificacion.id"
            >
              {{ especificacion.nombre }}
              <button class="btn btn-warning">modificar</button>
              <button class="btn btn-danger">eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-2">
      <message-component :proyecto_id="this.proyecto_id" :user_id="user_id" />
    </div>
  </div>
</template>

<script>
import MessageComponent from "../../MessageComponent.vue";
import { BASE_URL } from "../../../constants/constants.js";
import ActorListComponent from "./Actor/ActorListComponent.vue";

export default {
  components: { MessageComponent, ActorListComponent },
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
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/diagrama"
      );
      response.then((res) => (this.diagramas = res.data.data));
    },
    getEspecificacion: async function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/especificacion"
      );

      response.then((res) => (this.especificaciones = res.data.data));
    },
    getProyecto: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id
      );
      response.then((res) => (this.proyecto = res.data.data));
    },
    getFavoritos: function () {
        const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id
      );
      response.then((res) => (this.proyecto = res.data.data));
    }
  },
  mounted() {
    this.getEspecificacion();
    this.getDiagrama();
    this.getProyecto();
  },
};
</script>

<style>
</style>