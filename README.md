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

Version v3.0.0 can be run on PHP versions > 7.0.
 - In theory can be built with versions before Bitcoin Core v0.13.0.

Version v2.0.0 can run on PHP versions 5.3 - 5.6, and PHP 7.0 - 7.2, 7.3-RC
 - It must be built against Bitcoin Core v0.13.0 upwards.

See how to install a certain branch in the installation section.

## Supported features


Script verification flags:

    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NONE
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_P2SH
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_DERSIG
    
    Optional (depends on bitcoinconsensus.h build):
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_CHECKLOCKTIMEVERIFY
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_CHECKSEQUENCEVERIFY
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_WITNESS
    BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY

Error codes for bitcoinconsensus_verify_script{,with_amount}

    BITCOINCONSENSUS_ERR_OK                   no error
    BITCOINCONSENSUS_ERR_TX_INDEX             input index not set in transaction
    BITCOINCONSENSUS_ERR_TX_SIZE_MISMATCH     (not possible)
    BITCOINCONSENSUS_ERR_TX_DESERIALIZE       invalid transaction serialization

    Optional (depends on bitcoinconsensus.h build):
    BITCOINCONSENSUS_ERR_AMOUNT_REQUIRED      used segwit flag with old function
    BITCOINCONSENSUS_ERR_INVALID_FLAGS        invalid script verification flags used

## Compatibility

Script verification constants following the naming `BITCOINCONSENSUS_VERIFY_x`
were removed in favor of those following upstreams naming.

## To Install:
```
    git clone -b v3.0.0 git@github.com:bit-wasp/bitcoinconsensus-php
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
