#!/bin/sh

### OBTIENE LAS IMAGENES DEL RADAR DESDE LA WEB DE METEOROLOGIA
### Y LAS COMPRIMIE A JPG
cd /var/www/html/prueba_meteo/img/doppler
# cd  img/doppler/

wget http://www.meteorologia.gov.py/radar/img/350/l10.png -O l10.png
wget http://www.meteorologia.gov.py/radar/img/350/l11.png -O l11.png
wget http://www.meteorologia.gov.py/radar/img/350/l12.png -O l12.png
wget http://www.meteorologia.gov.py/radar/img/350/l13.png -O l13.png
wget http://www.meteorologia.gov.py/radar/img/350/l14.png -O l14.png
wget http://www.meteorologia.gov.py/radar/img/350/l15.png -O l15.png

#BORRADO DE VIDEO ANTERIORES
rm -rf video3.mp4
rm -rf video4.mp4
rm -rf video3.webm
rm -rf video4.webm
rm -rf video3.ogv
rm -rf video4.ogv

#genera un video de 1 segundo por imagen en formato mp4 con la resolucion original
#ffmpeg -framerate 1 -i l1%d.png -c:v libx264 -r 30 -pix_fmt yuv420p  video.mp4
#genera un video de 1 segundo por imagen en formato mp4 con la resolucion 350x300
#ffmpeg -framerate 1 -i l1%d.png -c:v libx264 -r 30 -pix_fmt yuv420p -s 350x300  video2.mp4

ffmpeg -framerate 2  -i l1%d.png -c:v libx264 -r 24 -pix_fmt yuv420p video3.mp4
ffmpeg -framerate 2  -i l1%d.png -c:v libx264 -r 24 -pix_fmt yuv420p -s 350x300  video4.mp4

ffmpeg -i video3.mp4 -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis video3.webm
ffmpeg -i video4.mp4 -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis video4.webm

ffmpeg -i video3.mp4 -q:v 10 -c:v libtheora -c:a libvorbis video3.ogv
ffmpeg -i video4.mp4 -q:v 10 -c:v libtheora -c:a libvorbis video4.ogv

cd -

exit 0
