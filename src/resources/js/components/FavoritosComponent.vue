<template>
  <font-awesome-icon
    :icon="getStyle"
    :style="{ color: '#EBCB29' }"
    size="lg"
    @click="changeState"
    v-show="mustShow"
  />
</template>

<script>
import { BASE_URL } from "../constants/constants.js";

export default {
  props: ["user_id", "favs", "proyect_id"],
    computed: {
    fav() {
      if (!this.mustShow) return false;

      return this.favs.some((x) => x.proyect_id == this.proyect_id);
    },
    mustShow() {
      return (
        Boolean(this.user_id) && Boolean(this.favs) && Boolean(this.proyect_id)
      );
    },
    getStyle() {
      if (!this.fav) return ["fas", "star"];
      return ["far", "star"];
    },
  },
  methods: {
    changeState: function () {
      if (this.fav) {
        let favorito = this.favs.find((x) => x.proyect_id == this.proyect_id);
        if (Boolean(favorito)) {
          const response = axios.delete(
            `{{BASE_URL}}/api/proyecto/{{this.proyect_id}}/favorito/{{favorito.id}}`
          );
          response.then((res) => this.favs.push(res.data.data));
        }
      } else {
        //Agregar el favorito
        const response = axios.post(
          BASE_URL + "/api/proyecto/" + this.proyect_id + "/favorito",
          { user: this.user_id }
        );
        response.then((res) => this.favs.push(res.data.data));
      }
    },
  },
};
</script>

<style>
</style>