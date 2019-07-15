#!/bin/sh

EC2_INSTANCE_ID=$(curl http://169.254.169.254/latest/meta-data/instance-id)
LOGS_DIR=$LOGS_DIR_PREFIX/$(date "+%Y")/$(date "+%m")/$(date "+%d")/$EC2_INSTANCE_ID

sudo sh -c "docker logs php-fpm --since \"24h\" > $APP_DIR/etc/php/logs/access.log 2>&1"

sudo aws s3 cp $APP_DIR/etc/nginx/logs/ s3://$S3_BUCKET/$LOGS_DIR/nginx/ --recursive
sudo aws s3 cp $APP_DIR/etc/php/logs/ s3://$S3_BUCKET/$LOGS_DIR/php/ --recursive

sudo docker exec nginx sh -c "> /var/log/nginx/access.log && > /var/log/nginx/error.log"
sudo rm -rf ./etc/php/logs/*
