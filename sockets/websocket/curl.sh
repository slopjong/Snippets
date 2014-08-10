#!/bin/bash

# test the websocket handshake
curl -i -N -H "Connection: Upgrade" -H "Upgrade: websocket" -H "Host: echo.websocket.org" -H "Origin:http://www.websocket.org" http://echo.websocket.org
