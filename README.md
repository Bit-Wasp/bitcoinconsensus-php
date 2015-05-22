# bitcoinconsensus-php

PHP extension for bitcoinconsensus library for script validation

## Requirements
Only PHP 5.x is supported at the moment - PHP7 will come soon.

## To Install:
```
    git clone git@github.com:bitwasp/bitcoinconsensus-php
    cd bitcoinconsensus-php
    cd bitcoinconsensus-php/bitcoinconsensus
    phpize && ./configure --with-bitcoinconsensus && make && sudo make install
```

## (Optional) - Enable the extension by default!
Add this line to your php.ini files to enable the extension in PHP by default.
```
extension=bitcoinconsensus.so
```

## Examples

### Get version
```php
echo bitcoinconsensus_version() . PHP_EOL;
```
