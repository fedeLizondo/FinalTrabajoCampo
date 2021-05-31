<template>
  <modal-component ref="modalinternoEspecificacion">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }} especificación</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="selectEspecificacion">Especificación</label>
        <select
          class="form-control"
          id="selectEspecificacion"
          v-model="especificacion.type"
          required
          :disabled=isUpdate
        >
          <option value="ERS">ERS</option>
          <option value="CU">CU</option>
        </select>
      </div>
      <component
        :is="currentComponent"
        v-bind="currentProperties"
        v-on:changeShowPedido="showPedido = !showPedido"
      ></component>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button
          class="btn btn-danger"
          @click="this.$refs.modalinternoEspecificacion.closeModal()"
        >
          Salir
        </button>
        <button
          class="btn btn-secondary"
          @click="guardarEspecificacion"
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
import FormCUComponent from "./FormCU.vue";
import FormERSComponent from "./FormERS.vue";
import { db } from "../../../../firebase/db";

export default {
  components: { ModalComponent, FormCUComponent, FormERSComponent },
  props: ["especificacion", "isUpdate", "especificaciones", "proyecto_id"],
  data() {
    return {
      isValidEspecificacion: true,
    };
  },
  computed: {
    enableGuardar() {
      return !this.isValidEspecificacion;
    },
    currentProperties: function () {
      return {
        especificacion: this.especificacion
      };
    },
    currentComponent: function () {
      return this.especificacion.type == "ERS" ? "FormERSComponent" : "FormCUComponent";
    },
  },
  methods: {
    closeModal() {
      this.$refs.modalinternoEspecificacion.closeModal();
    },
    openModal() {
      this.isValidEspecificacion = true;
      this.$refs.modalinternoEspecificacion.openModal();
    },
    guardarEspecificacion() {
      if (this.isValidEspecificacion) {
        this.isValidEspecificacion = false;
        this.isUpdate ? this.updateEspecificacion() : this.postEspecificacion();
        this.$refs.modalinternoEspecificacion.closeModal();
      }
    },
    postEspecificacion: function () {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("especificaciones")
        .add(this.especificacion);
      /*const response = axios.post(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor",
        this.especificacion
      );
      response.then((response) =>  this.especificaciones.push(response.data.data));*/
    },
    updateEspecificacion: function () {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("especificaciones")
        .doc(this.especificacion.id)
        .update(this.especificacion);
    },
  },
};
</script>

<style>
</style>