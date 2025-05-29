# 🏥 Sistema de Agendamento Médico

![Laravel](https://img.shields.io/badge/Laravel-8.2-red.svg)
![Docker](https://img.shields.io/badge/Docker-3.8-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)

Sistema completo para gestão de consultas médicas com autenticação, CRUD de pacientes, médicos e agendamentos.

## 📦 Estrutura do Projeto

```
agendamento-app/
├── app/
│   ├── Models/
│   │   ├── Agendamento.php
│   │   ├── Medico.php
│   │   └── Paciente.php
│   └── Http/
│       ├── Controllers/
│       │   ├── AgendamentoController.php
│       │   ├── MedicoController.php
│       │   └── PacienteController.php
├── docker/
│   ├── Dockerfile
│   └── nginx.conf
├── database/
│   └── migrations/
│       ├── create_medicos_table.php
│       ├── create_pacientes_table.php
│       └── create_agendamentos_table.php
├── routes/
│   └── web.php
└── docker-compose.yml
```

## 🚀 Recursos Principais

- **Autenticação Segura**
  - Login/Cadastro de médicos
  - Middleware de proteção nas rotas

- **Gestão Completa**
  - CRUD de Pacientes
  - CRUD de Médicos
  - Agendamento de Consultas

- **Relacionamentos**
  - Médico → Agendamentos (1:N)
  - Paciente → Agendamentos (1:N)
  - User → Médico (1:1)

## 🛠 Tecnologias Utilizadas

| Componente       | Tecnologia           |
|------------------|----------------------|
| Backend          | Laravel 8.2          |
| Frontend         | Blade Templates      |
| Banco de Dados   | MySQL 8.0            |
| Containerização  | Docker + Nginx       |
| Autenticação     | Session Auth         |

## 🐳 Instalação com Docker

1. **Pré-requisitos**
   ```bash
   Docker >= 20.10
   Docker Compose >= 1.29
   ```

2. **Configuração Inicial**
   ```bash
   git clone https://github.com/Ofrans/Agendamento-de-Pacientes.git
   cd agendamento-app
   cp .env.example .env
   ```

3. **Subir os Containers**
   ```bash
   docker-compose up -d --build
   ```

4. **Instalar Dependências**
   ```bash
   docker-compose exec app composer install
   ```

5. **Configurar Banco de Dados**
   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

6. **Acessar a Aplicação**
   ```
   http://localhost:8000
   ```

## 🔐 Rotas de Autenticação

| Método | Rota       | Descrição               |
|--------|------------|-------------------------|
| GET    | /login     | Formulário de login     |
| POST   | /login     | Processa login          |
| GET    | /cadastro  | Formulário de cadastro  |
| POST   | /cadastro  | Processa cadastro       |
| POST   | /logout    | Encerra sessão          |


## 📌 Variáveis de Ambiente Críticas

```ini
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_irroba
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120
```

## 💡 Boas Práticas Implementadas

1. **Segurança**
   - Validação em todos os endpoints
   - Proteção contra Mass Assignment
   - Logs detalhados de erros

2. **Otimizações**
   - Eager Loading nas relações
   - Transações em operações críticas
   - Indexação de chaves estrangeiras

3. **Organização**
   - Separação clara de responsabilidades
   - Convenções RESTful
   - Tratamento centralizado de exceções

## 🧪 Testando o Sistema

```bash
# Executar programa
docker-compose exec app php artisan serve

# Popular banco com dados fake
docker-compose exec app php artisan db:seed
```
