<template>
    <div>
    <div class="form-group">
      <label for="nombre">Nombre de ERS:</label>
      <input type="text" class="form-control" id="nombre" v-model="especificacion.nombre"/>
    </div>
    <div class="form-group">
      <label for="descripcion">Introducción</label>
      <input type="text" class="form-control" id="descripcion" v-model="especificacion.descripcion"/>
    </div>

    <div class="form-group">
      <label for="precondicion">Entradas</label>
      <input type="text" class="form-control" id="precondicion" v-model="especificacion.precondicion"/>
    </div>

    <div class="form-group">
      <label for="caminoPrincipal">Procesos</label>
      <textarea
        class="form-control"
        id="caminoPrincipal"
        rows="3"
        v-model="especificacion.caminoPrincipal"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="postcondicion">Salidas</label>
      <input type="text" class="form-control" id="postcondicion" v-model="especificacion.postcondicion"/>
    </div>
  </div>
</template>

<script>
export default {
  props:["especificacion"],
}
</script>

<style>

</style>