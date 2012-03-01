#!/bin/sh
# ��������� ���������� �� ����� � ����������

SCRIPT_DIR=`which $0 | xargs dirname`
# ��������: ����� ��������� ������������� ����
PROJECT_DIR="${SCRIPT_DIR}/../"


# �� �����
#chmod -R 775 ${PROJECT_DIR}
find ${PROJECT_DIR} -type d -exec chmod 775 {} \;

# �� �����
find ${PROJECT_DIR} -type f -exec chmod 644 {} \;

# �������
chmod -R 640 ${PROJECT_DIR}config/*

# GIT
find ${PROJECT_DIR}.git/ -type f -exec chmod 664 {} \;
find ${PROJECT_DIR}.git/objects/ -type f -exec chmod 444 {} \;

# ��� �������
find ${PROJECT_DIR}www/cache/ -type f -exec chmod 666 {} \;

# .sh �������
find ${PROJECT_DIR} -type f -name '*.sh' -exec chmod 755 {} \;
chmod 755 ${PROJECT_DIR}symfony
chmod 755 ${PROJECT_DIR}tools/log_monitor

# ����� �����
# cache
# ����������� 777
#cd ${PROJECT_DIR}
#./symfony project:permissions
#chmod 755 symfony

# ����
find ${PROJECT_DIR}log -type d -exec chmod 777 {} \;
find ${PROJECT_DIR}log -type f -exec chmod 666 {} \;

# ��� �������
find ${PROJECT_DIR}cache -type d -exec chmod 777 {} \;
find ${PROJECT_DIR}cache -type f -exec chmod 666 {} \;
