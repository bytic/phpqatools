# bytic QA Tools

A Composer plugin that installs PHP quality-assurance tools and provides
Composer commands for running them.

## Included tools

- PHPUnit and Mockery
- PHP Depend and PHP Mess Detector
- PHP-CS-Fixer
- Composer Normalize and License Checker
- PHPStan with PHPUnit and Mockery extensions
- Psalm with PHPUnit and Mockery plugins
- Roave Security Advisories

The package requires PHP 8.3 or later. Composer selects the newest compatible
tool versions for the PHP version used by your project.

## Installation

```bash
composer require --dev bytic/phpqatools
```

Composer 2.2 and later requires explicit approval before loading plugins. If
Composer does not prompt during installation, allow this plugin in your
project's `composer.json`:

```json
{
  "config": {
    "allow-plugins": {
      "bytic/phpqatools": true
    }
  }
}
```

The plugin provides grouped commands such as `composer bytic:analyze`,
`composer bytic:ci`, `composer bytic:fix`, and `composer bytic:test`.
Individual tools can also be run through their provided Composer commands.

## Development

Run the package checks with:

```bash
composer test
composer analyse
```

Continuous integration runs these checks on PHP 8.3, 8.4, and 8.5.

## Inspiration

- https://github.com/jmolivas/phpqa
- https://github.com/Dealerdirect/php-qa-tools
- https://github.com/bearsunday/BEAR.QATools
- https://github.com/lovullo/phpqatools
- https://github.com/endroid/quality
