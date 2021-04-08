<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="height: 90vh">
        <div class="card-header" style="text-aligne: center">Mensajes</div>

        <div
          class="card-body"
          style="overflow: auto; display: flex; flex-direction: column-reverse"
        >
          <dl v-for="(message, index) in messages" v-bind:key="index">
            <dt :class="{ 'text-right': true }">
              {{ message.name }}
            </dt>
            <dd :class="{ 'text-right': true }">
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
                placeholder="Type your message..."
              />

              <div class="input-group-append">
                <button class="btn btn-primary">Send</button>
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
  props: ["proyecto_id", "diagrama_id", "especificacion_id"],
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
  methods: {
    sendMessage() {
      console.log("Send message");
      this.messages.unshift({ name: "el pepe", mensaje: this.newMessage });
      this.newMessage = "";
    },
    getMessages() {
      const end = this.diagramas
        ? "/diagrama/" + this.diagramas.id
        : this.especificaciones
        ? "/especificacion/" + this.especificaciones.id
        : "/";
      const response = axios
        .get(BASE_URL + "/api/proyecto/" + this.proyecto_id + end + "mensaje")
        .then((response) => {
          this.messages = response.data.data;
        });
    },
    updateMessage($mensaje) {
      const end = this.diagramas
        ? "/diagrama/" + this.diagramas.id
        : this.especificaciones
        ? "/especificacion/" + this.especificaciones.id
        : "/";
      const response = axios.put(
        BASE_URL +
          "/api/proyecto/" +
          this.proyecto_id +
          end +
          "/mensaje/" +
          $mensaje.id,
        $mensaje
      );
    },
    deleteMessage($mensaje) {
      const end = this.diagramas
        ? "/diagrama/" + this.diagramas.id
        : this.especificaciones
        ? "/especificacion/" + this.especificaciones.id
        : "/";
      const response = axios.delete(
        BASE_URL +
          "/api/proyecto/" +
          this.proyecto_id +
          end +
          "/mensaje/" +
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