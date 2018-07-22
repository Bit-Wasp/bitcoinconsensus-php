dnl $Id$
dnl config.m4 for extension bitcoinconsensus

PHP_ARG_WITH(bitcoinconsensus, for bitcoinconsensus support,
Make sure that the comment is aligned:
[  --with-bitcoinconsensus             Include bitcoinconsensus support])

if test "$PHP_BITCOINCONSENSUS" != "no"; then
  dnl Write more examples of tests here...

  dnl # --with-bitcoinconsensus -> check with-path
  SEARCH_PATH="/usr/local /usr"     # you might want to change this
  SEARCH_FOR="/include/bitcoinconsensus.h"  # you most likely want to change this
  if test -r $PHP_BITCOINCONSENSUS/$SEARCH_FOR; then # path given as parameter
    BITCOINCONSENSUS_DIR=$PHP_BITCOINCONSENSUS
  else # search default path list
    AC_MSG_CHECKING([for bitcoinconsensus files in default path])
    for i in $SEARCH_PATH ; do
      if test -r $i/$SEARCH_FOR; then
        BITCOINCONSENSUS_DIR=$i
        AC_MSG_RESULT(found in $i)
      fi
    done
  fi
  
  if test -z "$BITCOINCONSENSUS_DIR"; then
    AC_MSG_RESULT([not found])
    AC_MSG_ERROR([Please reinstall the bitcoinconsensus distribution])
  fi

  dnl # --with-bitcoinconsensus -> add include path
  PHP_ADD_INCLUDE($BITCOINCONSENSUS_DIR/include)

  dnl # --with-bitcoinconsensus -> check for lib and symbol presence
  LIBNAME=bitcoinconsensus # you may want to change this
  LIBSYMBOL=bitcoinconsensus_version # you most likely want to change this

  PHP_CHECK_LIBRARY($LIBNAME,$LIBSYMBOL,
  [
    PHP_ADD_LIBRARY_WITH_PATH($LIBNAME, $BITCOINCONSENSUS_DIR/$PHP_LIBDIR, BITCOINCONSENSUS_SHARED_LIBADD)
    AC_DEFINE(HAVE_BITCOINCONSENSUSLIB,1,[ ])
  ],[
    AC_MSG_ERROR([wrong bitcoinconsensus lib version or lib not found])
  ],[
    -L$BITCOINCONSENSUS_DIR/$PHP_LIBDIR -lm
  ])

  AC_CHECK_DECLS([bitcoinconsensus_verify_script_with_amount], [], [], [[#include <bitcoinconsensus.h>]])

  AC_CHECK_DECLS([bitcoinconsensus_ERR_AMOUNT_REQUIRED], [], [], [[#include <bitcoinconsensus.h>]])
  AC_CHECK_DECLS([bitcoinconsensus_ERR_INVALID_FLAGS], [], [], [[#include <bitcoinconsensus.h>]])

  AC_CHECK_DECLS([bitcoinconsensus_SCRIPT_FLAGS_VERIFY_NULLDUMMY], [], [], [[#include <bitcoinconsensus.h>]])
  AC_CHECK_DECLS([bitcoinconsensus_SCRIPT_FLAGS_VERIFY_CHECKLOCKTIMEVERIFY], [], [], [[#include <bitcoinconsensus.h>]])
  AC_CHECK_DECLS([bitcoinconsensus_SCRIPT_FLAGS_VERIFY_CHECKSEQUENCEVERIFY], [], [], [[#include <bitcoinconsensus.h>]])
  AC_CHECK_DECLS([bitcoinconsensus_SCRIPT_FLAGS_VERIFY_WITNESS], [], [], [[#include <bitcoinconsensus.h>]])
  AC_CHECK_DECLS([bitcoinconsensus_SCRIPT_FLAGS_VERIFY_ALL], [], [], [[#include <bitcoinconsensus.h>]])

  PHP_SUBST(BITCOINCONSENSUS_SHARED_LIBADD)

  PHP_NEW_EXTENSION(bitcoinconsensus, bitcoinconsensus.c, $ext_shared)
fi


