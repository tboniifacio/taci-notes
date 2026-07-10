# taci-notes

<p align="center">
  <img src="public/assets/images/taci-logo.svg" alt="Taci Notes" height="48">
</p>

<p align="center">Um projeto simples em <strong>Laravel</strong>!</p>

## Sobre

Taci Notes é uma aplicação de notas (CRUD) construída em Laravel, com login por sessão, design próprio e testes automatizados. Projeto de estudo focado em praticar o ciclo completo de uma aplicação Laravel: autenticação, model/migration/controller, views com Tailwind CSS e cobertura de testes.

## Funcionalidades

- Login e logout por sessão
- Criar, editar e excluir notas
- Exclusão em duas etapas (tela de confirmação)
- Cada usuário só vê suas próprias notas
- Soft deletes em notas e usuários

## Tecnologias

- [Laravel 11](https://laravel.com) / PHP 8.2+
- MySQL
- [Tailwind CSS 4](https://tailwindcss.com) via Vite
- Blade
- PHPUnit (testes de feature e unit)

## Como rodar localmente

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure o banco de dados no `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), depois:

```bash
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
npm install
npm run build
```

Sirva a aplicação (via `php artisan serve` ou um virtual host, ex.: Laragon) e acesse `/login`.

## Testes

```bash
php artisan test
```

Os testes rodam em SQLite em memória, sem afetar o banco de desenvolvimento.

## Licença

Projeto de estudo, sem licença específica.
