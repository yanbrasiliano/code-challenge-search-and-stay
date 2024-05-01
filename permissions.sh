#!/usr/bin/env bash

echo "Changing group to www-data and setting write permissions for the group"
chgrp -R www-data bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Group changed successfully."
else
  echo "Error changing group."
  exit 1
fi

echo "Setting write permissions for the group"
chmod -R g+w bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Permissions set successfully."
else
  echo "Error setting permissions."
  exit 1
fi

echo "Setting the setgid bit on all directories within bootstrap/, storage/, and storage/logs/"
find bootstrap/ storage/ storage/logs/ -type d -exec chmod g+s {} +
if [ $? -eq 0 ]; then
  echo "Setgid bit set successfully."
else
  echo "Error setting setgid bit."
  exit 1
fi

DIR="/var/www/html/storage/framework/cache/data/"
if [ -d "$DIR" ]; then
  echo "Changing group and setting permissions at $DIR"
  chgrp -R www-data $DIR
  chmod -R g+w $DIR
  echo "Group and permissions successfully set at $DIR"
else
  echo "Directory $DIR not found. Continuing without changing."
fi

echo "Permissions and group properties successfully updated."
