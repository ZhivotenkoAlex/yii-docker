<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

## DIRECTORY STRUCTURE

```
common
    assets/              contains common application assets
    config/              contains common configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes
    services/            contains common service classes
    controllers/         contains common controllers
    helpers/             contains common helpers
    views/               contains common views
    widgets/             contains common widgets
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
iulotka
    components/          contains application-specific components
    config/              contains application-specific configurations
    controllers/         contains application-specific controllers
    runtime/             contains application-specific files generated during runtime
    web/                 contains application-specific entry script and Web resources
frontend
    components/          contains application-specific components
    config/              contains application-specific configurations
    controllers/         contains application-specific controllers
    runtime/             contains application-specific files generated during runtime
    web/                 contains application-specific entry script and Web resources
resources/
    js/                  contains common javascript files for both applications
    scss/                contains common styles for both applications
        themes/          contains application-specific theme variables
    images/              contains common image files
    fonts/               contains common font files
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

## Overriding theme colors

By default, application has 2 themes available. Each theme is specific for a website, running on application engine.

Themes location:

```
resources/
    scss/
        themes/
            *.scss
```

Theme variables:

- **$theme-primary**: primary theme color [Example](https://prnt.sc/BMLEfK4aB3e5)
- **$theme-black**: black theme color [Example](https://prnt.sc/HLK2I8q_tQea)
- **$theme-body**: body background color
- **$theme-muted**: muted text color [Example](https://prnt.sc/5LzKfzZUQbIk)
- **$theme-hairline**: hairline borders color [Example](https://prnt.sc/m7ZbBQXYuaD-)

After you've edited theme variables or other styles, don't forget to re-build assets:

```
npm run biuld
```

## Overriding metadata patterns

Each application has it's own metadata patterns. The patterns are defined for next page types:

- Home page
- Leaflets list page
- Leaflet page

Patterns location:

```
uilotka/
    config/
        params.php
gazetki/
    config/
        params.php
```

### How it works

You can insert variables into your pattern in any place and it will be replaced with actual data

- Home page: no variables available
- Leaflets list page:
  - {category_name}: will be replaced with current category name
- Leaflet page:
  - {category_name}: will be replaced with current leaflet's category name
  - {date_from}: will be replaced with current leaflet's start date
  - {date_to}: will be replaced with current leaflet's ending date
