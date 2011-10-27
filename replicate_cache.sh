#!/bin/sh
# Копирование файлов кэша с неосновных бэкендов.
# Копирование символических сслылок на поддомены в chache на неосновные бэкенды

cd ~/etapasvi.com

for back in "saynt2day20@vaduz.dreamhost.com:/home/saynt2day20/back2.etapasvi.com" 
  do
    # Копирование файлов кэша с неосновных бэкендов.
    rsync -azvP --size-only --exclude='*d.html' -e ssh $back/www/cache/ /home/saynt2day20/etapasvi.com/www/cache/
    # Копирование символических сслылок на поддомены в chache на неосновные бэкенды
    rsync -azvP --links --exclude "*/" -e ssh /home/saynt2day20/etapasvi.com/www/cache/ $back/www/cache/ 
done