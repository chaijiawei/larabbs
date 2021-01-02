#!/bin/bash

source ./.env

if test $# -eq 1
then
  sqlFile=$1
else
  sqlFile=admin.sql
fi

if test -e ${sqlFile}
then
    if [ -n "${DB_PASSWORD}" ]
    then
        mysql -u"${DB_USERNAME}" -p"${DB_PASSWORD}" "${DB_DATABASE}" < "${sqlFile}"
    else
        mysql -u"${DB_USERNAME}" "${DB_DATABASE}" < "${sqlFile}"
    fi
fi
