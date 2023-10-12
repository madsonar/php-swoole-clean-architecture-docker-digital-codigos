#!/bin/sh

# Nome da rede Docker personalizada
NETWORK_NAME="network-digital-codigos"

docker network inspect $NETWORK_NAME >/dev/null 2>&1 || docker network create --driver bridge $NETWORK_NAME