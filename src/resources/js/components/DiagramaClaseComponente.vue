<template>
  <div class="row h-100" style="witdh: 100%">
    <div style="border: 1px solid gray" class="col-md-8 ml-5">
      <button class="btn btn-primary" v-on:click="crearEntidad">
        Entidades
      </button>

      <vue-mermaid :nodes="data" :type="getTypeDiagram" @nodeClick="editNode">
      </vue-mermaid>
    </div>
    <div class="col-md-3 h-90">
      <message-component :proyecto_id="4" />
    </div>

    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :elemento="element"
      :proyecto_id="proyecto_id"
      ref="modalDiagrama"
    />
  </div>
</template>

<script>
import MessageComponent from "./MessageComponent.vue";
import { db } from "../firebase/db";
import VueMermaid from "./vue-mermaid.vue";
import DiagramaModalComponent from "./DiagramaModalComponent.vue";

export default {
  components: { MessageComponent, VueMermaid, DiagramaModalComponent },
  data: () => {
    return {
      proyecto_id:"1",
      diagrama:{
      type: "CU",
      nombre: "Marco Polo",
      descripcion: "Test",
      data: [],
      },
      
      //Element tiene que quedar
      element: {
        id: "",
        text: "",
        next: [],
        link: [],
        msg: "",
        dataClass: [],
        atributos: [],
        metodos: [],
      },
    };
  },
  methods: {
    getTypeDiagram: function () {
      if (this.diagrama.type == "CU") return "graph LR";

      if (this.diagrama.type == "CLASE") return "classDiagram";

      return "sequenceDiagram";
    },
    crearEntidad: function () {
      this.editMode = false;
      this.diagrama = {
        type: "CU",
        nombre: "",
        descripcion: "",
        data: [],
        entidades: {},
        relaciones: {},
      };
      this.$refs.modalDiagrama.openModal();
    },
  },
  computed: {},
  mounted() {},
};
</script>

<style>
</style>