(crontab -l ; echo "00 00 * * * . $APP_DIR/shell_scripts/shell.env; $APP_DIR/shell_scripts/copy-logs-to-s3-cronjob.sh") | crontab -
