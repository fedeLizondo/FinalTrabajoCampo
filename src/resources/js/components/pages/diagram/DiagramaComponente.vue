<template>
  <div class="row h-100" style="witdh: 100%">
    <div class="col-md-3">
      <diagrama-list-component
        :proyecto_id="this.$route.params.id"
        :diagrama="diagrama"
      />
    </div>

    <div style="border: 1px solid gray" class="col-md-9">
      <button class="btn btn-warning" v-on:click="crearRelacion" v-show="this.diagrama.type == 'SECUENCIA'">
        Relaciones
      </button>

      <vue-mermaid
        :nodes="diagrama.data||[]"
        :type="getTypeDiagram"
        :order="diagrama.orden"
        v-show="showMermaid"
      >
        <!--@nodeClick="editNode"-->
      </vue-mermaid>
    </div>

    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :proyecto_id="this.$route.params.id"
      ref="modalDiagrama"
    />
  </div>
</template>

<script>
import { db } from "../../../firebase/db";
import VueMermaid from "./vue-mermaid.vue";
import DiagramaModalComponent from "./EntidadModalComponent.vue";
import DiagramaListComponent from "./DiagramaListComponent.vue";

export default {
  components: { VueMermaid, DiagramaModalComponent, DiagramaListComponent },
  data: () => {
    return {
      editMode: false,
      diagrama: {},
    };
  },
  methods: {
    crearRelacion: function () {
      this.editMode = false;
      this.$refs.modalDiagrama.openModal();
    },
  },
  computed: {
    getTypeDiagram: function () {
      if (this.diagrama.type == "CU") return "graph LR";

      if (this.diagrama.type == "CLASE") return "classDiagram";

      return "sequenceDiagram";
    },
    showMermaid: function(){
      console.log("es ", (Boolean(this.diagrama.orden) && this.diagrama.orden.length > 0))
      
      return (Boolean(this.diagrama.data) && this.diagrama.data.length > 0) || (Boolean(this.diagrama.orden) && this.diagrama.orden.length > 0);
    }
  },
  mounted() {},
  firestore() {
    return {
      diagrama: db
        .collection("especificaciones")
        .doc("" + this.$route.params.id + "")
        .collection("diagramas")
        .doc("" + this.$route.params.id_diagrama),
    };
  },
};
</script>

<style>
</style>