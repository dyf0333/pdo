<?php

/**
 *  通过php配置文件里的dsn获取链接数据
 *      需要先在php.ini 文件定义 链接数据
 *      pdo.dsn.laravel="mysql:host=localhost;dbname=laravel"
 */
try{
	$dsn='laravel';
	$username='root';
	$passwd='123123';
	$pdo=new PDO($dsn,$username,$passwd);
	var_dump($pdo);
}catch(PDOException $e){
	echo $e->getMessage();
}