#!/bin/bash
cd "$(dirname "$0")" && php -S localhost:8080 -t src
read -p "Press any key to continue..." -n1 -s
