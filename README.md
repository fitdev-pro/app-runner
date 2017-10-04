# FitAppRunner

HTTP application creator.

## Installation

```
composer require fitdev-pro/app-runner
```

## Usage

Base usage
```php
<?php
$di = new DependencyContainer();
$app = new FitdevPro\FitAppRunner\Application($di);
$app->handle()->dispatch();
```

## Contribute

Please feel free to fork and extend existing or add new plugins and send a pull request with your changes!
To establish a consistent code quality, please provide unit tests for all your changes and may adapt the documentation.

## License

The MIT License (MIT). Please see [License File](https://github.com/fitdev-pro/app-runner/blob/master/LISENCE) for more information.
