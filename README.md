# Plataforma de Agendamento de Serviços

O sistema, denominado ServiNow, tem como objetivo ser uma plataforma digital segura e acessível para que prestadores de serviços possam ofertar seus atendimentos. Além disso, permite que clientes agendem serviços de forma prática e automatizada. A plataforma pode ser utilizada em diversas áreas, como saúde, estética, educação, suporte técnico e consultorias, facilitando a conexão entre profissionais e clientes.

## Funcionalidades

[Adicionas funcionalidades]

## Tecnologias Utilizadas

- **Linguagens:** HTML, CSS, JavaScript e PHP.
- **Frameworks:** Laravel (ou Springboot) e Bootstrap (ou React).
- **SGBD:** MySQL

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🧱 Estrutura de Pastas – Clean Architecture com Laravel

Este projeto segue os princípios da **Clean Architecture**, organizando o código em camadas bem definidas que separam as regras de negócio da infraestrutura (ORM, framework, etc), permitindo fácil manutenção, testes e escalabilidade.

---

## 📁 `app/Domain/`

Contém o **coração do sistema**: regras de negócio puras, sem dependência de Laravel ou qualquer tecnologia externa.

### ➤ `Entities/`
Entidades do domínio, com atributos e comportamento. Representam os objetos "puros" do negócio.

> Ex: `User`, `Product`, `Order`

### ➤ `Repositories/`
Interfaces dos repositórios (contratos). Define **o que** o sistema precisa fazer com dados, não **como**.

> Ex: `UserRepositoryInterface`, `ProductRepositoryInterface`

### ➤ `Services/`
Serviços de **regra de negócio complexa**, reutilizáveis, independentes de tecnologia.

> Ex: `TaxCalculatorService`, `UserValidator`

---

## 📁 `app/Application/`

Camada de **aplicação** – orquestra a lógica do domínio, define os casos de uso e realiza chamadas a serviços ou repositórios.

### ➤ `UseCases/`
Cada classe representa um caso de uso (ação da aplicação). Recebe dados, executa lógica e delega tarefas.

> Ex: `CreateUserUseCase`, `ListOrdersUseCase`

### ➤ `DTOs/`
Objetos de transporte de dados (Data Transfer Objects) – usados para mover dados entre camadas.

> Ex: `CreateUserDTO`, `UpdateProductDTO`

### ➤ `Interfaces/`
Contratos para **serviços externos** (e-mail, fila, APIs externas). A camada de aplicação **depende da interface**, e a **infraestrutura fornece a implementação**.

> Ex: `MailServiceInterface`, `PaymentGatewayInterface`

---

## 📁 `app/Infrastructure/`

Contém a **implementação técnica** da aplicação: como o sistema faz as coisas.

### ➤ `Persistence/`
Implementações concretas dos repositórios definidos na camada de domínio, usando Eloquent, PDO, MySQL, etc.

> Ex: `EloquentUserRepository`, `PdoProductRepository`

### ➤ `Services/`
Implementações de serviços técnicos: envio de e-mail, chamadas HTTP, logs, cache, etc.

> Ex: `LaravelMailService`, `HttpWeatherClient`, `StripePaymentService`

---

## 📁 `app/Http/`

Camada de **interface com o mundo externo** – recebe requisições HTTP e responde.

### ➤ `Controllers/`
Controladores do Laravel – responsáveis por receber a requisição, validar dados e chamar o `UseCase`.

> Ex: `UserController`, `AuthController`

### ➤ `Requests/`
Form Requests do Laravel usados para validação e autorização.

> Ex: `CreateUserRequest`, `LoginRequest`

---

## 🧩 Como as camadas se conectam

```plaintext
[ HTTP Controller ] 
        ↓
[ Application UseCase ]
        ↓
[ Domain Entity / Repository Interface ]
        ↓
[ Infrastructure Repository / Service ]

```
## 🐮 Como usar o Docker Compose com o Sail

```plaintext

Para uma melhor compreensão, vá para o site do Laravel sobre o Sail, ele vai ajudar um pouco:

https://laravel.com/docs/12.x/sail

A seguir, execute os seguintes passos.

No terminal, escreva: 'composer require laravel/sail --dev'

Com ele, você vai tanto instalar o Artisan, Sail e colocar um arquivo YAML do Docker Compose no seu projeto.

No arquivo YAML do Docker Compose, vão ser configurados dois contêineres, um do sistema e outro do MySQL. Pra fins de segurança, modifique as senhas no arquivo YAML do Docker Compose. NÃO. MUDE. OS. USUÁRIOS.

Para que o Sail funcione (no Linux), você deve ir ao '~/.bashrc' e colocar a linha: "alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'"

Para subir os conteineres, use o "sail up". Para fazer com que você veja a tela de boas-vindas, use "sail artisan migrate"

```

## 🔧 Exemplo certo de arquivo ".env" para rodar o container do sistema e do banco de dados

```

No commit 0f57f83, tirei o ".env" do gitignore e deixei ele ser commitado. Nele, você vai poder ver todas as configurações de senha do banco de dados. Como ainda não usamos nenhuma API, não tem problema commitar agora. No caso da chave de "aplication key", tente gerar uma nova com base no comando "php artisan key:generate". De resto, podem trabalhar a vontade, o site não vai entrar em produção mesmo.

```