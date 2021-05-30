<template>
  <div>
    <div class="form-group">
      <label for="nombre">Nombre de CU:</label>
      <input type="text" class="form-control" id="nombre" v-model="especificacion.nombre"/>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <input type="text" class="form-control" id="descripcion" v-model="especificacion.descripcion"/>
    </div>

    <div class="form-group">
      <label for="actor">Actores</label>
      <input type="text" class="form-control" id="actor" v-model="especificacion.actor"/>
    </div>

    <div class="form-group">
      <label for="precondicion">Precondición</label>
      <input type="text" class="form-control" id="precondicion" v-model="especificacion.actor"/>
    </div>

    <div class="form-group">
      <label for="caminoPrincipal">Camino principal</label>
      <textarea
        class="form-control"
        id="caminoPrincipal"
        rows="3"
        v-model="especificacion.caminoPrincipal"
      >
      </textarea>
    </div>

    <div class="form-group">
      <label for="caminoAlternativo">Camino alternativo</label>
      <textarea
        class="form-control"
        id="caminoAlternativo"
        rows="3"
        v-model="especificacion.caminoAlternativo"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="postcondicion">Postcondición</label>
      <input type="text" class="form-control" id="postcondicion" v-model="especificacion.postcondicion"/>
    </div>
  </div>
</template>

<script>
export default {
  props:["especificacion"],
};
</script>

<style>
</style>