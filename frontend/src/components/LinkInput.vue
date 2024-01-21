<script setup>
import LinkModal from './LinkModal.vue';
</script>
<template>
  <div class="link-input-container">
    <input type="text" :class="{ 'error-border': errorMessage}" v-model="link" placeholder="Cole o link original aqui" />
    <button @click="createLink">Criar</button>
     <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    <div style="width: 100%; text-align: center; margin-top: 80px;"><a @click="openModal" class="btn-listalink">Ver links criados</a></div>
  </div>
 <LinkModal :show="showModal" :shortLink="shortLink" :isLinkCreated="createdLink" @close="showModal = false" />
</template>

<script>
import { createShortLink } from '/services/linkService'; // Ajuste o caminho conforme necessário
export default {
  data() {
    return {
      link: '',
      errorMessage: '',
      shortLink: '',
      showModal: false,
      createdLink: true
    };
  },
  methods: {
    async createLink() {
      try {
        const result = await createShortLink(this.link);
        this.shortLink = result.short_url;
        this.showModal = true;
        this.errorMessage = '';
        this.createdLink = true; // Define para false ao abrir a lista de links
      } catch (error) {
        this.errorMessage = error.message; // Definindo a mensagem de erro
      }
    },
     openModal() {
      this.createdLink = false; // Define para false ao abrir a lista de links
      this.showModal = true;
    },
    exitModal(){
      this.showModal = false;
    }
  }
};
</script>

<style scoped>
.error-border {
    border: 2px solid #ed3a3a !important;
}
.link-input-container {
  display: flex;
    width: 50%;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

@media(max-width: 580px){
    .link-input-container {
        width: 90%;
        margin-top: 50px;
    }
}

.link-input-container input {
    width: 67%;
    border: none;
    height: 50px;
    border-radius: 20px;
    padding-left: 20px;
    box-sizing: border-box;
    font-size: 20px;
}

.link-input-container button {
  width: 30%;
    border-radius: 20px;
    border: none;
    height: 50px;
    background-color: #F37C62;
    color: #000;
    font-size: 20px;
    cursor: pointer;
}

.error-message {
    color: #ed3a3a;
    margin-top: 20px;
    font-size: 20px;
    margin-left: 20px;
}

.btn-listalink {
   padding: 15px 30px;
    background-color: #4a72d2;
    border-radius: 20px;
    font-size: 17px;
    color: #fff;
    cursor: pointer;
}

</style>
