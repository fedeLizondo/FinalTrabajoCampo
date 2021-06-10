<template>
  <div>
    <h2>Listado para Proyectos</h2>
    <ul>
      <li><router-link to="/proyecto/1"> Ir a proyecto 1</router-link></li>
    </ul>
    <h2>Listados para Favoritos</h2>
  </div>
</template>

<script>
export default {
   props: ["proyecto_id", "user_id"],
  data() {
    return {
      proyectos: [],
      favoritos: []
    };
  },
  methods: {
    getProyectos: async function () {
      const response = axios.get(
        BASE_URL + "/api/"+this.user_id +"/proyecto"
      );
      response.then((res) => (this.proyectos = res.data.data));
    },
    getFavoritos: async function () {
      const response = axios.get(
        BASE_URL + "/api/"+this.user_id +"/favorito" 
      );
      response.then((res) => (this.favoritos = res.data.data));
    },
  },
  mounted() {
    this.getProyectos();
    this.getFavoritos();
  }

};
</script>

<style>
</style>