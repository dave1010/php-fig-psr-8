#!/bin/bash

while true; do inotifywait -r src/ tests/; clear; composer dumpautoload; ./vendor/bin/phpunit; date; done
