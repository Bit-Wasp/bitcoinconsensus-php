# bitcoinconsensus-php

[![Build Status](https://travis-ci.org/Bit-Wasp/bitcoinconsensus-php.svg?branch=master)](https://travis-ci.org/Bit-Wasp/bitcoinconsensus-php)
[![codecov](https://codecov.io/gh/Bit-Wasp/bitcoinconsensus-php/branch/master/graph/badge.svg)](https://codecov.io/gh/Bit-Wasp/bitcoinconsensus-php)

PHP extension for Bitcoin Script validation.

It exposes bindings to the bitcoinconsensus.h library, which exposes the VerifyScript
with a C compatible interface. 

The library is normally build during compilation of Bitcoin Core, and is also distributed
in signed releases of Bitcoin Core. This means you can build your own or
get a trusted copy. 

## Requirements

Version v2.0.0 can run on PHP versions 5.3 - 5.6, and PHP 7.0 - 7.1.

It must be built against Bitcoin Core v0.13.0 upwards. 

## Supported features

    BITCOINCONSENSUS_VERIFY_NONE 
    BITCOINCONSENSUS_VERIFY_P2SH
    BITCOINCONSENSUS_VERIFY_DERSIG
    BITCOINCONSENSUS_VERIFY_CHECKLOCKTIMEVERIFY
    BITCOINCONSENSUS_VERIFY_CHECKSEQUENCEVERIFY
    BITCOINCONSENSUS_VERIFY_WITNESS
    
    Optional (depends on bitcoinconsensus.h build):
    BITCOINCONSENSUS_VERIFY_NULLDUMMY

## Compatibility

v2.0.0 brings the library in line with the expectations upstream. It only
exposes a minimal set of network activated script validation flags in 
[bitcoinconsensus.h](https://github.com/bitcoin/bitcoin/blob/master/src/script/bitcoinconsensus.h).

The BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_* constants have been removed in 
favor of BITCOINCONSENSUS_VERIFY_*. 

At build time, it will check if newer (opt-in) flags are exported (such as 
NULLDUMMY) by the bitcoinconsensus.h. If so, the flags for these will be compiled
in. 

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
