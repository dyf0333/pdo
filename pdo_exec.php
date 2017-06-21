<?php
header('content-type:text/html;charset=utf-8');

try{
	$pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
	//exec():执行一条sql语句并返回其受影响的记录的条数,如果没有受影响的记录，他返回0
	//exec对于select没有作用
	$sql=<<<EOF
		CREATE TABLE IF NOT EXISTS user(
		id INT UNSIGNED AUTO_INCREMENT KEY,
		username VARCHAR(20) NOT NULL UNIQUE,
		password CHAR(32) NOT NULL,
		email VARCHAR(30) NOT NULL
		);
EOF;
    //	$sql=<<<EOF
//	INSERT user(username,password,email) VALUES("dyf","dyf","dyf@qq.com"),
//	("dyf2","dyf2","dyf@qq.com"),
//	("dyf3","dyf3","dyf@qq.com")
//
//EOF;

	$res=$pdo->exec($sql);
	var_dump($res);	
	$sql='INSERT user(username,password,email) VALUES("dyf","'.md5('123123').'","laravel@qq.com")';
	$res=$pdo->exec($sql);
    echo '受影响的记录的条数为：'.$res,'<br/>';
    //$pdo->lastInsertId():得到新插入记录的ID号
    echo '最后插入的ID号为'.$pdo->lastInsertId();

}catch(PDOException $e){
	echo $e->getMessage();
}


