<template>
  <modal-component ref="modalInternoProyecto">
    <template v-slot:header>
      <h3>Proyecto: {{ proyecto.nombre }}</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <div class="col-12 mb-3">
          <label for="validationDefault01">Nombre:</label>
          <input
            type="text"
            class="form-control"
            id="validationDefault01"
            v-model="proyecto.nombre"
          />
        </div>
      </div>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-danger" @click="closeModal">Salir</button>
        <button
          class="btn btn-secondary"
          @click="guardarDiagrama"
          :disabled="!enableGuardar"
        >
          Guardar
        </button>
      </div>
    </template>
  </modal-component>
</template>

<script>
import ModalComponent from "../../assets/ModalComponent.vue";
import { BASE_URL } from "../../../constants/constants.js";

export default {
  components: { ModalComponent },
  props: ["user_id", "proyecto", "proyectos", "isUpdate", "beforeName"],
  data() {
    return {
      isValidDiagrama: true,
    };
  },
  computed: {
    enableGuardar() {
      return true && this.isValidDiagrama;
    },
  },
  methods: {
    closeModal() {
      this.proyecto.nombre = this.beforeName;
      this.$refs.modalInternoProyecto.closeModal();
    },
    openModal() {
      this.isValidDiagrama = true;
      this.$refs.modalInternoProyecto.openModal();
    },
    guardarDiagrama() {
      if (this.isValidDiagrama) {
        this.isValidDiagrama = false;

        if (this.isUpdate) {
          const response = axios.put(
            BASE_URL + "/api/proyecto/" + this.proyecto.proyecto_id,
            { nombre: this.proyecto.nombre, user: this.user_id }
          );
        } else {
          const response = axios.post(BASE_URL + "/api/proyecto", {
            nombre: this.proyecto.nombre,
            user: this.user_id,
          });
          let saveProyect = {};
          response.then((res) => (saveProyect = res.data.data));
          this.proyecto.id = saveProyect.id;
          this.proyectos.push({ ...this.proyecto });
        }

        this.$refs.modalInternoProyecto.closeModal();
      }
    },
  },
};
</script>

<style>
</style>