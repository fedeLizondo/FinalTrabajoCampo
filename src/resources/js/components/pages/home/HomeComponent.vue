<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="input-group">
          <input
            class="form-control ds-input"
            type="text"
            placeholder="Ingrese nombre del proyecto"
            v-model.trim="inputText"
            v-on:input="update($event.target.value)"
          />
          <div class="input-group-append">
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
};
</script>

<style>
</style>