<template>
  <div>
    <div class="form-group">
      <label for="nombre">Nombre de CU:</label>
      <input type="text" class="form-control" id="nombre" />
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <input type="text" class="form-control" id="descripcion" />
    </div>

    <div class="form-group">
      <label for="actor">Actores</label>
      <input type="text" class="form-control" id="actor" />
    </div>

    <div class="form-group">
      <label for="precondicion">Precondición</label>
      <input type="text" class="form-control" id="precondicion" />
    </div>

    <div class="form-group">
      <label for="caminoPrincipal">Camino principal</label>
      <textarea
        class="form-control"
        id="caminoPrincipal"
        rows="3"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="caminoAlternativo">Camino alternativo</label>
      <textarea
        class="form-control"
        id="caminoAlternativo"
        rows="3"
      ></textarea>
    </div>

    <div class="form-group">
      <label for="postcondicion">Postcondición</label>
      <input type="text" class="form-control" id="postcondicion" />
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>