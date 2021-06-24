<template>
  <modal-component ref="modalInternoGroup">
    <template v-slot:header>
      <h3>Proyecto: {{ proyecto.nombre }}</h3>
    </template>

    <template v-slot:body>
      <div class="form-group">
        <label for="relacionInput">Agregar al equipo:</label>
        <div
          :class="[
            'input-group',
            'mb-3',
            Boolean(email) && (!validEmail || !uniqueEmail) ? 'is-invalid' : '',
          ]"
          id="relacionInput"
        >
          <input
            type="email"
            class="form-control"
            id="inputEmail4"
            v-model="email"
          />
          <div class="invalid-feedback">{{ errorMessage }}</div>

          <div class="input-group-append">
            <button
              class="btn btn-outline-secondary"
              type="button"
              id="button-addon2"
              @click="addGroup"
              :disabled="!enableGuardar"
            >
              Agregar
            </button>
          </div>
        </div>
      </div>

<ul class="list-group">
          <li
            class="list-group-item"
            v-for="(value, index) in elemento.next"
            :key="index"
          >
            {{ elemento.link[index] }} {{ getName(value) }}
            <button
              class="btn btn-danger float-right"
              @click="
                elemento.next.splice(index, 1);
                elemento.link.splice(index, 1);
              "
            >
              <font-awesome-icon :icon="['fas', 'trash']" />
            </button>
          </li>
        </ul>
    </template>

    <template v-slot:footer>
      <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-danger" @click="closeModal">Salir</button>
      </div>
    </template>
  </modal-component>
</template>

<script>
import ModalComponent from "./assets/ModalComponent.vue";
import { BASE_URL } from "../constants/constants.js";

export default {
  components: { ModalComponent },
  props: ["proyecto_id", "user_id"],
  data() {
    return {
      email: "",
      grupo: [],
    };
  },
  methods: {
    getGrupo: async function () {
      const response = axios.get(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/grupo"
      );
      response.then((res) => (this.grupo = res.data.data));
    },
    addGroup: async function () {
      const response = axios.post(
        BASE_URL + "/api/proyecto/" + this.proyecto_id + "/grupo",
        {
          email: this.email,
          is_admin: false,
        }
      );

      response.then((res) =>
        Boolean(res.data.data)
          ? this.grupo.append(res.data.data)
          : console.log("error", res.data)
      );
    },
  },
  computed: {
    enableGuardar() {
      return Boolean(this.email) && this.validEmail() && this.uniqueEmail;
    },
    validEmail() {
      const re =
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    uniqueEmail() {
      const emailToFind = email.trim().toLowerCase();
      return grupo.some((x) => x.email.toLowerCase() == emailToFind);
    },
    errorMessage() {
      let msg = "";
      if (this.validEmail) {
        msg += "Ingrese un email valido. ";
      }
      if (this.uniqueEmail) {
        msg += "El usuario ya pertenece al grupo";
      }
      return msg;
    },
    filterGroup(){
        if (!Boolean(this.grupo)) return [];
        return this.grupo.filter( x => x.user_id == this.user_id);
    }
  },
  mounted() {
    this.getGrupo();
  },
};
</script>

<style>
</style>