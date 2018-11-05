#include <bitcoinconsensus.h>

#ifndef PHP_BITCOINCONSENSUS_H
#define PHP_BITCOINCONSENSUS_H

extern zend_module_entry bitcoinconsensus_module_entry;
#define phpext_bitcoinconsensus_ptr &bitcoinconsensus_module_entry

#define PHP_BITCOINCONSENSUS_VERSION "0.2.0" /* Replace with version number for your extension */

#ifdef PHP_WIN32
#	define PHP_BITCOINCONSENSUS_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_BITCOINCONSENSUS_API __attribute__ ((visibility("default")))
#else
#	define PHP_BITCOINCONSENSUS_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_FUNCTION(bitcoinconsensus_version);
PHP_FUNCTION(bitcoinconsensus_verify_script);
PHP_FUNCTION(bitcoinconsensus_verify_script_with_amount);

#ifdef ZTS
#define BITCOINCONSENSUS_G(v) TSRMG(bitcoinconsensus_globals_id, zend_bitcoinconsensus_globals *, v)
#else
#define BITCOINCONSENSUS_G(v) (bitcoinconsensus_globals.v)
#endif

#endif	/* PHP_BITCOINCONSENSUS_H */

