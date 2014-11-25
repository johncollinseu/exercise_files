#!/bin/bash
for i in {1..100}
do
    if (( $i % 5 == 0 && $i % 3 == 0 ))
    then
      echo "BishBash"
    elif(( $i % 3 == 0 ))
    then  
      echo "Bish"
    elif(( $i % 5 == 0 ))
    then
      echo "Bash"
    else
      echo "$i"
    fi
done