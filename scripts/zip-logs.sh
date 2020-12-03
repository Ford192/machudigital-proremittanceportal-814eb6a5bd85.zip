#!/bin/bash

LOG_DATE=$(date -d '-5 day' "+%Y-%m-%d")
subDomains=("blotter" "remitportal" "scorecard")

for instance in "${subDomains[@]}"
  do
    logFile="/home/forge/${instance}.instntmny.com/storage/logs/laravel-${LOG_DATE}.log"
    if [ -f "$logFile" ]; then
      /bin/gzip $logFile
    fi
  done
