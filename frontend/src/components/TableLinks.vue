<script setup>
import axios from 'axios';
import { ref, onMounted, onUnmounted } from 'vue';

const links = ref([]);

const verifyCopy = ref('Copiar');

const fetchLinks = async () => {
  try {
    const response = await axios.get('https://tiagotech.xyz/index.php');
    links.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar links:', error);
  }
};

const deleteLink = async (id) => {
  if (confirm('Tem certeza que deseja excluir permanentemente esse link?')) {
    try {
      await axios.delete(`https://tiagotech.xyz/index.php?id=${id}`);
      // Atualizar a lista após a exclusão
      fetchLinks();
    } catch (error) {
      console.error('Erro ao excluir o link:', error);
    }
  }
};

const isMobile = ref(window.innerWidth < 580);

const updateIsMobile = () => {
  isMobile.value = window.innerWidth < 580;
};

const copyToClipboard = (url) => {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url)
      .then(() => {
        verifyCopy.value= 'Copiado!'
      })
      .catch(err => {
        console.error('Erro ao copiar texto: ', err);
      });
  } else {
    // Alternativa para navegadores mais antigos
    const textarea = document.createElement('textarea');
    textarea.value = url;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    console.log('Texto copiado com sucesso!');
  }
};



onMounted(() => {
  window.addEventListener('resize', updateIsMobile);
});

onUnmounted(() => {
  window.removeEventListener('resize', updateIsMobile);
});

onMounted(fetchLinks);
</script>
<template>
   <table v-if="links.length && !isMobile">
    <thead>
      <tr>
        <th>Link Encurtado</th>
        <th>Link Original</th>
        <th>Cliques</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="link in links" :key="link.id">
        <td><a :href="`https://tiagotech.xyz/${link.short_code}`" target="_blank">{{ `https://tiagotech.xyz/${link.short_code}` }}</a></td>
        <td> 
           <div style="display: flex; align-items: center; justify-content: space-between;">
            <img style="width: 10%;" :src="`https://www.google.com/s2/favicons?domain=${link.long_url}&sz=128`" alt="Favicon" />
            <a style="width: 87%;" :href="`${link.long_url}`" target="_blank">{{ link.long_url }}</a>
           </div>
        </td>
        <td>{{ link.access_count }}</td>
        <td>
          <a @click="deleteLink(link.id)">
            <img src="/public/excluir.png" />
          </a>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="mobile-list" v-if="links.length && isMobile">
    <div v-for="link in links" :key="link.id" class="mobile-list-item">
      <div class="card-header">
        <img style="width: 128px;" :src="`https://www.google.com/s2/favicons?domain=${link.long_url}&sz=128`" alt="Favicon" />
        <a @click="deleteLink(link.id)" class="delete-btn"><img src="/public/excluir.png" /></a>
      </div>
      <p style="font-size: 18px; font-weight: 500; margin-top: 30px;">Link original:</p>
      <div class="card-content">
        <a :href="`${link.long_url}`" target="_blank">{{ link.long_url }}</a>
      </div>
      <div style="display: flex; gap: 5px;">
      <a class="btn-df" :href="`https://tiagotech.xyz/${link.short_code}`" target="_blank">Acessar</a>
      <button class="btn-df df1" @click="copyToClipboard(`https://tiagotech.xyz/${link.short_code}`)">{{verifyCopy}}</button>
      </div>
    </div>
  </div>
  <div v-else><p style="font-size: 25px; color: blue;">Ainda não existe links encurtados</p></div>
</template>
<style scoped>
table {
 
  width: 100%; /* A tabela se expande para ocupar o espaço disponível até 70% */
  border-collapse: separate;
}

td {
  height: 50px;
  vertical-align: middle;
  border-bottom: 2px solid #021746;
}

th, td {
  padding: 8px 30px;
  text-align: left;
  
} 
td {
padding: 8px 30px;
  max-width: 380px;
  word-wrap: break-word; /* Permite que as palavras sejam quebradas e mudem de linha */
  overflow-wrap: break-word; /* Alternativa ao word-wrap para navegadores mais recentes */
  white-space: normal; /* Garante que o espaço em branco seja tratado normalmente */
}

th {
  background-color: #021746;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #fff;
  border-right: 50px solid #021746;
}

th:first-child {
  border-top-left-radius: 10px;
}

th:last-child {
  border-top-right-radius: 10px;
}

a {
    color: #346BED;
}
/* Outros estilos que desejar */

@media (max-width: 768px) {
  th, td {
    padding: 4px 15px; /* Menos padding em telas menores */
  }
}

@media (max-width: 580px) {
  table {
    display: none;
  }
}
@media (max-width: 580px) {
  .mobile-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .mobile-list-item {
  background: linear-gradient(white, white) padding-box,
              linear-gradient(to right, darkblue, darkorchid) border-box;
  border-radius: 50em;
  border: 4px solid transparent;
    border-radius: 10px;
    padding: 15px;
    background-color: #fff;
  }

  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .card-content {
  display: flex;
    flex-direction: row;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 20px;
  }

  .card-content a {
    width: 90%;
    display: block;
    width: 80%;
    /* width: 180px; */
    display: block;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
  }

  .delete-btn img {
    cursor: pointer;
    width: 25px; /* Ajuste o tamanho conforme necessário */
  }

  .mobile-list {
  display: flex;
  width: 90%;
}

.btn-df {
    background-color: #346bed;
    color: #fff;
    padding: 10px 0 8px;
    width: 50%;
    display: block;
    border-bottom-left-radius: 10px;
    align-items: center;
    text-align: center;
}

.df1 {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 10px;
    background-color: #f37c62;
}
}

</style>
