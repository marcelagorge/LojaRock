# 🎸 Loja Rock

Loja Rock é um sistema web desenvolvido em **PHP** com padrão de arquitetura **MVC** (Model-View-Controller), focado na simulação de uma loja virtual temática do rock. Permite cadastro de produtos, autenticação de usuários e gerenciamento de carrinho de compras.

---

## 👥 Integrantes

- **Julio Augusto Kretschmer** – RGM: 34353470  
- **Marcela dos Santos Gorge** – RGM: 34408088

---

## 📁 Estrutura de Pastas

O projeto deve estar localizado em `htdocs/phpTest/` para funcionar corretamente com servidores como o XAMPP.

---

## ⚙️ Funcionalidades

- ✅ Cadastro, edição e exclusão de produtos (admin)  
- 👥 Cadastro e autenticação de usuários  
- 🛒 Carrinho de compras funcional  
- 🎸 Visualização pública de produtos  
- 📤 Sistema de mensagens (sucesso/erro) com `flash.php`

---

## 🚀 Como Executar

1. **Coloque o projeto em:**  
   `htdocs/phpTest/`

2. **Crie o banco de dados:**  
   - Acesse o phpMyAdmin    
   - Importe o SQL com a estrutura de tabelas.

3. **Inicie o servidor local (XAMPP ou similar)**  
Acesse:  
http://localhost/phpTest

---

## 💻 Tecnologias Utilizadas:

- PHP (procedural)
- MySQL
- HTML5
- CSS3 + Bootstrap
- JavaScript (básico)

---

## 📌 Observações:

- As views foram organizadas por área de responsabilidade (admin, users, products, cart).
- O projeto segue uma divisão clara entre lógica (controllers), dados (models) e apresentação (views).

---

## 👤 Usuários para Teste

Para testar as funcionalidades de login, você pode utilizar os seguintes usuários pré-cadastrados:

| Usuário      | Senha  |
|--------------|--------|
| `jaSobreiro` | `12345` |
| `daviBrito`  | `bbb`   |
