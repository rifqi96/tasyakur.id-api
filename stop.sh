#!/usr/bin/env bash
bold=$(tput bold)
normal=$(tput sgr0)

if [[ ! $1 ]]; then
  echo "Please add an environment type as the argument. It accepts ${bold}\"prod\"${normal} or ${bold}\"staging\" ${normal} or ${bold}\"local\" ${normal}, i.e., ${bold}./stop.sh local${normal}"
  exit 1
elif [[ $1 = "prod" ]] || [[ $1 = "production" ]]; then
  echo "${bold}Stopping production${normal}"
  sudo docker-compose down -v
  (source 'shell_scripts/shell.env' && bash 'shell_scripts/rmcron.sh')
  echo "${bold}cronjob removed${normal}"
elif [[ $1 = "staging" ]]; then
  echo "${bold}Stopping staging${normal}"
  sudo docker-compose down -v
elif [[ $1 = "local" ]]; then
  echo "${bold}Stopping local${normal}"
  docker-compose down -v
else
  echo "${bold}Wrong environment type${normal}"
  exit 1
fi