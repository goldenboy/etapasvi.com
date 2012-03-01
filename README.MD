README
======

Technology
------------

Linux
PHP 5.2+
MySQL 5+
Symfony 1.3.9

Installation
------------
1. Create file /config/databases.yml:
    dev:
      propel:
        param:
          classname: DebugPDO
    test:
      propel:
        param:
          classname: DebugPDO
    all:
      propel:
        class: sfPropelDatabase
        param:
          classname: PropelPDO
          dsn: 'mysql:dbname=DBNAME;host=HOST'
          username: USERNAME
          password: 'PASSWORD'
          encoding: utf8
          persistent: true
          pooling: true

2. Execute SQL-queries from /data/sql in your database.

3. Clear symfony cache:
    ./symfony cc

Database archive
------------

http://www.etapasvi.com/uploads/misc/db.tar.gz.gpg

Contributing
------------

All submissions are welcome.