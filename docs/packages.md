# Ecossistema Sala — Pacotes

> Framework consome 2 pacotes externos. Este arquivo mapeia registry ↔ GitHub ↔ instalação.

| Pacote | Registry | GitHub | Tipo |
|---|---|---|---|
| **`sala/console`** | [Packagist `sala/console`](https://packagist.org/packages/sala/console) `^1.0` | [`salasolucoes/console`](https://github.com/salasolucoes/console) `git@github-empresa:salasolucoes/console.git` | PHP — comandos `php console` (`make:*`, `migrate`, `db:*`, `serve`) |
| **`@salasolucoes/mcp`** | [npm `@salasolucoes/mcp`](https://www.npmjs.com/package/@salasolucoes/mcp) `^1.0.0` | [`salasolucoes/mcp`](https://github.com/salasolucoes/mcp) `git@github-empresa:salasolucoes/mcp.git` | Node — MCP server `sala-boost` (`sala_info`, `sala_schema`, `sala_query`, `sala_logs`) |
| **`sala/framework`** | `composer create-project sala/framework` · `private: true` (este repo) | [`salasolucoes/framework`](https://github.com/salasolucoes/framework) `git@github-empresa:salasolucoes/framework.git` | Boilerplate PHP `^8.4` + Illuminate + BladeOne + Phinx + Vite |

## Instalação

```bash
# PHP — console (via Composer)
composer require sala/console:^1.0

# Node — MCP (via npm)
npm install -D @salasolucoes/mcp
# opencode.json / .mcp.json
# "command": ["node", "node_modules/@salasolucoes/mcp/dist/index.js"]
# ou binário: "command": "sala-mcp"
```

## Notas

- `github-empresa` é alias SSH para `github.com` da org `salasolucoes`.
- `@sala/mcp` indisponível (`org sala` tomada) → fallback `@salasolucoes/mcp`.
- Framework `composer.json` → `sala/console: ^1.0` + `package.json` → `@salasolucoes/mcp: ^1.0.0` (registry, não `file:../`).
