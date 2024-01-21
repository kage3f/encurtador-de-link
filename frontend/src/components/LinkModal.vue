<script setup>
    import TableLinks from './TableLinks.vue';
</script>
<!-- LinkModal.vue -->
<template>
  <div v-if="show" class="modal">
    <div style="width: 100%; display: flex; justify-content: flex-end;"><a style="cursor: pointer;" @click="exitModal"><img style='width: 40px;' src="/public/sair.png"/></a></div>
    <h1 class="gradient-h1" v-if="isLinkCreated">Seu link está pronto :)</h1>
    <div class="container-link" v-if="isLinkCreated">
      <div class="container-iconlink">
        <img style="width: 18px;" src="/public/link.png" />
        <a style="font-size: 18px; color: #0088e3" :href="shortLink" target="_blank">{{ shortLink }}</a>
      </div>
      <a class="btn-acessar" :href="shortLink" target="_blank">Acessar</a>
    </div>
    <div style=" width: 100%; display: flex; justify-content: center; margin-top: 80px;"><TableLinks /></div>
    
  </div>
</template>

<script>
export default {
  props: {
    show: Boolean,
    shortLink: String,
    isLinkCreated: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    exitModal() {
      this.$emit('close');
    }
  }
};
</script>

<style scoped>
.modal {
 flex: 1;
    width: 80%;
    background-color: #fff;
    position: absolute;
    height: 90%;
    top: 5%;
    border-radius: 10px;
    padding: 20px;
    box-sizing: border-box;
    overflow-y: auto;
}

.container-link {
    width: 400px;
    height: 50px;
    border: 3px solid #346BED;
    margin: 0 auto;
    display: flex;
    padding: 3px 3px;
    border-radius: 30px;
    align-items: center;
    justify-content: space-between;
}

.btn-acessar {
    background-color: #346BED;
    height: 50px;
    width: 100px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
}

.container-iconlink {
    display: flex;
    margin-left: 20px;
    align-items: baseline;
    gap: 10px;
}

.gradient-h1 {
    margin-top: 50px; 
    text-align: center; 
    margin-bottom: 30px; 
    font-size: 50px; 
    font-weight: 700;
    background: linear-gradient(to right, #346BED, #021746); /* Substitua com as cores desejadas */
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent; /* Específico para WebKit */
    color: transparent; /* Para outros navegadores */
}
</style>