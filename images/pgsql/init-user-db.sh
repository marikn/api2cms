#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE USER api2cms WITH PASSWORD 'temp123';
    CREATE DATABASE api2cms;
    GRANT ALL PRIVILEGES ON DATABASE api2cms TO api2cms;
EOSQL

psql -v ON_ERROR_STOP=1 --username "api2cms" api2cms < /tmp/api2cms.sql
