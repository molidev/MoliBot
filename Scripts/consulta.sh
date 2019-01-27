#!/bin/bash

if (( $(ps -ef | grep -v grep | grep $1 | wc -l) > 0 ))
then
echo "$1 ✅"
else
echo "$1 ❌"	
fi
