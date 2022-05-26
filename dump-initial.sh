#!/bin/bash -x
​
mysql -u root -p appdoc_3 < tt_docxyz/dump.sql
docker exec -i mysql-container mysql -u root -pSenha123 < tt_docxyz/dump.sql