<template>
  <div class="row h-100" style="witdh:100%">
    <div style="border: 1px solid gray" class="col-md-8 ml-5">
      <button class="btn btn-warning" v-on:click="makeRelations()">
        Actualizar Relacion
      </button>
      <button class="btn btn-primary" v-on:click="crearEntidad()">
        Entidades
      </button>
      <button class="btn btn-secondary" v-on:click="showRelaciones()">
        Relaciones
      </button>

      <!--vue-draggable-resizable
        v-for="entidad in entidades"
        :key="entidad.id"
        :w="entidad.box.width"
        :h="entidad.box.height"
        :x="entidad.box.x"
        :y="entidad.box.y"
        @dragging="onDrag"
        @resizing="onResize"
        :parent="true"
        :grid="[30, 30]"
        :ref="'entidad' + entidad.id"
        :id="entidad.id"
        style="min-width:100px;min-height:100px;"
        :draggable="true"
      >
        <div class="card" style="display: block; overflow:hidden;">
          <div class="card-header">
            {{ entidad.nombre }}
            {{ entidad.id }}
          </div>

          <div class="atributos shadow-sm row rounded">
            <ul>
              <li v-for="(atributo, index) in entidad.atributos" :key="index">
                {{ atributo }}
              </li>
            </ul>
          </div>

          <div class="metodos shadow-sm row rounded" >
            <ul>
              <li v-for="(metodo, index) in entidad.metodos" :key="index">
                {{ metodo }}
              </li>
            </ul>
          </div>
        </div>
      </vue-draggable-resizable-->
    </div>
    <div class="col-md-3 h-90">
      <message-component :proyecto_id="4" />
    </div>
  </div>
</template>

<script>
//import LeaderLine from "leader-line-vue";
//import MessageComponent from "./MessageComponent.vue";
import {db} from "../firebase/db";

export default {
  components: { MessageComponent },
  data: () => {
    return {
      width: 0,
      height: 0,
      x: 0,
      y: 0,
      entidades: [
        {
          id: "1",
          nombre: "Pepe",
          tipo: "Clase",
          atributos: ["private pepe", Date.now() + ""],
          metodos: ["public pepe(void):marco"],
          box: {
            x: 50,
            y: 50,
            height: 200,
            width: 200,
          },
        },
        {
          id: "2",
          nombre: "Pepe",
          tipo: "Clase",
          atributos: ["private pepe"],
          metodos: ["public pepe(void):marco"],
          box: {
            x: 500,
            y: 50,
            height: 200,
            width: 200,
          },
        },
      ],
      relaciones: [
        {
          from: "1",
          to: "2",
          mensaje: "Texto de prueba",
          line: [],
        },
      ],
      entidad: {},
      relacion: {},
    };
  },
  methods: {
    onResize: function (x, y, width, height) {
      this.x = x;
      this.y = y;
      this.width = width;
      this.height = height;
    },
    onDrag: function (x, y) {
      this.x = x;
      this.y = y;
    },
    makeRelations: function () {
      this.relaciones.forEach((relacion) => {
        if (relacion.line.length > 0) {
          relacion.line.forEach((element) => {
            element.position();
          });
        } else {
          var linea = this.buildLine(relacion);
          if (linea) {
            relacion.line.push(linea);
          }
        }
      });
      return "";
    },
    buildLine: function (relacion) {
      if (
        !!this.$refs["entidad" + relacion.from] &&
        !!this.$refs["entidad" + relacion.to]
      ) {
        const start = this.$refs["entidad" + relacion.from][0].$el;
        const end = this.$refs["entidad" + relacion.to][0].$el;

        /*return LeaderLine.setLine(start, end, {
          dash: { animation: true },
        });*/
      } else return null;
    },
    onDrag: function (x, y) {
      console.log(x, y);
      this.makeRelations();
    },
    crearEntidad: function (params) {
      db.collection("diagrama2").add({
        entidad: {
          id: "1",
          nombre: "Pepe",
          tipo: "Clase",
          atributos: ["private pepe", Date.now() + ""],
          metodos: ["public pepe(void):marco"],
          box: {
            x: 50,
            y: 50,
            height: 100,
            width: 100,
          },
        },
      });
    },
  },
  computed: {},
  mounted() {
    this.makeRelations();
  },
};
</script>

<style>
</style>