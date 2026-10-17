# Upgrade — sala/framework

> Framework é `type: project` (esqueleto), não `library`. Igual `laravel/laravel` e `symfony/skeleton` — `composer update` **não** atualiza o esqueleto, só as libs.

## O que atualiza via package manager

| Pacote | Comando | Tipo |
|---|---|---|
| `sala/console` `^1.0` | `composer update sala/console` | packagist — libs PHP |
| `@salasolucoes/mcp` `^1.0.0` | `npm update @salasolucoes/mcp` | npm — MCP server |

```bash
composer show sala/console          # versão instalada
composer outdated                   # libs desatualizadas
npm outdated                        # idem npm
```

> `composer.json` não deve conter `repositories: [{ type: "path", url: "../console" }]` — remove se existir, é legado `file:`.

## O que NÃO atualiza via composer

Esqueleto `sala/framework` (`README`, `bootstrap/app.php`, `config/`, `routes/`, `.gitignore`, `docs/packages.md`, remoção de `mcp/sala` local) foi **copiado** no `composer create-project`. Depois desacopla — vira teu projeto.

```bash
composer update sala/framework      # ERRO — type project não é dependência
composer require sala/framework     # ERRO — idem
```

Igual Laravel: `composer update laravel/framework` ✅ mas `composer update laravel/laravel` ❌ — esqueleto só via Upgrade Guide / Shift / diff.

## Como trazer esqueleto novo (v1.2.0 → v1.3.0)

### A) Projeto clonado direto do framework (origin = salasolucoes/framework)

```bash
# se ainda em abraaosala/tchiowa, troca remote
git remote set-url origin git@github-empresa:salasolucoes/framework.git
git fetch origin --tags
git pull origin main
# ou travar na última tag
git checkout v1.2.0
composer install
npm install
```

### B) Projeto com repo próprio (origin já é teu — caso Makanda e todos derivados) ⭐ caso mais comum

Teu `origin` já aponta pro teu projeto (`salasolucoes/makanda`, `salasolucoes/outro`, etc.). **Não troca `origin`** — adiciona o framework como `upstream`:

```bash
git remote -v
# origin  git@github-empresa:salasolucoes/makanda.git (fetch) ← teu repo, mantém

git remote add upstream git@github-empresa:salasolucoes/framework.git
git fetch upstream --tags

# inspeciona antes de merge
git diff HEAD..upstream/main --stat
git log HEAD..upstream/main --oneline

git merge upstream/main --allow-unrelated-histories
# resolve conflitos (teu código vs esqueleto novo) → commit
composer install
npm install
```

Travar numa release específica:

```bash
git fetch upstream --tags
git merge v1.2.0 --allow-unrelated-histories
```

Depois disso `git push origin main` vai pro **teu** repo, não pro framework.

### C) Projeto criado via `composer create-project` sem `.git`

```bash
git init
git remote add upstream git@github-empresa:salasolucoes/framework.git
git fetch upstream --tags
git merge upstream/main --allow-unrelated-histories
# resolve conflitos → commit
composer install
npm install
```

### D) Projeto novo (já vem na última)

```bash
composer create-project sala/framework nome-do-projeto
# = salasolucoes/framework@v1.2.0 + sala/console ^1.0 + @salasolucoes/mcp ^1.0.0
```

## Histórico de migrações do esqueleto

| Versão | O que mudou no esqueleto | Ação |
|---|---|---|
| `v1.2.0` | `abraaosala/tchiowa` → `salasolucoes/framework`, `salaab/framework` → `sala/framework` (`composer.json` + `package.json`), `salaab/framwork` → `sala/framework` no README, `salaab/base` → `sala/framework` no `create-project`, `mcp/sala` removido (extraído para `@salasolucoes/mcp` `^1.0.0` + `npm install`), `docs/packages.md` criado, `.gitignore: /docs → /docs/* + !/docs/packages.md`, link `## 📦 Ecossistema` no README, MCP universal `findProjectRoot()` + `SALA_PROJECT_ROOT` | `git pull` + `npm install` + remover `mcp/sala/` local |
| `v1.1.0` | `boost-tchiowa` T-B1..T-B5 — Guidelines+Skills+MCP+Pint | `git pull` + `composer update` + `npm install` |
| `v1.0.x` | `console` extraído para `sala/console` | `composer update sala/console` |

Ver releases: https://github.com/salasolucoes/framework/releases

## Anti-patterns

- Não adicionar `sala/framework` em `require` — é project, não library.
- Não manter `repositories: path` para `../console` ou `file:../mcp` — já estão publicados.
- Não commitar `vendor/` nem `node_modules/` — já em `.gitignore`.
