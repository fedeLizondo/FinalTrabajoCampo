<template>
    <div>
    <div class="form-group">
      <label for="nombre">Nombre de ERS:</label>
      <input type="text" class="form-control" id="nombre" />
    </div>
    <div class="form-group">
      <label for="descripcion">Introducción</label>
      <input type="text" class="form-control" id="descripcion" />
    </div>

    <div class="form-group">
      <label for="precondicion">Entradas</label>
      <input type="text" class="form-control" id="precondicion" />
    </div>

    <div class="form-group">
      <label for="caminoPrincipal">Procesos</label>
      <textarea
        class="form-control"
        id="caminoPrincipal"
        rows="3"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="postcondicion">Salidas</label>
      <input type="text" class="form-control" id="postcondicion" />
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>