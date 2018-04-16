# ACF: Page Template Relationships

ACF currently allows us to create [relationship](https://www.advancedcustomfields.com/resources/relationship/) 
fields, where you can link to posts, pages and custom post types. However, what if we want to only link to
certain [page templates](https://developer.wordpress.org/themes/template-files-section/page-template-files/)?

This plugin allows relationships between page templates.

## Pre-requisite

* Composer
* Composer `wordpress-plugin` custom install directory [configured](https://github.com/composer/installers)
* [WordPress installation](https://github.com/gemmadlou/WordPress-Composer-Starter)

## Setup

```
composer require gemmadlou/acf-field-page-template
```

```json
{
  "require": {
    "gemmadlou/acf-field-page-template": "^1.0.0"
  }
}
```

## Usage

### Activate plugin

[Activate](https://codex.wordpress.org/Managing_Plugins) the plugin within the WordPress admin dashboard. 

### Select field type

![](https://snag.gy/BUDzSu.jpg)

Page templates are selected from the dropdown menu where this field is added:

![](https://snag.gy/xgukap.jpg)
