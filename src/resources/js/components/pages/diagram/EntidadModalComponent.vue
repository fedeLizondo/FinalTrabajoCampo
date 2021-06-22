<template>
  <modal-component ref="modalInternoDiagrama">
    <template v-slot:header>
      <h3>{{ !isUpdate ? "Agregar " : "Modificar " }}Entidad</h3>
    </template>

    <template v-slot:body>
      <div v-if="isCU">
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="inlineRadioOptions"
              id="inlineRadio1"
              value=""
              v-model="elemento.group"
            />
            <label class="form-check-label" for="inlineRadio1"
              >Actor / Sistema Externo</label
            >
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="inlineRadioOptions"
              id="inlineRadio2"
              value="CU"
              v-model="elemento.group"
            />
            <label class="form-check-label" for="inlineRadio2">CU</label>
          </div>
        </div>

        <div class="form-group">
          <label for="nombre">Nombre de Entidad:</label>
          <input
            type="text"
            class="form-control"
            id="nombre"
            v-model="elemento.text"
          />
        </div>
      </div>

      <div class="form-group" v-if="!isCU">
        <label for="nombre">Nombre de Entidad:</label>
        <input
          type="text"
          class="form-control"
          id="nombre"
          v-model="elemento.id"
        />
      </div>

      <div v-if="isClase">
        <label>Atributo:</label>
        <div class="form-row">
          <div class="form-group col-4 col-md-2">
            <label for="inputState">Entorno</label>
            <select
              id="inputState"
              class="form-control"
              v-model="atributo.scope"
            >
              <option selected value=""></option>
              <option value="+">public</option>
              <option value="-">private</option>
              <option value="#">protected</option>
            </select>
          </div>

          <div class="form-group col-4 col-md-2">
            <label>Tipo</label>
            <select type="text" class="form-control" v-model="atributo.type">
              <option selected value=""></option>
              <option value="object">Object</option>
              <option value="string">String</option>
              <option value="number">Number</option>
              <option value="list">List</option>
            </select>
          </div>
          <div class="form-group col-4 col-md-4">
            <label>Nombre</label>
            <input
              type="text"
              class="form-control"
              pattern="[^\s]+"
              v-model="atributo.name"
            />
          </div>
          <div class="form-group col-4 col-md-2">
            <label>Agregar</label>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" @click="addAtribute">
                <font-awesome-icon :icon="['fas', 'plus']" />
              </button>
            </div>
          </div>
        </div>

        <ul class="list-group">
          <li
            class="list-group-item"
            v-for="(atributo, index) in elemento.atributos"
            :key="index"
          >
           {{ atributo.scope + " " + atributo.type + " " + atributo.name }}
            <button
              class="btn btn-danger float-right"
              @click="
                elemento.next.splice(index, 1);
                elemento.link.splice(index, 1);
              "
            >
              <font-awesome-icon :icon="['fas', 'trash']" />
            </button>
          </li>
        </ul>

      </div>

      <div
        v-show="
          diagrama.data != null && diagrama.data.length > 0 && !isSecuencia
        "
      >
        <div class="form-group">
          <label for="relacionInput">Relacion:</label>
          <div class="input-group mb-3" id="relacionInput">
            <div class="input-group-prepend">
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
            <select
              class="custom-select"
              id="inputGroupSelect03"
              aria-label="Example select with button addon"
              v-model="to"
            >
              <option
                v-for="(item, index) in filteredDiagrams"
                :key="index"
                :selected="index == 0"
                :value="item.id"
              >
                {{ isCU ? item.text : item.id }}
              </option>
            </select>
            <div class="input-group-append">
              <button
                class="btn btn-outline-secondary"
                type="button"
                id="button-addon2"
                @click="addRelation"
                :disabled="!Boolean(to) || !Boolean(typeRelation)"
              >
                Agregar
              </button>
            </div>
          </div>
        </div>

        <ul class="list-group">
          <li
            class="list-group-item"
            v-for="(value, index) in elemento.next"
            :key="index"
          >
            {{ elemento.link[index] }} {{ getName(value) }}
            <button
              class="btn btn-danger float-right"
              @click="
                elemento.next.splice(index, 1);
                elemento.link.splice(index, 1);
              "
            >
              <font-awesome-icon :icon="['fas', 'trash']" />
            </button>
          </li>
        </ul>
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

import { db } from "../../../firebase/db";

export default {
  components: { ModalComponent },
  props: ["diagrama", "isUpdate", "proyecto_id"],
  data() {
    return {
      isValidDiagrama: true,
      to: "",
      typeRelation: "",
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
      atributo: {
        scope: "",
        type: "",
        name: "",
      },
      metodo: {
        scope: "",
        name: "",
        params: "",
        type: "",
        abstract: false,
        static: false,
      },
    };
  },
  computed: {
    enableGuardar() {
      console.log("", this.elemento);
      return (
        (Boolean(this.elemento.id) || Boolean(this.elemento.text)) &&
        this.isValidDiagrama
      );
    },
    filteredDiagrams() {
      if (!Boolean(this.diagrama.data)) return [];
      return this.diagrama.data.filter((elm) => elm.id != this.elemento.id);
    },
    isCU() {
      return this.diagrama.type == "CU";
    },
    isClase() {
      return this.diagrama.type == "CLASE";
    },
    isSecuencia() {
      return this.diagrama.type == "SECUENCIA";
    },
    relationTypes() {
      switch (this.diagrama.type) {
        case "CU":
          return [
            { name: "use", value: " --use--- " },
            { name: "include", value: " -.include.--> " },
            { name: "extend", value: " --extend---> " },
          ];
        case "CLASE":
          return [
            { name: "Herencia", value: " <|-- " },
            { name: "Composición", value: " *-- " },
            { name: "Agregación", value: " o-- " },
            { name: "Asociación", value: " -- " },
            { name: "Dependencia", value: " ..> " },
          ];
        case "SECUENCIA":
          return [
            { name: "-->", value: " ->> " },
            { name: "<--", value: " -->> " },
          ];
        default:
          return [];
      }
    },
  },
  methods: {
    getName(id) {
      if (this.isCU) {
        return this.filteredDiagrams.filter((x) => x.id == id)[0].text;
      }
      return id;
    },
    closeModal() {
      this.to = "";
      this.typeRelation = "";
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
      this.$refs.modalInternoDiagrama.closeModal();
    },
    openModal() {
      this.isValidDiagrama = true;
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
      if (this.isCU) {
        if (!Boolean(this.elemento.id)) this.elemento.id = Date.now();

        if (Boolean(this.elemento.group)) {
          this.elemento.edgeType = "stadium";
        }
      }

      this.diagrama.data.push({ ...this.elemento });

      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
      this.closeModal();
    },
    updateDiagrama: function () {
      db.collection("especificaciones")
        .doc(this.proyecto_id)
        .collection("diagramas")
        .doc(this.diagrama.id)
        .update(this.diagrama);
      this.to = "";
      this.typeRelation = "";
    },
    addRelation: function () {
      this.elemento.next.push(this.to);
      this.elemento.link.push(this.typeRelation);
      this.to = "";
      this.typeRelation = "";
    },
    addAtribute: function () {
      this.elemento.atributos.push({...this.atributo});
      this.atributo = {
        scope: "",
        type: "",
        name: ""
      }
    }
  },
};
</script>