#!/bin/sh 
 
### OBTIENE LAS IMAGENES DEL RADAR DESDE LA WEB DE METEOROLOGIA 
### Y LAS COMPRIMIE A JPG 
cd /var/www/html/meteo/img/doppler
wget http://www.meteorologia.gov.py/radar/img/350/l10.png -O l10.png 
wget http://www.meteorologia.gov.py/radar/img/350/l11.png -O l11.png 
wget http://www.meteorologia.gov.py/radar/img/350/l12.png -O l12.png 
wget http://www.meteorologia.gov.py/radar/img/350/l13.png -O l13.png 
wget http://www.meteorologia.gov.py/radar/img/350/l14.png -O l14.png 
wget http://www.meteorologia.gov.py/radar/img/350/l15.png -O l15.png 
/var/www/html/meteo/class/doppler_resize_img.php 
 
exit 0
