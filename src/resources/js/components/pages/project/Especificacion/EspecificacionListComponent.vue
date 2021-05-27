<template>
  <div class="card">
    <div class="card-header">
      Especificaciones
      <button class="btn btn-primary" @click="createActor">crear</button>
    </div>
    <ul class="list-group list-group-flush">
      <li
        id="ActorRowComponent"
        class="card mb-1 shadow-sm w-100"
        v-for="(actor, index) in especificaciones"
        :key="index"
      >
        <div class="card-body">
          <div class="cart-title">
            {{ actor.nombre }}
            <button
              type="button"
              class="close ml-1"
              aria-label="Close"
              style="color: #e74c3c"
              v-on:click="deleteActor(actor)"
            >
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
            <button
              id="editActor"
              type="button"
              class="close"
              aria-label="Update"
              style="color: #e67e22"
              v-on:click="toggleUpdate(actor)"
            >
              <font-awesome-icon :icon="['fas', 'edit']" />
            </button>
          </div>
        </div>
      </li>

      <!--div id="container">
            <div
              id="row"
              class="shadow-sm row rounded"
              v-for="actor in actores"
              :key="actor.id"
              {{ actor.nombre }}
              <button
                class="btn btn-warning"
                @click="this.$refs['modalActor'].openModal()"
              >
               <font-awesome-icon :icon="['fas', 'edit']" />
              </button>
              <button class="btn btn-danger"><font-awesome-icon :icon="['fas', 'trash']" /></button>
            </div>
          </div-->
    </ul>
    <actor-modal-component
      :isUpdate="editMode"
      :especificacion="especificacion"
      :especificaciones="especificaciones"
      :proyecto_id="proyecto_id"
      ref="modalEspecificacion"
    />
  </div>
</template>

<script>
import ActorModalComponent from "./EspecificacionComponent";
import { BASE_URL } from "../../../../constants/constants.js";
import { db } from "../../../../firebase/db.js"

export default {
  components: { ActorModalComponent },
  props: ["proyecto_id"],
  data() {
    return {
      editMode: false,
      especificacion: {
        nombre: "",
        descripcion: "",
      },
      especificaciones: [],
    };
  },
  methods: {
    createActor: function () {
      this.editMode = false;
      this.especificacion = {
        nombre: "",
        descripcion: "",
      };
      this.$refs.modalEspecificacion.openModal();
    },
    getActor: function () {
      /*const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor"
      );
      response.then((res) => (this.especificaciones = res.data.data));*/
    },
    deleteActor: function (actor) {
      db.collection("especificaciones").doc(""+this.proyecto_id+"").collection("especificaciones").doc(actor.id).delete();
    },
    toggleUpdate: function (actor) {
      this.editMode = true;
      this.especificacion = actor;
      this.$refs.modalEspecificacion.openModal();
    },
  },
  mounted() {
    this.getActor();
  },
  firestore(){
    return {
      especificaciones: db.collection("especificaciones").doc(""+this.proyecto_id+"").collection("especificaciones")
    }
  }
};
</script>

<style>
</style>