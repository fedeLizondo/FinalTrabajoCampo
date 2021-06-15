<template>
  <div>
    <h3>This shows that the route is really working!!</h3>
    @{{ message }}
    <router-link to="/vue"><a>Back to the root</a></router-link>
    <vue-mermaid
      :nodes="data"
      type="classDiagram LR"
      @nodeClick="editNode"
    ></vue-mermaid>
  </div>
</template>

<script>
import vueMermaid from 'vue-mermaid/src/vue-mermaid.vue';
export default {
  components: { vueMermaid },
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
    };
  },
};
</script>