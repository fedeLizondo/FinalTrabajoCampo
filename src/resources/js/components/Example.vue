<template>
  <div>
    <h3>This shows that the route is really working!!</h3>
    @{{ message }}
    <router-link to="/vue"><a>Back to the root</a></router-link>
    <!--vue-mermaid
      :nodes="data"
      type="graph LR"
      @nodeClick="editNode"
    ></vue-mermaid-->

    <!--vue-mermaid
      :nodes="data2"
      type="classDiagram"
      @nodeClick="editNode"
    ></vue-mermaid-->
    
    <vue-mermaid
      :nodes="data3"
      type="sequenceDiagram"
      :order="['3','2','1']"
      @nodeClick="editNode"
    ></vue-mermaid>
  </div>
</template>

<script>
import VueMermaid from './vue-mermaid.vue';
export default {
  components: { VueMermaid },
  data() {
    return {
      message: "Hoera!!!!",
      data: [
        {
          id: "1",
          text: "A",
          link: "---",
          next: ["2"],
          editable: true,
          style: "fill:#f9f,stroke:#333,stroke-width:4px",
        },
        { id: "2", text: "B", edgeType: "circle", next: ["3"] },
        { id: "3", text: "C", next: ["4", "6"] },
        { id: "4", text: "D", link: "-- This is the text ---", next: ["5"] },
        { id: "5", text: "E" },
        { id: "6", text: "F" },
      ],
      data2: [
        { id: "2", next: ["3"], dataClass:["-String dato","-String dato2", "+toString():dato"]},
        { id: "3", next: ["4", "6"],  link: ["<|--","..>"] },
        { id: "4", next: ["5"] },
        { id: "5"},
        { id: "6"},
      ],
      data3: [
        { id: "3", next: ["2"],  link: "->>", msg:"a" },
        { id: "2", next: ["1"],  link: "->>", msg:"b" },
        { id: "1", next: ["2"],  link: "-->>", msg:"c" },
        { id: "2", next: ["3"],  link: "-->>", msg:"d" }
      ],
    };
  },
};
</script>