<template>
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
        Actores
        <button class="btn btn-primary" @click="createActor">crear</button>
      </div>
    </div>
    <ul class="list-group list-group-flush">
      <li
        id="ActorRowComponent"
        class="card mb-1 shadow-sm w-100"
        v-for="(actor, index) in actores"
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
      :actor="actor"
      :actores="actores"
      :proyecto_id="proyecto_id"
      ref="modalActor"
    />
  </div>
</template>

<script>
import ActorModalComponent from "./ActorModalComponent.vue";
import { BASE_URL } from "../../../../constants/constants.js";
export default {
  components: { ActorModalComponent },
  props: ["proyecto_id"],
  data() {
    return {
      editMode: false,
      actor: {
        nombre: "",
        descripcion: "",
      },
      actores: [],
    };
  },
  methods: {
    createActor: function () {
      this.editMode = false;
      this.actor = {
        nombre: "",
        descripcion: "",
      };
      this.$refs.modalActor.openModal();
    },
    getActor: function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor"
      );
      response.then((res) => (this.actores = res.data.data));
    },
    deleteActor: function (actor) {
      const response = axios.delete(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/actor/" + actor.id
      );
      const index = this.actores.indexOf(actor);
      if (index > -1) {
        this.actores.splice(index, 1);
      }
    },
    toggleUpdate: function (actor) {
      this.editMode = true;
      this.actor = actor;
      this.$refs.modalActor.openModal();
    },
  },
  mounted() {
    this.getActor();
  },
};
</script>

<style>
</style>