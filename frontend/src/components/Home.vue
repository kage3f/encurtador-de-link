<script setup>
  import LinkInput from './LinkInput.vue';
  import LinkModal from './LinkModal.vue';
</script>
<template>
  <div class="container">
    <div class="header">
      <img src="/public/logo.svg" />
      <a class="btn" href="https://www.linkedin.com/in/tiago-rodrigues-562988277/" target="_blank"><img src="/public/linkedin.png" />LinkedIn</a>
    </div>
    <div class="mid">
    <div>
      <h1>Crie <span style="color: #F37C62">Links</span> atrativos com um clique</h1>
      <p>Crie links curtos poderosos e reconhecíveis.</p>
    </div>
      <LinkInput/>
    </div>
  </div>
</template>

<style scoped>
.container {
  background-image: url('/public/background.png');
  width: 100%;
  height: 100vh;
  background-size: cover;
  background-repeat: no-repeat;
  padding-top: 50px;
}
.header {
  max-width: 65%;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
}

.btn {
  background-color: #132B63;
  padding: 15px 35px 13px 35px;
  color: #fff;
  font-size: 18px;
  border-radius: 10px;
  display: flex;
  align-items: flex-end;
  gap: 10px;
}

.btn img {
  width: 20px;
}

.mid {
  height: 100%;
  display: flex;
  margin-top: 130px;
  align-items: center;
  flex-direction: column;
  gap: 50px;
}

.mid h1 {
  font-size: 60px;
  font-weight: 500;
  color: #fff;
  max-width: 600px;
  text-align: center;
  line-height: 70px;
}

.mid p {
  text-align: center;
  color: #fff;
  font-size: 18px;
  font-weight: 300;
  margin-top: 8px;
}

@media(max-width: 580px) {
  .header {
    max-width: 90% !important;
  }
}
</style>
