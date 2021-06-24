<template>
  <modal-component ref="modalInternoRelacion">
    <template v-slot:header>
      <h3>Relaciones:</h3>
    </template>

    <template v-slot:body>
      <div class="form-row">
        <div class="form-group col-4 col-md-2">
          <label for="inputState">De</label>
          <select
            class="custom-select"
            id="inputGroupSelect03"
            aria-label="Example select with button addon"
            v-model="from"
          >
            <option
              v-for="(item, index) in diagrama.orden"
              :key="index"
              :selected="index == 0"
              :value="item"
            >
              {{ item }}
            </option>
          </select>
        </div>

        <div class="form-group col-4 col-md-2">
          <label for="inputState">Tipo</label>
          <select
            class="custom-select"
            id="inputGroupSelect03"
            aria-label="Example select with button addon"
            v-model="typeRelation"
          >
            <option
              v-for="(item, index) in relationTypes"
              :key="index"
              :selected="index == 0"
              :value="item.value"
            >
              {{ item.name }}
            </option>
          </select>
        </div>

        <div class="form-group col-4 col-md-2">
          <label for="inputState">a </label>
          <select
            class="custom-select"
            id="inputGroupSelect03"
            aria-label="Example select with button addon"
            v-model="to"
          >
            <option
              v-for="(item, index) in diagrama.orden"
              :key="index"
              :selected="index == 0"
              :value="item"
            >
              {{ item }}
            </option>
          </select>
        </div>

        <div class="form-group col-10 col-md-5">
          <label for="inputMensaje">Mensaje </label>
          <input
            type="text"
            class="form-control"
            name="inputMensaje"
            id="inputMensaje"
            v-model="msg"
          />
        </div>

        <div class="form-group col-2 col-md-1">
          <label for="inputState"> + </label>
          <button
            class="btn btn-primary"
            type="button"
            id="button-addon2"
            @click="addRelation"
            :disabled="
              !Boolean(from) ||
              !Boolean(typeRelation) ||
              !Boolean(to) ||
              !Boolean(msg)
            "
          >
            <font-awesome-icon :icon="['fas', 'plus']" />
          </button>
        </div>
      </div>

      <ul class="list-group">
        <draggable v-model="diagrama.data" @end="updateDiagram">
          <li
            class="list-group-item"
            v-for="(element, index) in diagrama.data"
            :key="index"
          >
            <font-awesome-icon
              :icon="['fas', 'grip-vertical']"
              style="color: darkgrey"
            />

            {{
              " " +
              element.id +
              " " +
              element.link[0] +
              element.next[0] +
              " : " +
              element.msg
            }}
            <button
              class="btn btn-danger float-right"
              @click="deleteRelation(index)"
            >
              <font-awesome-icon :icon="['fas', 'trash']" />
            </button>
          </li>
        </draggable>
      </ul>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-danger" @click="closeModal">Salir</button>
      </div>
    </template>
  </modal-component>
</template>

<script>
import ModalComponent from "../../assets/ModalComponent.vue";
import { db } from "../../../firebase/db";
import draggable from "vuedraggable";

export default {
  components: { ModalComponent, draggable },
  props: ["diagrama", "proyecto_id"],
  data() {
    return {
      from: "",
      to: "",
      typeRelation: "",
      msg: "",
      elemento: {
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
  computed: {
    relationTypes() {
      return [
        { name: "->", value: "->>" },
        { name: "-->", value: "-->>" },
      ];
    },
  },
  methods: {
    closeModal() {
      this.$refs.modalInternoRelacion.closeModal();
    },
    openModal() {
      this.$refs.modalInternoRelacion.openModal();
    },
    addRelation: function () {
      this.elemento.id = this.from;
      this.elemento.link.push(this.typeRelation);
      this.elemento.next.push(this.to);
      this.elemento.msg = this.msg;
      this.diagrama.data.push({ ...this.elemento });

      this.updateDiagram();

      this.from = "";
      this.typeRelation = "";
      this.to = "";
      this.msg = "";
      this.elemento = {
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
    },
    deleteRelation: function (index) {
      this.diagrama.data.splice(index, 1);
      this.updateDiagram();
    },
    updateDiagram: function () {
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