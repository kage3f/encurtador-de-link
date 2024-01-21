# [Encurtador de Links]

Este projeto é um encurtador de links prático e fácil de usar, construído com PHP no back-end e Vue.js no front-end, utilizando Vite para uma experiência de desenvolvimento moderna e eficiente.

## Características

- **Encurtamento de Links**: Gere URLs curtas convenientes a partir de URLs longas.
- **Rastreamento de Cliques**: Monitore a popularidade dos seus links encurtados.
- **Interface Responsiva**: Acesse e gerencie seus links em qualquer dispositivo.
- **Copiar para Área de Transferência**: Copie links encurtados rapidamente com um clique.

## Tecnologias

- **Front-end**: Vue.js com Vite para uma rápida recarga a quente e desenvolvimento eficiente.
- **Back-end**: PHP puro para um back-end robusto e confiável.
- **Banco de Dados**: Mysql, para armazenamento eficiente de dados.

## Começando

Para começar a usar este projeto, siga os passos abaixo para configurar o ambiente local.

### Pré-requisitos

- PHP (versão x.x)
- [Nome do Banco de Dados: 'encurta'] configurado e rodando
- Node.js e npm/yarn instalados

## Configurando o Back-end

Para configurar o back-end do seu encurtador de links em PHP, siga estes passos:

1. Navegue até a pasta `back-end`.
2. Configure o banco de dados no arquivo `config.php`.
3. Configure o arquivo `.htaccess` para o redirecionamento apropriado de URLs. Isso é crucial para que o encurtador de links funcione corretamente. O conteúdo do arquivo `.htaccess` deve ser o seguinte:

    ```
    RewriteEngine On

    # Ignorar diretórios e arquivos reais
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f

    # Redirecionar URLs encurtadas para o script de redirecionamento no subdiretório
    RewriteRule ^([a-zA-Z0-9]+)$ /encurtador-link/public/redirect.php?code=$1 [L,QSA]
    ```

    Este código no `.htaccess` habilita a reescrita de URL para direcionar requisições para URLs encurtadas ao seu script PHP de redirecionamento. Substitua `/encurtador-link/public/redirect.php` pelo caminho correto do seu script de redirecionamento, se necessário.

4. Inicie o servidor PHP.


### Configurando o Front-end

```bash
cd front-end   # Entre na pasta do front-end
npm install    # Instale as dependências
npm run dev    # Inicie o servidor de desenvolvimento
