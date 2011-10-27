#!/bin/sh
# ����������� ������ ���� � ���������� ��������.
# ����������� ������������� ������� �� ��������� � chache �� ���������� �������

cd ~/etapasvi.com

for back in "saynt2day20@vaduz.dreamhost.com:/home/saynt2day20/back2.etapasvi.com" 
  do
    # ����������� ������ ���� � ���������� ��������.
    rsync -azvP --size-only --exclude='*d.html' -e ssh $back/www/cache/ /home/saynt2day20/etapasvi.com/www/cache/
    # ����������� ������������� ������� �� ��������� � chache �� ���������� �������
    rsync -azvP --links --exclude "*/" -e ssh /home/saynt2day20/etapasvi.com/www/cache/ $back/www/cache/ 
done