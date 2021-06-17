<template>
  <modal-component ref="modalInternoDiagrama">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }}Entidad</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="nombre">Nombre de Entidad:</label>
        <input
          v-if="!isCU"
          type="text"
          class="form-control"
          id="nombre"
          v-model="elemento.id"
        />
        <input
          v-else
          type="text"
          class="form-control"
          id="nombre"
          v-model="elemento.text"
        />
      </div>

      <div v-show="diagrama.data != null && diagrama.data.length > 0">
        <div class="form-group">
          <label for="relacionInput">Relacion:</label>
          <div class="input-group mb-3" id="relacionInput">
            <div class="input-group-prepend">
              <select
                class="custom-select"
                id="inputGroupSelect03"
                aria-label="Example select with button addon"
              >
                <option
                  v-for="(item, index) in relationTypes"
                  :key="index"
                  :selected="index == 0"
                >
                  {{ item.name }}
                </option>
              </select>
            </div>
            <select
              class="custom-select"
              id="inputGroupSelect03"
              aria-label="Example select with button addon"
            >
              <option
                v-for="(item, index) in filteredDiagrams"
                :key="index"
                :selected="index == 0"
              >
                {{ isCU ? item.text : item.id }}
              </option>
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

        <ul class="list-group">
          <li class="list-group-item"></li>
        </ul>
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
    filteredDiagrams() {
      return this.diagrama.data.filter((elm) => elm.id != this.elemento.id);
    },
    isCU() {
      return this.diagrama.type == "CU";
    },
    relationTypes() {
      return [];
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
        if(this.isCU && this.elemento.id == ""){
          this.elemento.id = Date.now();
        }

        this.diagrama.data.push({...this.elemento});

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