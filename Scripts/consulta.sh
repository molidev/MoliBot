#!/bin/bash

#Indicamos los servicios que deseamos consultar
declare -a servicios=("apache2" "plexmediaserver")

#Recorremos los servicios declarados en el array
for i in "${servicios[@]}"
do
   #Comprobamos si el servicio a consultar está activo o nó
   if [[ $(systemctl is-active $i) == "active" ]]; then
	echo "➡ ${i^^} ✅"
   else
    echo "➡ ${i^^} ❌"	
   fi
done
