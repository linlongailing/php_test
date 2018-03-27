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
	socket_getpeername($conn_sock,$addr,$port);
	echo "client connect server:ip=$addr,port=$port".PHP_EOL;
	while(1){
		$data=socket_read($conn_sock,1024);
		if($data===''){
			socket_close($conn_sock);
			echo "client close".PHP_EOL;
			break;
		}else{
			echo "read from client:".$data;
			$data=strtoupper($data);
			socket_write($conn_sock,$data);
		}
	}
	
	socket_close($conn_sock);
}
