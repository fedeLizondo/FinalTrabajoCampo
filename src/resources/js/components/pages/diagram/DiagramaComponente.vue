<template>
  <div class="row h-100" style="witdh: 100%">
    <div class="col-12 text-center">
      <h2> {{getTitle}} </h2>
    </div>
    <div class="col-md-3" v-show="canUpdate">
      <diagrama-list-component
        :proyecto_id="this.$route.params.id"
        :diagrama="diagrama"
      />
    </div>

    <div style="border: 1px solid gray" class="col-md-9">
      <button class="btn btn-warning" v-on:click="crearRelacion" v-show="canUpdate && diagrama.type == 'SECUENCIA'">
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

      <div v-if="!Boolean(diagrama.data) && !Boolean(diagrama.grupo)">
          <h3>No hay entidades cargadas</h3>
      </div>

    </div>

    <diagrama-modal-component
      :isUpdate="editMode"
      :diagrama="diagrama"
      :proyecto_id="this.$route.params.id"
      ref="modalDiagrama"
    />
    <relation-modal-component 
      :diagrama="diagrama"
      :proyecto_id="this.$route.params.id"
      ref="relacionDiagrama"
    />
  </div>
</template>

<script>
import { db } from "../../../firebase/db";
import VueMermaid from "./vue-mermaid.vue";
import DiagramaModalComponent from "./EntidadModalComponent.vue";
import DiagramaListComponent from "./DiagramaListComponent.vue";
import RelationModalComponent from './RelationModalComponent.vue';
import { BASE_URL } from "../../../constants/constants.js";

export default {
  components: { VueMermaid, DiagramaModalComponent, DiagramaListComponent, RelationModalComponent },
  props:["user_id"],
  data: () => {
    return {
      editMode: false,
      diagrama: {},
      grupo:[]
    };
  },
  methods: {
    crearRelacion: function () {
      this.$refs.relacionDiagrama.openModal();
    },
    getGrupo: function () {
       const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.$route.params.id + "/grupo"
      );
      response.then((res) => (this.grupo = res.data.data));
    }
  },
  computed: {
    getTypeDiagram: function () {
      if (this.diagrama.type == "CU") return "graph LR";

      if (this.diagrama.type == "CLASE") return "classDiagram";

      return "sequenceDiagram";
    },
    showMermaid: function(){      
      return (Boolean(this.diagrama.data) && this.diagrama.data.length > 0) || (Boolean(this.diagrama.orden) && this.diagrama.orden.length > 0);
    },
    getTitle: function () {
      if (!Boolean(this.diagrama.nombre)){
        return "";
      }
      let tipo = (this.diagrama.type == "CU") ? "Casos de Uso" : (this.diagrama.type == "CLASE")? "Clase" : "Secuencia";

      return this.diagrama.nombre + " (" + tipo + ")" 
    },
    canUpdate(){
      if(!Boolean(this.user_id)) return false;
      return this.grupo.some((x) => x.user_id == this.user_id);
    }
    
  },
  mounted() {
    this.getGrupo()
  },
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