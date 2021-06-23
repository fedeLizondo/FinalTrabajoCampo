<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="height: 75vh">
        <div class="card-header" style="text-aligne: center">Mensajes</div>

        <div
          class="card-body"
          style="overflow: auto; display: flex; flex-direction: column-reverse"
        >
          <dl v-for="(message, index) in messages" v-bind:key="index">
            <dt :class="{ 'text-right': user_id == message.user_id }">
              {{ message.name }}
            </dt>
            <dd :class="{ 'text-right': user_id == message.user_id }">
              {{ message.mensaje }}
            </dd>
          </dl>
        </div>
        <hr />
        <div class="card-footer">
          <form @submit.prevent="sendMessage" method="post">
            <div class="input-group">
              <input
                type="text"
                v-model="newMessage"
                class="form-control"
                placeholder="Escribe aquí tu mensaje ..."
                :disabled="enabledMessage"
              />

              <div class="input-group-append">
                <button class="btn btn-primary" :disabled="enabledMessage">
                  Enviar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { BASE_URL } from "../constants/constants.js";
export default {
  name: "mensajes",
  props: ["proyecto_id", "diagrama_id", "especificacion_id", "user_id"],
  data() {
    return {
      token: null,
      channel: null,
      members: [],
      client: null,
      messages: [],
      newMessage: "",
      authUser: {
        type: Object,
        required: true,
      },
    };
  },
  computed: {
    enabledMessage() {
      return !this.user_id;
    },
  },
  methods: {
    getRoute() {
      return this.diagramas
        ? "/diagrama/" + this.diagramas.id + "/"
        : this.especificaciones
        ? "/especificacion/" + this.especificaciones.id + "/"
        : "/";
    },
    sendMessage() {
      const response = axios
        .post(
          BASE_URL +
            "/api/proyecto/" +
            this.proyecto_id +
            this.getRoute() +
            "mensaje",
          { user: this.user_id, mensaje: this.newMessage }
        )
        .then((response) => {
          this.messages.unshift(response.data.data);
          this.newMessage = "";
        });
    },
    getMessages() {
      const response = axios
        .get(
          BASE_URL +
            "/api/proyecto/" +
            this.proyecto_id +
            this.getRoute() +
            "mensaje"
        )
        .then((response) => {
          this.messages = response.data.data.reverse();
        });
    },
    updateMessage($mensaje) {
      const response = axios.put(
        BASE_URL +
          "/api/proyecto/" +
          this.proyecto_id +
          this.getRoute() +
          "mensaje/" +
          $mensaje.id,
        $mensaje
      );
    },
    deleteMessage($mensaje) {
      const response = axios.delete(
        BASE_URL +
          "/api/proyecto/" +
          this.proyecto_id +
          this.getRoute() +
          "mensaje/" +
          $mensaje.id
      );
    },
  },
  mounted() {
    this.getMessages();
  },
};
</script>

<style>
</style>