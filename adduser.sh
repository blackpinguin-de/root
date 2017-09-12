#!/bin/bash
name=$1

if (( $# == 1 ))
then
	htpasswd /rcl/www/.htusers $name
else
	echo "Usage: ./adduser.sh name"
fi
