<template>
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
        Entidad
        <button class="btn btn-primary" @click="createEntidad">crear</button>
      </div>
    </div>
    <ul class="list-group list-group-flush" v-if="diagrama.type != 'SECUENCIA'">
      <li
        id="DiagramaRowComponent"
        class="card mb-1 shadow-sm w-100"
        v-for="(entidad, index) in diagrama.data"
        :key="index"
      >
        <div class="card-body">
          <div class="cart-title">
            {{ diagrama.type == "CU" ? entidad.text : entidad.id }}
            <button
              type="button"
              class="close ml-1"
              aria-label="Close"
              style="color: #e74c3c"
              v-on:click="deleteEntidad(index)"
            >
              <font-awesome-icon :icon="['fas', 'times']" />
            </button>
            <button
              id="editDiagrama"
              type="button"
              class="close"
              aria-label="Update"
              style="color: #e67e22"
              v-on:click="toggleUpdate(entidad)"
            >
              <font-awesome-icon :icon="['fas', 'edit']" />
            </button>
          </div>
        </div>
      </li>
    </ul>

    <ul class="list-group list-group-flush">
      <draggable v-model="diagrama.orden" @end="updateOrder">
        <li
          id="DiagramaRowComponent"
          class="card mb-1 shadow-sm w-100"
          v-for="(elemento, index) in diagrama.orden"
          :key="index"
          style="cursor: pointer;"
        >
          <div class="card-body">
            <div class="cart-title">
              <font-awesome-icon
                :icon="['fas', 'grip-vertical']"
                style="color: darkgrey"
              />
              {{ " " + elemento }}
              <button
                type="button"
                class="close ml-1"
                aria-label="Close"
                style="color: #e74c3c"
                v-on:click="deleteOrder(index)"
              >
                <font-awesome-icon :icon="['fas', 'times']" />
              </button>
              <button
                id="editDiagrama"
                type="button"
                class="close"
                aria-label="Update"
                style="color: #e67e22"
                v-on:click="toggleUpdateOrden(elemento, index)"
              >
                <font-awesome-icon :icon="['fas', 'edit']" />
              </button>
            </div>
          </div>
        </li>
      </draggable>
    </ul>

    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :elemento="element"
      :proyecto_id="proyecto_id"
      :selectedOrderIndex="selectedOrderIndex"
      ref="modalDiagrama"
    />
  </div>
</template>


<script>
import { db } from "../../../firebase/db.js";
import DiagramaModalComponent from "./EntidadModalComponent.vue";
import draggable from "vuedraggable";

export default {
  components: { DiagramaModalComponent, draggable },
  props: ["proyecto_id", "diagrama"],
  data() {
    return {
      editMode: false,
      selectedOrderIndex: "",
      element: {
        id: "",
        text: "",
        next: [],
        link: [],
        msg: "",
        dataClass: [],
        atributos: [],
        metodos: [],
        edgeType: "",
        group: "",
      },
    };
  },
  methods: {
    createEntidad: function () {
      this.editMode = false;
      this.element = {
        id: "",
        text: "",
        next: [],
        link: [],
        msg: "",
        dataClass: [],
        atributos: [],
        metodos: [],
        edgeType: "",
        group: "",
      };
      this.selectedOrderIndex = "";
      this.$refs.modalDiagrama.openModal();
    },
    deleteEntidad: function (index) {
      this.diagrama.data.splice(index, 1);

      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
    },
    deleteOrder: function (index) {
      this.diagrama.orden.splice(index, 1);

      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
    },
    updateOrder() {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
    },
    toggleUpdate: function (entidad) {
      this.editMode = true;
      this.element = entidad;
      this.selectedOrderIndex = "";

      this.$refs.modalDiagrama.openModal();
    },
    toggleUpdateOrden: function (elemento, index) {
      this.editMode = true;
      this.selectedOrderIndex = index;
      this.$refs.modalDiagrama.openModal();
    },
  },
  mounted() {},
};
</script>

<style>
</style>