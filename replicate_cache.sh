#!/bin/sh
# Копирование файлов кэша с неосновных бэкендов.
# Копирование символических сслылок на поддомены в chache на неосновные бэкенды

cd ~/etapasvi.com

for back in "etapasvi@66.147.244.58:/home8/etapasvi/public_html" 
  do
    # Копирование файлов кэша с неосновных бэкендов.
#    rsync -azvP --size-only --exclude='*d.html' -e ssh $back/www/cache/ /home/saynt2day20/etapasvi.com/www/cache/

# сделать удаление файлов d.html, для которых есть i.html
    # Копирование символических сслылок на поддомены в chache на неосновные бэкенды
    rsync -azvP --links --exclude "*/" -e ssh /home/saynt2day20/etapasvi.com/www/cache/ $back/www/cache/ 
done