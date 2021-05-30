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
          v-model="espForm.type"
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
          @click="guardarActor"
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
import { BASE_URL } from "../../../../constants/constants.js";
import { db } from "../../../../firebase/db";

export default {
  components: { ModalComponent, FormCUComponent, FormERSComponent },
  props: ["especificacion", "isUpdate", "especificaciones", "proyecto_id"],
  data() {
    return {
      isValidActor: true,
      espForm:{
        type: "ERS",
        nombre: "",
        descripcion: "",
        actor:"",
        precondicion: "",
        caminoPrincipal: "",
        caminoAlternativo: "",
        postcondicion: ""
      }
    };
  },
  computed: {
    enableGuardar() {
      return !this.isValidActor;
    },
    currentProperties: function () {
      return {
        especificacion: this.espForm
      };
    },
    currentComponent: function () {
      return this.espForm.type == "ERS" ? "FormERSComponent" : "FormCUComponent";
    },
  },
  methods: {
    closeModal() {
      this.$refs.modalinternoEspecificacion.closeModal();
    },
    openModal() {
      this.isValidActor = true;
      this.$refs.modalinternoEspecificacion.openModal();
    },
    guardarActor() {
      if (this.isValidActor) {
        this.isValidActor = false;
        this.isUpdate ? this.updateActor() : this.postActor();
        this.$refs.modalinternoEspecificacion.closeModal();
      }
    },
    postActor: function () {
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
    updateActor: function () {
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