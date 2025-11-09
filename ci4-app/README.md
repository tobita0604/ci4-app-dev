# CodeIgniter 4 Application with Velzon Admin Template

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter with integrated **Velzon Admin Template**.

## Velzon Admin Template Integration

This project includes the Velzon admin dashboard template, migrated from the original template to be fully compatible with **CodeIgniter 4.6.1** and **PHP 8.3**.

### Features

- ✅ Modern, responsive admin dashboard
- ✅ Bootstrap 5 based UI components
- ✅ Multiple dashboard layouts (vertical, horizontal, two-column)
- ✅ Rich set of UI components and charts
- ✅ CodeIgniter 4.6.1 compatible view syntax
- ✅ PHP 8.3 type-safe controllers

### Admin Panel Access

Access the admin dashboard at: `http://your-domain.com/admin`

### Version Compatibility

- **Framework**: CodeIgniter 4.6.1
- **PHP**: 8.3+
- **Template**: Velzon (migrated and updated)

### Migration Notes

The Velzon template was originally built for an older version of CodeIgniter 4 (PHP 7.4/8.0). Key updates made for compatibility:

1. **View Syntax**: Updated `$this->include()` calls to use proper paths
2. **Asset Paths**: All asset references now use `base_url()` helper
3. **Controllers**: Updated to PHP 8.3 with proper type hints and return types
4. **Routing**: Implemented route groups with namespace routing
5. **Security**: Output escaping with `esc()` helper

### Directory Structure

```
app/
├── Controllers/
│   └── Admin/
│       └── DashboardController.php
├── Views/
│   └── admin/
│       ├── dashboard.php
│       └── partials/
│           ├── main.php
│           ├── title-meta.php
│           ├── head-css.php
│           ├── menu.php
│           ├── topbar.php
│           ├── sidebar.php
│           ├── footer.php
│           ├── vendor-scripts.php
│           ├── page-title.php
│           └── customizer.php
public/
└── assets/
    ├── css/
    ├── js/
    ├── images/
    ├── fonts/
    ├── libs/
    └── scss/
```

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
