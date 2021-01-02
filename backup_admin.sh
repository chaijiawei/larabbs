#!/bin/bash

source ./.env

admin_tables=(
  admin_menu
  admin_permissions
  admin_role_menu
  admin_role_permissions
  admin_role_users
  admin_roles
  admin_user_permissions
  admin_users
)

if test $# -eq 1
then
  sqlFile=$1
else
  sqlFile=admin.sql
fi

if [ -n "${DB_PASSWORD}" ]
then
    mysqldump -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -t "${DB_DATABASE}" ${admin_tables[*]} > ${sqlFile}
else
    mysqldump -u"${DB_USERNAME}" -t "${DB_DATABASE}" ${admin_tables[*]} > ${sqlFile}
fi

