<template>
  <modal-component ref="modalInternoDiagrama">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }} diagrama</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="selectDiagrama">Diagrama </label>
        <select
          class="form-control"
          id="selectDiagrama"
          v-model="diagrama.type"
          required
          :disabled="isUpdate"
        >
          <option value="CLASE">Clase</option>
          <option value="CU">Caso de Uso</option>
          <option value="SECUENCIA">Secuencia</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre">Nombre de diagrama:</label>
        <input
          type="text"
          class="form-control"
          id="nombre"
          v-model="diagrama.nombre"
        />
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input
          type="text"
          class="form-control"
          id="descripcion"
          v-model="diagrama.descripcion"
        />
      </div>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button
          class="btn btn-danger"
          @click="this.$refs.modalInternoDiagrama.closeModal()"
        >
          Salir
        </button>
        <button
          class="btn btn-secondary"
          @click="guardarDiagrama"
          :disabled="enableGuardar"
        >
          Guardar
        </button>
      </div>
    </template>
  </modal-component>
</template>

<script>
import ModalComponent from "../../../assets/ModalComponent.vue";
import { db } from "../../../../firebase/db";

export default {
  components: { ModalComponent },
  props: ["diagrama", "isUpdate", "diagramas", "proyecto_id"],
  data() {
    return {
      isValidDiagrama: true,
    };
  },
  computed: {
    enableGuardar() {
      return !this.isValidDiagrama;
    },
  },
  methods: {
    closeModal() {
      this.$refs.modalInternoDiagrama.closeModal();
    },
    openModal() {
      this.isValidDiagrama = true;
      this.$refs.modalInternoDiagrama.openModal();
    },
    guardarEspecificacion() {
      if (this.isValidDiagrama) {
        this.isValidDiagrama = false;
        this.isUpdate ? this.updateDiagrama() : this.postDiagrama();
        this.$refs.modalInternoDiagrama.closeModal();
      }
    },
    postDiagrama: function () {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .add(this.diagrama);
    },
    updateDiagrama: function () {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
    },
  },
};
</script>

<style>
</style>