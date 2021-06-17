<template>
  <div class="row h-100" style="witdh: 100%">

    <div class="col-md-3">
      <diagrama-list-component
        :proyecto_id="this.$route.params.id"
        :diagrama="diagrama"
      />
    </div>

    <div style="border: 1px solid gray" class="col-md-9">
      <button class="btn btn-primary" v-on:click="crearEntidad">
        Entidades
      </button>

      <vue-mermaid :nodes="diagrama.data" :type="getTypeDiagram">
        <!--@nodeClick="editNode"-->
      </vue-mermaid>
    </div>


    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :elemento="element"
      :proyecto_id="this.$route.params.id"
      ref="modalDiagrama"
    />
  </div>
</template>

<script>
import { db } from "../../../firebase/db";
import VueMermaid from "./vue-mermaid.vue";
import DiagramaModalComponent from "./DiagramaModalComponent.vue";
import DiagramaListComponent from './DiagramaListComponent.vue';

export default {
  components: {VueMermaid, DiagramaModalComponent, DiagramaListComponent },
  data: () => {
    return {
      editMode : false,
      diagrama: {},
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
  async mounted() {
    console.log("",this.$route.params)
    console.log("",await db.collection("especificaciones").doc(""+this.$route.params.id+"").collection("diagramas").doc(""+this.$route.params.idDiagrama).get())
  },
  firestore(){
    return {
      diagrama: db.collection("especificaciones").doc(""+this.$route.params.id+"").collection("diagramas").doc(""+this.$route.params.idDiagrama)
    }
  }
};
</script>

<style>
</style>