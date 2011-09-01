#!/bin/sh
# —жатие css

CSS_DIR="${HOME}/etapasvi.com/www/css"

java -jar /home/saynt2day20/opt/yuicompressor-2.4.6/build/yuicompressor-2.4.6.jar ${CSS_DIR}/css.full.css -o ${CSS_DIR}/css.min.css
java -jar /home/saynt2day20/opt/yuicompressor-2.4.6/build/yuicompressor-2.4.6.jar ${CSS_DIR}/m_css.full.css -o ${CSS_DIR}/m_css.min.css