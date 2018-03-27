<?php
$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
if(false===$socket){
	$errorno=socket_last_error();
	echo "socket create fail:".socket_strerror($errorno);
	exit();
}
//bind
if(!socket_bind($socket,"127.0.0.1",8099)){
	$errorno=socket_last_error();
	echo "socket bind fail:".socket_strerror($errorno);
	exit();
}

//listen
if(!socket_listen($socket,5)){
	$errorno=socket_last_error();
	echo "socket listen fail:".socket_strerror($errorno);
	exit();
}

//connect
while(1){
	$conn_sock=socket_accept($socket);
	if(!$conn_sock)
		break;
	sleep(60);
	socket_close($conn_sock);
}
