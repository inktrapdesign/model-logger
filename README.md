# Inktrap's Model Logger
This package provides a simple way to log model changes in your Laravel application.

## Installation
You can install the package via composer:

```bash
composer install inktrapdesign/model-logger
```

## Setup
You need to the LogTail Source to your environment file. This is the source that will be used to identify the log entries in LogTail.

```php
LOGTAIL_SOURCE_TOKEN=1234567890
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
