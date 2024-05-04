#!/usr/bin/env bash

# Changing the group to www-data and setting write permissions for the group
echo "Changing the group to www-data and setting write permissions for the group"
chgrp -R www-data bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Group changed successfully."
else
  echo "Error changing group."
  exit 1
fi

# Setting write permissions for the group
echo "Setting write permissions for the group"
chmod -R g+w bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Permissions set successfully."
else
  echo "Error setting permissions."
  exit 1
fi

# Setting the setgid bit on all directories within bootstrap/, storage/ and storage/logs/
echo "Setting the setgid bit on all directories inside bootstrap/, storage/ and storage/logs/"
find bootstrap/ storage/ storage/logs/ -type d -exec chmod g+s {} +
if [ $? -eq 0 ]; then
  echo "Bit setgid set successfully."
else
  echo "Error setting setgid bit."
  exit 1
fi

DIR="/var/www/html/storage/framework/cache/data/"
if [ -d "$DIR" ]; then
  echo "Changing the group and setting permissions on $DIR"
  chgrp -R www-data $DIR
  chmod -R g+w $DIR
  echo "Group and permissions successfully set on $DIR"
else
  echo "Directory $DIR not found. Still no change."
fi

echo "Permissions and group properties successfully updated."
