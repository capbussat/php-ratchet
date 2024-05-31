# WebSockets Server and Websockets Javascript client
This is a simple broadcast example to play with a websocket PHP server and an HTML page with a Javascript client to send messages. 

You can open any number of windows and send messages between them.

# Its not secure
Only tested locally, no authorization, encryption or validation of data are performed.

# How to start a server?
First start the websockets server.

php src/websocket-server.php

Uses 8080 port.

# How to start the web server?
Second start the web server.
php -S 127.0.0.1:8000 src/index.html

# How to send messages with the JS client?
Open http://127.0.0.1:8000 in your browser and send text messages from any browser window to another browser window. You can open several browser windows at the same time.

# How does it work?
We are following an example from the official Ratchet documentation , https://github.com/ratchetphp/Ratchet/tree/master, and using this article for explanations https://medium.com/@winni4eva/php-websockets-with-ratchet-5e76bacd7548




