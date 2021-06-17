<template>
  <modal-component ref="modalInternoDiagrama">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }}Entidad</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="nombre">Nombre de Entidad:</label>
        <input
          v-if="this.diagrama.type == 'CU'"
          type="text"
          class="form-control"
          id="nombre"
          v-model="element.nombre"
        />
        <input
          v-else
          type="text"
          class="form-control"
          id="nombre"
          v-model="element.text"
        />
      </div>

      <div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <select
              class="custom-select"
              id="inputGroupSelect03"
              aria-label="Example select with button addon"
            >
              <option selected>Choose...</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <select
            class="custom-select"
            id="inputGroupSelect03"
            aria-label="Example select with button addon"
          >
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <div class="input-group-append">
            <button
              class="btn btn-outline-secondary"
              type="button"
              id="button-addon2"
            >
              Agregar
            </button>
          </div>
        </div>
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
import ModalComponent from "./assets/ModalComponent.vue";

//import { db } from "../../../../firebase/db";

export default {
  components: { ModalComponent },
  props: ["diagrama", "isUpdate", "elemento", "proyecto_id"],
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
    guardarDiagrama() {
      if (this.isValidDiagrama) {
        this.isValidDiagrama = false;
        this.isUpdate ? this.updateDiagrama() : this.postDiagrama();
        this.$refs.modalInternoDiagrama.closeModal();
      }
    },
    postDiagrama: function () {
      /* db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);*/
    },
    updateDiagrama: function () {
      /* db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);*/
    },
  },
};
</script>