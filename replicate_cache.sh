#!/bin/sh
# ����������� ������ ���� � ���������� ��������.
# ����������� ������������� ������� �� ��������� � chache �� ���������� �������

cd ~/etapasvi.com

for back in "etapasvi@66.147.244.58:/home8/etapasvi/public_html" 
  do
    # ����������� ������ ���� � ���������� ��������.
#    rsync -azvP --size-only --exclude='*d.html' -e ssh $back/www/cache/ /home/saynt2day20/etapasvi.com/www/cache/

# ������� �������� ������ d.html, ��� ������� ���� i.html
    # ����������� ������������� ������� �� ��������� � chache �� ���������� �������
    rsync -azvP --links --exclude "*/" -e ssh /home/saynt2day20/etapasvi.com/www/cache/ $back/www/cache/ 
done