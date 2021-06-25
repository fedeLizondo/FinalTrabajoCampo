<template>
  <div id="container">
    <div
      id="row"
      class="shadow-sm row rounded p-2"
      @click="moveToProject(item.id)"
    >
        <div
          class="col-10 col-lg-11 d-flex justify-content-start align-items-center"
        >
          <div id="nombre" class="d-inline-block text-wrap p-2">
            <div style="font-size: 1.1rem">
              {{ item.nombre }}
            </div>
          </div>
        </div>
        <div
          class="col-2 col-lg-1 d-flex flex-row justify-content-around justify-content-md-between text-truncate align-items-center"
        >
          <favoritos-component 
          :user_id="user_id"
          :proyect_id="item.id"
          :favs="favs"
          />
        </div>
    </div>
  </div>
</template>

<script>
import FavoritosComponent from '../../FavoritosComponent.vue';
export default {
  components: { FavoritosComponent },
  props: ["item","user_id","favs"],
  methods: {
    moveToProject: function (id) {
      this.$router.push({ name: "Proyecto", params: { id: id } });
    },
  },
};
</script>

<style>
</style>