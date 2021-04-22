<template>
  <div class="container">
    <h1>bienvenidos a la pagina principal</h1>
    <div class="row">
      <div class="col-8">
        <div class="input-group">
          <input
            class="form-control ds-input"
            type="text"
            placeholder="Ingrese nombre del proyecto"
            v-model.trim="inputText"
            v-on:keyup.enter="buscar"
          />
          <div class="input-group-append" @click="buscar">
            <span class="input-group-text" id="basic-addon2">
              <font-awesome-icon :icon="['fas', 'search']" />
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputText: "",
    };
  },
    methods: {
    buscar: function () {
      this.$router.push({ name: "Search", query: { search: this.inputText } });
    },
  },
};
</script>

<style>
</style>