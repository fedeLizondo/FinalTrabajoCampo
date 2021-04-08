<template>
  <div class="row h-100">

    <div class="col-md-6 col-lg-3 mt-2">
      <div class="card">
        <div class="card-header">
          Actores
          <button class="btn btn-primary" @click="createActor">crear</button>
        </div>
        <div class="card-body">
          <div id="container">
            <div
              id="row"
              class="shadow-sm row rounded"
              v-for="actor in actores"
              :key="actor.id"
            >
              {{ actor.nombre }}
              <button class="btn btn-warning" @click="this.$refs.modalActor.openModal();">modificar</button>
              <button class="btn btn-danger">eliminar</button>
            </div>
          </div>
        </div>
      </div>
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
      <message-component :proyecto_id="this.proyecto_id" />
    </div>

    <modal-component ref="modalActor">
      <template v-slot:header>
        <h3>Confirmar datos</h3>
      </template>

      <template v-slot:body>
       Es un Mensaje
      </template>

      <template v-slot:footer>
        <div class="d-flex align-items-center justify-content-between">
          <button
            class="btn btn-danger"
            @click="$refs.modalClient.closeModal()"
          >
            Salir
          </button>
          <button
            class="btn btn-success"
            @click="actualizarCliente"
            :disabled="!isValidClienteForPedido"
          >
            Confirmar <font-awesome-icon :icon="['fas', 'dolly']" />
          </button>
        </div>
      </template>
    </modal-component>

  </div>
</template>

<script>
import MessageComponent from "../../MessageComponent.vue";
import { BASE_URL } from "../../../constants/constants.js";
import ModalComponent from '../../assets/ModalComponent.vue';
export default {
  components: { MessageComponent, ModalComponent },
  props: ["proyecto_id"],
  data() {
    return {
      actor: {},
      especificacion: {},
      diagrama: {},
      actores: [],
      especificaciones: [],
      diagramas: [],
    };
  },
  methods: {
    getActor: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor"
      );
      this.actores = response.data;
    },
    updateActor: function ($actor) {
      const response = axios.put(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor/" + $actor.id,
        $actor
      );
    },
    deleteActor: function ($actor) {},
    getDiagrama: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/diagrama"
      );
      this.diagramas = response.data;
    },
    getEspecificacion: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/especificacion"
      );
      this.especificaciones = response.data;
    },
    createActor: function () {
      this.$refs.modalActor.openModal();
    }
  },
  mounted() {
    this.getActor();
    this.getEspecificacion();
    this.getDiagrama();
  },
};
</script>

<style>
</style>