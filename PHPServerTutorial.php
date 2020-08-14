<?php

/** (1) Set variables such as "host" and "port" **/
$host = "127.0.0.1";
$port = 5353;
// No Timeout 
set_time_limit(0);

/** (2) Create Socket **/
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

/** (3) Bind the socket to port and host **/
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");

/** (4) Start listening to the socket **/
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

/** (5) Accept incoming connection **/
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");

/** (6) Read the message from the Client socket **/
$input = socket_read($spawn, 1024) or die("Could not read input\n");
echo "Read from client: " .$input;

/** (7) Reverse the message **/
$output = strrev($input) . "\n";

/** (8) Send message to the client socket **/
socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");

/** (9) Close the sockets **/
socket_close($spawn);
socket_close($socket);
?>