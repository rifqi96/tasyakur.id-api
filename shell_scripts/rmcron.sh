crontab -l | grep -v "$APP_DIR/shell_scripts/copy-logs-to-s3-cronjob.sh"  | crontab -