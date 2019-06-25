#!/bin/bash
Session_id=$1
cut -f5 tmp/"$Session_id".annotated.txt |grep -oP [0-9][0-9][0-9][0-9] | sort -n |uniq -c | awk '{print "[\""$2"\", "$1"],"}'
sleep 3