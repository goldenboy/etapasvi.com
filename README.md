README
======

Technology
------------

Linux
Nginx/Apache
PHP 5.2+
MySQL 5+
Symfony 1.3.9

Installation
------------
1. Create /config/databases.yml file:
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

2. Perform SQL-queries from /data/sql in your database.

3. Clear symfony cache:
    ./symfony cc

4. Nginx config can be obtained from /www/nginx_web.conf:
    set $root /home/user/etapasvi.com/www;    
    include /home/user/etapasvi.com/www/nginx_web.conf;

Database archive
------------

[http://www.etapasvi.com/uploads/misc/db.tar.gz.gpg][1]

Contributing
------------

All submissions are welcome:
1. Fork it.
2. Create a branch (`git checkout -b my_contribution`)
3. Commit your changes (`git commit -am "Fixed bug"`)
4. Push to the branch (`git push origin my_contribution`)
5. Create an [Issue][2] with a link to your branch
6. Enjoy a refreshing Tea and wait


[1]: http://www.etapasvi.com/uploads/misc/db.tar.gz.gpg
[2]: http://github.com/github/markup/issues