#!/bin/bash
docker build  ../ -f Dockerfile --target flux-eco-message-logger-orbital -t fluxms/flux-eco-message-logger-orbital:v2022-01-06-2 -t fluxms/flux-eco-message-logger-orbital:latest