#!/bin/sh

### OBTIENE LAS IMAGENES DEL RADAR DESDE LA WEB DE METEOROLOGIA
### Y LAS COMPRIMIE A JPG
#cd /var/www/html/meteo/img/doppler
cd  img/doppler/
#wget http://www.meteorologia.gov.py/radar/img/350/l10.png -O l10.png
#wget http://www.meteorologia.gov.py/radar/img/350/l11.png -O l11.png
#wget http://www.meteorologia.gov.py/radar/img/350/l12.png -O l12.png
#wget http://www.meteorologia.gov.py/radar/img/350/l13.png -O l13.png
#wget http://www.meteorologia.gov.py/radar/img/350/l14.png -O l14.png
#wget http://www.meteorologia.gov.py/radar/img/350/l15.png -O l15.png

#genera un video de 1 segundo por imagen en formato mp4 con la resolucion original
#ffmpeg -framerate 1 -i l1%d.png -c:v libx264 -r 30 -pix_fmt yuv420p  video.mp4
#genera un video de 1 segundo por imagen en formato mp4 con la resolucion 350x300
#ffmpeg -framerate 1 -i l1%d.png -c:v libx264 -r 30 -pix_fmt yuv420p -s 350x300  video2.mp4
ffmpeg -framerate 2  -i l1%d.png -r 24  video3.mp4
ffmpeg -framerate 2  -i l1%d.png -r 24 -s 350x300  video4.mp4

cd -

#exit 0
