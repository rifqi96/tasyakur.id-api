#!/usr/bin/env bash
bold=$(tput bold)
normal=$(tput sgr0)

if [[ ! $1 ]]; then
  echo "Please add an environment type as the argument. It accepts ${bold}\"prod\"${normal} or ${bold}\"staging\" ${normal} or ${bold}\"local\" ${normal}, i.e., ${bold}./start.sh local${normal}"
  exit 1
elif [[ $1 = "prod" ]] || [[ $1 = "production" ]]; then
  echo "${bold}Running production${normal}"
  if [[ $2 = "build" ]]; then
    sudo docker-compose up --build -d
  else
    sudo docker-compose up -d
  fi
  (source 'shell_scripts/shell.env' && bash 'shell_scripts/addcron.sh')
  echo "${bold}cronjob added${normal}"
elif [[ $1 = "staging" ]]; then
  echo "${bold}Running staging${normal}"
  if [[ $2 = "build" ]]; then
    sudo docker-compose up --build -d
  else
    sudo docker-compose up -d
  fi
elif [[ $1 = "local" ]]; then
  echo "${bold}Running local${normal}"
  if [[ $2 = "build" ]]; then
    docker-compose up --build -d
  else
    docker-compose up -d
  fi
else
  echo "${bold}Wrong environment type${normal}"
  exit 1
fi