# Passaporte.io 🎟️

O **Passaporte.io** é um sistema completo de gestão de eventos e venda de ingressos. Construído com foco absoluto na experiência do usuário (UX/UI), a plataforma conecta criadores de eventos a pessoas em busca de novas experiências, oferecendo um fluxo seguro, rápido e responsivo.

---

## 📸 Capturas de Tela

<div align="center">
  <img src="imgReadme//para/home.png" alt="Home - Lista de Eventos" width="48%">
  <img src="imgReadme/para/detalhes.png" alt="Tela de Detalhes do Evento" width="48%">
</div>
<br>
<div align="center">
  <img src="imgReadme/para/cadastro-evento.png" alt="Formulário de Cadastro de Eventos" width="48%">
  <img src="imgReadme/para/ingressos.png" alt="Tela de Ingressos Adquiridos" width="48%">
</div>

---

## 🎯 Objetivo do Projeto

O projeto foi desenvolvido para simplificar o ciclo de vida de um evento. Ele resolve o problema de organizadores que precisam de uma plataforma limpa para divulgar suas atividades e controlar a capacidade de público, ao mesmo tempo em que oferece aos participantes uma carteira digital segura para gerenciar seus ingressos gerados de forma única.

## ✨ Principais Funcionalidades

O sistema é dividido em dois perfis de acesso, garantindo segurança e separação de responsabilidades (ACL):

**Para Participantes:**
* Exploração de eventos na vitrine pública.
* Inscrição em eventos (geração automática de ingresso com código único `TKT-XXXXXX`).
* Carteira digital (Dashboard) para visualizar ingressos confirmados.
* Cancelamento de inscrição com devolução automática da vaga.

**Para Organizadores:**
* Dashboard gerencial com lista de eventos próprios.
* CRUD completo: Criação, leitura, edição e exclusão de eventos.
* Upload e gestão de banners de divulgação.
* Controle rigoroso de capacidade e vagas disponíveis.

**Gerais:**
* Telas de autenticação (Login/Registro) modernas com *Split-Screen* e alternância de visibilidade de senha (funcionalidade de ocultar/mostrar senha com um clique).
* Feedbacks visuais dinâmicos (Toasts de sucesso ou erro que desaparecem automaticamente após 4 segundos) para todas as ações do sistema.
* Interface 100% responsiva baseada em um sistema de temas unificado (`data-theme="light"`).

---

## 🛠️ Tecnologias Utilizadas

O projeto foi construído utilizando o ecossistema moderno do PHP, garantindo performance e facilidade de manutenção:

* **Backend:** [PHP 8+](https://www.php.net/) e [Laravel 11+](https://laravel.com/)
* **Frontend:** [Tailwind CSS](https://tailwindcss.com/) e [DaisyUI](https://daisyui.com/) para componentização ágil e estilização moderna.
* **Interatividade:** [Alpine.js](https://alpinejs.dev/) (manipulação de DOM, alternância de senhas e fechamento de Toasts de forma nativa).
* **Autenticação:** Laravel Breeze (totalmente customizado e integrado ao layout geral do sistema).
* **Banco de Dados:** SQLite (padrão para desenvolvimento local rápido) / MySQL.

---

## ⚙️ Arquitetura de Rotas e Segurança (Passo a Passo)

A estrutura de execução das requisições segue uma ordem lógica rigorosa dentro do arquivo `routes/web.php` para evitar conflitos de rotas dinâmicas e garantir o controle de acesso:

```text
┌────────────────────────────────────────────────────────┐
│                      Rotas Web                         │
└───────────────────────────┬────────────────────────────┘
                            │
            ┌───────────────┴───────────────┐
            ▼                               ▼
    [Rotas Públicas]              [Rotas Autenticadas]
            │                               │
    ┌───────┴───────┐               ┌───────┴───────┐
    ▼               ▼               ▼               ▼
[/] Home     [/events/{event}]  [Organizador]     [Participante/Geral]
             Ver Detalhes       - /events/create   - /dashboard
                                - /events (Store)  - /events/{event}/attend
                                - /events/edit     - /events/{event}/cancel
                                - /events (Delete) - /profile (Breeze)
