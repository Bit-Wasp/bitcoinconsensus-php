
#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_bitcoinconsensus.h"

/* If you declare any globals in php_bitcoinconsensus.h uncomment this:
ZEND_DECLARE_MODULE_GLOBALS(bitcoinconsensus)
*/

ZEND_BEGIN_ARG_INFO(arginfo_bitcoinconsensus_verify_script, 0)
    ZEND_ARG_INFO(0, scriptPubKey)
    ZEND_ARG_INFO(0, transaction)
    ZEND_ARG_INFO(0, nInput)
    ZEND_ARG_INFO(0, flags)
    ZEND_ARG_INFO(1, errorFlag)
ZEND_END_ARG_INFO();

/* True global resources - no need for thread safety here */
static int le_bitcoinconsensus;

/* {{{ PHP_INI
 */
/* Remove comments and fill if you need to have entries in php.ini
PHP_INI_BEGIN()
    STD_PHP_INI_ENTRY("bitcoinconsensus.global_value",      "42", PHP_INI_ALL, OnUpdateLong, global_value, zend_bitcoinconsensus_globals, bitcoinconsensus_globals)
    STD_PHP_INI_ENTRY("bitcoinconsensus.global_string", "foobar", PHP_INI_ALL, OnUpdateString, global_string, zend_bitcoinconsensus_globals, bitcoinconsensus_globals)
PHP_INI_END()
*/
/* }}} */

/* Remove the following function when you have successfully modified config.m4
   so that your module can be compiled into PHP, it exists only for testing
   purposes. */

PHP_FUNCTION(bitcoinconsensus_version)
{
    unsigned int version = bitcoinconsensus_version();
    RETURN_LONG(version);
}

PHP_FUNCTION(bitcoinconsensus_verify_script)
{
    unsigned char *scriptPubKey, *transaction;
    int scriptPubKeyLen, transactionLen;
    unsigned int nInput, flags;
    zval scriptErr;
    bitcoinconsensus_error *error;
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ssllz", &scriptPubKey, &scriptPubKeyLen, &transaction, &transactionLen, &nInput, &flags, &scriptErr) == FAILURE) {
        return;
    }

    int result = bitcoinconsensus_verify_script(scriptPubKey, scriptPubKeyLen, transaction, transactionLen, nInput, flags, &error);
    RETURN_LONG(result);
}

/* Every user-visible function in PHP should document itself in the source */
/* {{{ proto string confirm_bitcoinconsensus_compiled(string arg)
   Return a string to confirm that the module is compiled in */
PHP_FUNCTION(confirm_bitcoinconsensus_compiled)
{
	char *arg = NULL;
	int arg_len, len;
	char *strg;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &arg, &arg_len) == FAILURE) {
		return;
	}

	len = spprintf(&strg, 0, "Congratulations! You have successfully modified ext/%.78s/config.m4. Module %.78s is now compiled into PHP.", "bitcoinconsensus", arg);
	RETURN_STRINGL(strg, len, 0);
}
/* }}} */
/* The previous line is meant for vim and emacs, so it can correctly fold and 
   unfold functions in source code. See the corresponding marks just before 
   function definition, where the functions purpose is also documented. Please 
   follow this convention for the convenience of others editing your code.
*/


/* {{{ php_bitcoinconsensus_init_globals
 */
/* Uncomment this function if you have INI entries
static void php_bitcoinconsensus_init_globals(zend_bitcoinconsensus_globals *bitcoinconsensus_globals)
{
	bitcoinconsensus_globals->global_value = 0;
	bitcoinconsensus_globals->global_string = NULL;
}
*/
/* }}} */

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(bitcoinconsensus)
{
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NONE", 9, CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_P2SH", (1U << 0), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_STRICTENC", (1U << 1), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_DERSIG", (1U << 2), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_LOW_S", (1U << 3), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_NULLDUMMY", (1U << 4), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_SIGPUSHONLY", (1U << 5), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_MINIMALDATA", (1U << 6), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_DISCOURAGE_UPGRADABLE_NOPS", (1U << 7), CONST_CS | CONST_PERSISTENT);
    REGISTER_LONG_CONSTANT("BITCOINCONSENSUS_SCRIPT_FLAGS_VERIFY_CLEANSTACK", (1U << 8), CONST_CS | CONST_PERSISTENT);
	/* If you have INI entries, uncomment these lines 
	REGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(bitcoinconsensus)
{
	/* uncomment this line if you have INI entries
	UNREGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request start */
/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(bitcoinconsensus)
{
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request end */
/* {{{ PHP_RSHUTDOWN_FUNCTION
 */
PHP_RSHUTDOWN_FUNCTION(bitcoinconsensus)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(bitcoinconsensus)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "bitcoinconsensus support", "enabled");
	php_info_print_table_end();

	/* Remove comments if you have entries in php.ini
	DISPLAY_INI_ENTRIES();
	*/
}
/* }}} */

/* {{{ bitcoinconsensus_functions[]
 *
 * Every user visible function must have an entry in bitcoinconsensus_functions[].
 */
const zend_function_entry bitcoinconsensus_functions[] = {
        PHP_FE(bitcoinconsensus_version, NULL)
        PHP_FE(bitcoinconsensus_verify_script, NULL)
	PHP_FE(confirm_bitcoinconsensus_compiled,	NULL)		/* For testing, remove later. */
	PHP_FE_END	/* Must be the last line in bitcoinconsensus_functions[] */
};
/* }}} */

/* {{{ bitcoinconsensus_module_entry
 */
zend_module_entry bitcoinconsensus_module_entry = {
	STANDARD_MODULE_HEADER,
	"bitcoinconsensus",
	bitcoinconsensus_functions,
	PHP_MINIT(bitcoinconsensus),
	PHP_MSHUTDOWN(bitcoinconsensus),
	PHP_RINIT(bitcoinconsensus),		/* Replace with NULL if there's nothing to do at request start */
	PHP_RSHUTDOWN(bitcoinconsensus),	/* Replace with NULL if there's nothing to do at request end */
	PHP_MINFO(bitcoinconsensus),
	PHP_BITCOINCONSENSUS_VERSION,
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_BITCOINCONSENSUS
ZEND_GET_MODULE(bitcoinconsensus)
#endif

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
