# 💈 BarberManager - Sistema de Gestão Full-Stack

Este projeto consiste em uma aplicação robusta para a gestão de clientes em barbearias, desenvolvida para resolver problemas reais de organização e persistência de dados. O sistema utiliza um ecossistema **CRUD** completo, integrando autenticação baseada em sessões e uma interface responsiva.

---

### 🚀 Funcionalidades (Ciclo CRUD)

O sistema gerencia o ciclo de vida completo das informações:
* **Create (Cadastro):** Registro de novos clientes com validação de campos obrigatórios.
* **Read (Listagem):** Visualização dinâmica de registros em tabela com design personalizado e efeitos de transparência.
* **Update (Edição):** Recuperação de registros por ID e atualização em tempo real no banco de dados.
* **Delete (Exclusão):** Remoção controlada de registros com foco na integridade das informações.
* **Autenticação:** Sistema de login protegido por sessões PHP para acesso restrito ao painel administrativo.



---

### 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 8.x (Tratamento de sessões, segurança de acesso e lógica de persistência).
* **Database:** MySQL (Modelagem relacional com tabelas e colunas totalmente documentadas via comentários SQL).
* **Frontend:** Bootstrap 5, HTML5 e CSS3 (Interface estilizada com foco em *Glassmorphism* e UX intuitiva).
* **Ambiente:** XAMPP, VS Code e MySQL Workbench.

---

### 🗄️ Estrutura de Dados

A arquitetura do banco de dados foi planejada para facilitar a manutenção e escalabilidade. A tabela principal conta com comentários internos que descrevem a finalidade técnica de cada campo, garantindo que a estrutura seja autodidática para futuros desenvolvedores.



---

### 📂 Como Executar o Projeto

1. **Clone este repositório** em sua máquina local.
2. **Importe o script SQL** (localizado na pasta `/database`) para o seu servidor MySQL.
3. **Configure o arquivo `config.php`** com as suas credenciais locais de banco de dados.
4. **Certifique-se de que os módulos Apache e MySQL estão ativos** no seu ambiente de desenvolvimento (ex: XAMPP).
5. **Acesse o sistema** através do navegador em `localhost/NomeDoDiretorio/Home.php`.

---

### 📝 Roadmap de Evolução

- [ ] Implementar **Prepared Statements** para proteção avançada contra SQL Injection.
- [ ] Criar módulo de **Agendamento de Serviços** com seleção de horários dinâmicos.
- [ ] Desenvolver Dashboard com métricas de crescimento e volume de atendimentos mensais.

---