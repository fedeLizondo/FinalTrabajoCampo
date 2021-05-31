<template>
    <div class="card">
    <div class="card-header">
      Diagrama
      <button class="btn btn-primary" @click="createDiagrama">crear</button>
    </div>
    <ul class="list-group list-group-flush">
      <li
        id="DiagramaRowComponent"
        class="card mb-1 shadow-sm w-100"
        v-for="(diagrama, index) in diagramas"
        :key="index"
      >
        <div class="card-body">
          <div class="cart-title">
            {{  diagrama.type +": "+ diagrama.nombre }}
            <button
              type="button"
              class="close ml-1"
              aria-label="Close"
              style="color: #e74c3c"
              v-on:click="deleteDiagrama(diagrama)"
            >
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
            <button
              id="editDiagrama"
              type="button"
              class="close"
              aria-label="Update"
              style="color: #e67e22"
              v-on:click="toggleUpdate(diagrama)"
            >
              <font-awesome-icon :icon="['fas', 'edit']" />
            </button>
          </div>
        </div>
      </li>
    </ul>
    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :diagramas="diagramas"
      :proyecto_id="proyecto_id"
      ref="modalDiagrama"
    />
  </div>
</template>


<script>
import { db } from "../../../../firebase/db.js"
import DiagramaModalComponent from "./DiagramaComponent.vue"

export default {
     components: { DiagramaModalComponent },
     props: ["proyecto_id"],
  data() {
    return {
      editMode: false,
      diagrama: {
        type: "CU",
        nombre: "",
        descripcion: "",
        entidades: {},
        relaciones: {}
      },
      diagramas: [],
    };
  },
  methods: {
    createDiagrama: function () {
      this.editMode = false;
      this.diagrama = {
        type: "CU",
        nombre: "",
        descripcion: "",
        entidades: {},
        relaciones: {}
      };
      this.$refs.modalDiagrama.openModal();
    },
    deleteDiagrama: function (diagrama) {
      db.collection("especificaciones").doc(""+this.proyecto_id+"").collection("diagramas").doc(diagrama.id).delete();
    },
    toggleUpdate: function (diagrama) {
      this.editMode = true;
      this.diagrama = diagrama;
      this.$refs.modalDiagrama.openModal();
    },
  },
  mounted() {
  },
  firestore(){
    return {
      diagramas: db.collection("especificaciones").doc(""+this.proyecto_id+"").collection("diagramas")
    }
  }
}
</script>

<style>

</style>