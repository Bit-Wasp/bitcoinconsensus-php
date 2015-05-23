
#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_bitcoinconsensus.h"

ZEND_BEGIN_ARG_INFO(arginfo_bitcoinconsensus_verify_script, 0)
    ZEND_ARG_INFO(0, scriptPubKey)
    ZEND_ARG_INFO(0, transaction)
    ZEND_ARG_INFO(0, nInput)
    ZEND_ARG_INFO(0, flags)
    ZEND_ARG_INFO(1, errorFlag)
ZEND_END_ARG_INFO();

/* {{{ proto int bitcoinconsensus_version);
 * Return the version of libbitcoinconsensus */
PHP_FUNCTION(bitcoinconsensus_version)
{
    unsigned int version = bitcoinconsensus_version();
    RETURN_LONG(version);
}
/* }}} */

/* {{{ proto int bitcoinconsensus_verify_script(string scriptPubKey, string transaction, int nInput, int flags, int error);
 * Return true or false for a given scriptPubKey / transaction / nInput */
PHP_FUNCTION(bitcoinconsensus_verify_script)
{
    unsigned char *scriptPubKey, *transaction;
    int scriptPubKeyLen, transactionLen;
    unsigned int nInput, flags;
    zval *scriptErr;
    bitcoinconsensus_error error;
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ssllz", &scriptPubKey, &scriptPubKeyLen, &transaction, &transactionLen, &nInput, &flags, &scriptErr) == FAILURE) {
        return;
    }

    int result = bitcoinconsensus_verify_script(scriptPubKey, scriptPubKeyLen, transaction, transactionLen, nInput, flags, &error);
    ZVAL_LONG(scriptErr, error);
    RETURN_LONG(result);
}
/* }}} */

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
	return SUCCESS;
}

PHP_MSHUTDOWN_FUNCTION(bitcoinconsensus)
{
	return SUCCESS;
}

PHP_MINFO_FUNCTION(bitcoinconsensus)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "bitcoinconsensus support", "enabled");
	php_info_print_table_end();
}

const zend_function_entry bitcoinconsensus_functions[] = {
    PHP_FE(bitcoinconsensus_version, NULL)
    PHP_FE(bitcoinconsensus_verify_script, arginfo_bitcoinconsensus_verify_script)
	PHP_FE_END	/* Must be the last line in bitcoinconsensus_functions[] */
};

zend_module_entry bitcoinconsensus_module_entry = {
	STANDARD_MODULE_HEADER,
	"bitcoinconsensus",
	bitcoinconsensus_functions,
	PHP_MINIT(bitcoinconsensus),
	PHP_MSHUTDOWN(bitcoinconsensus),
	NULL,
	NULL,
	PHP_MINFO(bitcoinconsensus),
	PHP_BITCOINCONSENSUS_VERSION,
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_BITCOINCONSENSUS
ZEND_GET_MODULE(bitcoinconsensus)
#endif
