<template>
  <div>
    @{{ message }} {{ !user_id ? "Sin User Id" : "Con user id" }}
    <router-link to="/vue/example"><a>url to example</a></router-link>
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  data() {
    return {
      message: "This is the home component!",
    };
  },
};
</script>