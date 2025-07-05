#!/bin/sh

# Usage: wait-for.sh host:port -- command args

HOST=$(echo $1 | cut -d : -f 1)
PORT=$(echo $1 | cut -d : -f 2)

shift

echo "Waiting for $HOST:$PORT to be ready..."

while ! nc -z $HOST $PORT; do
  sleep 1
done

echo "$HOST:$PORT is ready. Running command..."
exec "$@"
