# Inktrap's Model Logger
This package provides a simple way to log model changes in your Laravel application.

## Installation
You can install the package via composer:

```bash
composer require inktrapdesign/model-logger
```

## Setup
You need to the BetterStack Source to your environment file. This is the source that will be used to identify the log entries in BetterStack.

```shell
LOGGER_CHANNEL=default
LOGGER_SOURCE=1234567890
```


## Usage
To enable logging for a model, add the ```ModelLogger``` trait to the model

```php
use InktrapDesign\ModelLogger\ModelLogger;

class User extends Model
{
    use ModelLogger;
}
```

## General Logging
To enable general logging to BetterStack, you first need to create a new channel in the `config/logging.php` file.

```php
'betterstack' => 
  [
    'driver' => 'monolog',
    'level' => env('LOG_LEVEL', 'debug'),
    'handler' => \Logtail\Monolog\LogtailHandler::class,
    'with' => [
        'sourceToken' => env('LOGGER_SOURCE')
    ],
    'processors' => [PsrLogMessageProcessor::class],
  ],
```

You then want to add this channel to the stack, also in the `config/logging.php` file.
```php
'stack' => 
  [
    'driver' => 'stack',
    'channels' => ['single', 'betterstack'],
    'ignore_exceptions' => false,
  ],
```
