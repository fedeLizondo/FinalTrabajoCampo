<template>
  <div class="row h-100" style="witdh: 100%">
    <div style="border: 1px solid gray" class="col-md-8 ml-5">
      <button class="btn btn-primary" v-on:click="crearEntidad">
        Entidades
      </button>

      <vue-mermaid :nodes="diagrama.data" :type="getTypeDiagram">
        <!--@nodeClick="editNode"-->
      </vue-mermaid>
    </div>
    <div class="col-md-3 h-90">
      
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
import { db } from "../../../firebase/db";
import VueMermaid from "./vue-mermaid.vue";
import DiagramaModalComponent from "./DiagramaModalComponent.vue";

export default {
  components: {VueMermaid, DiagramaModalComponent },
  data: () => {
    return {
      proyecto_id: "1",
      editMode : false,
      diagrama: {
        id: "65zW0thM7Ew5iAht7usj",
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
    crearEntidad: function () {
      this.editMode = false;
      this.element ={
        id: "",
        text: "",
        next: [],
        link: [],
        msg: "",
        dataClass: [],
        atributos: [],
        metodos: [],
      },
      this.$refs.modalDiagrama.openModal();
    },
  },
  computed: {
    getTypeDiagram: function () {
      if (this.diagrama.type == "CU") return "graph LR";

      if (this.diagrama.type == "CLASE") return "classDiagram";

      return "sequenceDiagram";
    },
  },
  mounted() {
    console.log(this.$route.params.id);
    console.log(""+this.$route.params.id_diagrama);
  },
  firestore(){
    return {
      diagrama: db.collection("especificaciones").doc(""+this.$route.params.id+"").collection("diagramas").doc(""+this.$route.params.id_diagrama)
    }
  }
};
</script>

<style>
</style>