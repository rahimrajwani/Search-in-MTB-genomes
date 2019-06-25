#!/bin/bash
Session_id=$1
cut -f6 tmp/"$Session_id".annotated.txt | cut -f1 -d':' | sort -d |uniq -c | awk '{print "['\''" $2$3 "'\''," $1 "],"}'