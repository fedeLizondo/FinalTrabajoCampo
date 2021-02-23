<template>
  <div
    style="height: 90vh; width: 100%; border: 1px solid red; position: relative"
  >
    <vue-draggable-resizable
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
    >
      <div class="header">
        {{ entidad.nombre }}
        {{ entidad.id }}
      </div>

      <div class="atributos">
        <ul>
          <li v-for="(atributo, index) in entidad.atributos" :key="index">
            {{ atributo }}
          </li>
        </ul>
      </div>

      <div class="metodos">
        <ul>
          <li v-for="(metodo, index) in entidad.metodos" :key="index">
            {{ metodo }}
          </li>
        </ul>
      </div>
    </vue-draggable-resizable>
    <button v-on:click="makeRelations()">Generar Relacion</button>
  </div>
</template>

<script>
import LeaderLine from "leader-line-vue";

export default {
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
            height: 100,
            width: 100,
          },
        },
        {
          id: "2",
          nombre: "Pepe",
          tipo: "Clase",
          atributos: ["private pepe"],
          metodos: ["public pepe(void):marco"],
          box: {
            x: 200,
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
        if (relacion.line.length) {
          relacion.line.forEach((element) => {
            element.position();
          });
        } else {
            line = buildLine(element);
            if(line){
              relacion.line.push(line);
            }
          }
        }
      )
      return "";
    },
    buildLine: function(relacion){
      if (
            !!this.$refs["entidad" + relacion.from] &&
            !!this.$refs["entidad" + relacion.to]
          ){
            const start = this.$refs["entidad" + relacion.from][0].$el;
            const end = this.$refs["entidad" + relacion.to][0].$el;

            return LeaderLine.setLine(start, end, {
              dash: { animation: true },
            });
          }
        else
          return null;

    }
  },
  computed: {},
  mounted() {},
};
</script>

<style>
</style>