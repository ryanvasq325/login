#!bin/bash
composer update; composer upgrade; composer du -o
service nginx reload
