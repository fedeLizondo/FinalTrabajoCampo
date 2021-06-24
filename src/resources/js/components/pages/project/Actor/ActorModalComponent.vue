<template>
  <modal-component ref="modalinternoActor">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }} actor</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="name">Nombre:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Ingrese nombre"
          v-model="actor.nombre"
        />
      </div>

      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea
          class="form-control"
          id="descripcion"
          rows="3"
          v-model="actor.descripcion"
          placeholder="Ingrese una descripción"
        ></textarea>
      </div>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button
          class="btn btn-danger"
          @click="this.$refs.modalinternoActor.closeModal()"
        >
          Salir
        </button>
        <button
          class="btn btn-secondary"
          @click="guardarActor"
          :disabled="!canUpdate && enableGuardar"
        >
          Guardar
        </button>
      </div>
    </template>
  </modal-component>
</template>

<script>
import ModalComponent from "../../../assets/ModalComponent.vue";
import { BASE_URL } from "../../../../constants/constants.js";
export default {
  components: { ModalComponent },
  props: ["actor", "isUpdate", "actores", "proyecto_id","canUpdate"],
  data() {
    return {
      isValidActor: true,
    };
  },
  computed: {
    enableGuardar() {
      return !this.isValidActor;
    },
  },
  methods: {
    closeModal() {
      this.$refs.modalinternoActor.closeModal();
    },
    openModal() {
      this.isValidActor = true;
      this.$refs.modalinternoActor.openModal();
    },
    guardarActor() {
      if (this.isValidActor) {
        this.isValidActor = false;
        this.isUpdate ? this.updateActor() : this.postActor();
        this.$refs.modalinternoActor.closeModal();
      }
    },
    postActor: function () {
      const response = axios.post(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor",
        this.actor
      );
      response.then((response) =>  this.actores.push(response.data.data));
    },
    updateActor: function () {
      const response = axios.put(
        BASE_URL +
          "/api/proyecto/" +
          this.proyecto_id +
          "/actor/" +
          this.actor.id,
        this.actor
      );
    },
  },
};
</script>

<style>
</style>