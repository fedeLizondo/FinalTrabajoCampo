<template>
  <div class="card">
    <div class="card-header">
      Especificaciones
      <button class="btn btn-primary" @click="createEspecificacion">crear</button>
    </div>
    <ul class="list-group list-group-flush">
      <li
        id="ActorRowComponent"
        class="card mb-1 shadow-sm w-100"
        v-for="(especificacion, index) in especificaciones"
        :key="index"
      >
        <div class="card-body">
          <div class="cart-title">
            {{ especificacion.nombre }}
            <button
              type="button"
              class="close ml-1"
              aria-label="Close"
              style="color: #e74c3c"
              v-on:click="deleteEspecificacion(especificacion)"
            >
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
            <button
              id="editActor"
              type="button"
              class="close"
              aria-label="Update"
              style="color: #e67e22"
              v-on:click="toggleUpdate(especificacion)"
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
    <especificacion-modal-component
      :isUpdate="editMode"
      :especificacion="especificacion"
      :especificaciones="especificaciones"
      :proyecto_id="proyecto_id"
      ref="modalEspecificacion"
    />
  </div>
</template>

<script>
import EspecificacionModalComponent from "./EspecificacionComponent";
import { db } from "../../../../firebase/db.js"

export default {
  components: { EspecificacionModalComponent },
  props: ["proyecto_id"],
  data() {
    return {
      editMode: false,
      especificacion: {
        type: "ERS",
        nombre: "",
        descripcion: "",
        actor:"",
        precondicion: "",
        caminoPrincipal: "",
        caminoAlternativo: "",
        postcondicion: ""
      },
      especificaciones: [],
    };
  },
  methods: {
    createEspecificacion: function () {
      this.editMode = false;
      this.especificacion = {
        type: "ERS",
        nombre: "",
        descripcion: "",
        actor:"",
        precondicion: "",
        caminoPrincipal: "",
        caminoAlternativo: "",
        postcondicion: ""
      };
      this.$refs.modalEspecificacion.openModal();
    },
    deleteEspecificacion: function (especificacion) {
      db.collection("especificaciones").doc(""+this.proyecto_id+"").collection("especificaciones").doc(especificacion.id).delete();
    },
    toggleUpdate: function (especificacion) {
      this.editMode = true;
      this.especificacion = especificacion;
      this.$refs.modalEspecificacion.openModal();
    },
  },
  mounted() {
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