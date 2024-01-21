import axios from 'axios';

export async function createShortLink(longUrl) {
    try {
      const response = await axios.post('https://tiagotech.xyz/index.php', {
        long_url: longUrl
      });

      // O Axios já faz o parse do JSON automaticamente
      return response.data;
    } catch (error) {
      console.error('Erro ao criar link encurtado:', error);
      // O Axios coloca a resposta do erro em `error.response`
      throw new Error(error.response ? error.response.data.error : 'Erro desconhecido ao criar link encurtado');
    }
}
