#include <bitcoinconsensus.h>

#ifndef PHP_BITCOINCONSENSUS_H
#define PHP_BITCOINCONSENSUS_H

extern zend_module_entry bitcoinconsensus_module_entry;
#define phpext_bitcoinconsensus_ptr &bitcoinconsensus_module_entry

#define PHP_BITCOINCONSENSUS_VERSION "0.1.0" /* Replace with version number for your extension */

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

/* 
  	Declare any global variables you may need between the BEGIN
	and END macros here:     

ZEND_BEGIN_MODULE_GLOBALS(bitcoinconsensus)
	long  global_value;
	char *global_string;
ZEND_END_MODULE_GLOBALS(bitcoinconsensus)
*/

/* In every utility function you add that needs to use variables 
   in php_bitcoinconsensus_globals, call TSRMLS_FETCH(); after declaring other 
   variables used by that function, or better yet, pass in TSRMLS_CC
   after the last function argument and declare your utility function
   with TSRMLS_DC after the last declared argument.  Always refer to
   the globals in your function as BITCOINCONSENSUS_G(variable).  You are 
   encouraged to rename these macros something shorter, see
   examples in any other php module directory.
*/

PHP_FUNCTION(bitcoinconsensus_version);
PHP_FUNCTION(bitcoinconsensus_verify_script);

#ifdef ZTS
#define BITCOINCONSENSUS_G(v) TSRMG(bitcoinconsensus_globals_id, zend_bitcoinconsensus_globals *, v)
#else
#define BITCOINCONSENSUS_G(v) (bitcoinconsensus_globals.v)
#endif

#endif	/* PHP_BITCOINCONSENSUS_H */

