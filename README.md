<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo do Laravel"></a></p>

<p align="center">
<a href="https://github.com/seu-usuario/seu-repositorio/actions"><img src="https://github.com/seu-usuario/seu-repositorio/workflows/tests/badge.svg" alt="Status de Build"></a>
<a href="https://packagist.org/packages/seu-pacote"><img src="https://img.shields.io/packagist/dt/seu-pacote" alt="Total de Downloads"></a>
<a href="https://packagist.org/packages/seu-pacote"><img src="https://img.shields.io/packagist/v/seu-pacote" alt="Versão Estável"></a>
<a href="https://packagist.org/packages/seu-pacote"><img src="https://img.shields.io/packagist/l/seu-pacote" alt="Licença"></a>
</p>

# Nome do Projeto

Bem-vindo ao **Nome do Projeto**! Este é um sistema desenvolvido com **Laravel**, **Livewire**, e outros pacotes modernos para garantir uma experiência de usuário fluída e eficiente. Abaixo, você encontrará todas as informações necessárias para instalar, configurar e começar a usar o projeto de maneira simples.

## Funcionalidades

- **Autenticação de Usuários:** Com Laravel Jetstream e Livewire, garantimos um sistema de autenticação seguro e rápido.
- **CRUD Dinâmico:** Sistema para gerenciar grupos econômicos, unidades e colaboradores de maneira eficiente.
- **Relatórios:** Geração de relatórios em Excel para visualização de dados.
- **Armazenamento de Arquivos:** Armazenamento de arquivos de maneira segura no diretório `storage/app/public`.

## Instalação

Para rodar este projeto no seu ambiente de desenvolvimento, siga os passos abaixo:

### Requisitos

- **PHP 8.0 ou superior**
- **Composer**
- **Docker (opcional, se utilizar Sail)**
- **MySQL**

### Passo 1: Clonar o Repositório

Clone este repositório em seu ambiente local:

"git clone https://github.com/seu-usuario/seu-repositorio.git"
"cd seu-repositorio"

### Passo 2: Instalar Dependências

Instale as dependências do projeto utilizando o Composer:
"composer install"

### Passo 3: Configurar o Ambiente

Copie o arquivo .env.example para .env: 
"cp .env.example .env"

Preencha as informações do banco de dados e outras configurações do seu ambiente no arquivo .env. Abaixo um exemplo de como preencher:

APP_DEBUG=false
APP_LOCALE=pt_BR
APP_TIMEZONE=America/Sao_Paulo
QUEUE_CONNECTION=database

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

Obs: Certifique-se de que a conexão com o banco de dados e outras configurações estão corretas para o seu ambiente.

### Passo 4: Configurar o Docker (opcional)

Se você estiver usando o Laravel Sail para um ambiente de desenvolvimento Docker, execute os seguintes comandos:
"./vendor/bin/sail up -d"

### Passo 5: Gerar a Key de Aplicação

Gere a chave de aplicação para o Laravel:
"./vendor/bin/sail artisan key:generate"

### Passo 6: Executar as Migrations

Execute as migrations para configurar o banco de dados:
"./vendor/bin/sail artisan migrate"

### Passo 7: Criar a Pasta de Relatórios

Para garantir que a pasta de relatórios seja criada:
"./vendor/bin/sail artisan storage:link"
"mkdir -p storage/app/public/relatorios"

### Passo 8: Para iniciar as filas

Caso queira iniciar as filas para realizar as exportações, utilize:
"./vendor/bin/sail artisan queue:work"

## Como Usar

Após a instalação e configuração, você pode acessar o sistema no seu navegador, indo até http://localhost.

- Página Inicial: Mostra informações do sistema e permite acessar as funcionalidades.



- CRUD: Você poderá gerenciar grupos econômicos, bandeiras, unidades e colaboradores.
- Relatórios Colaboradores: Acesse a área de relatórios para exportar dados dos colaboradores em Excel.
- Auditoria: Sessão de auditoria do sistema, onde armazena qualquer (Create, Update or Delete) do sistema


*Desenvolvido por Julio Cesar*

