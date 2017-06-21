<?php
/**
 *  通过参数形式连接数据库
 *  最常用，推荐
 */
try{
	$dsn='mysql:host=localhost;dbname=laravel';
	$username='root';
	$passwd='123123';
	$pdo=new PDO($dsn, $username, $passwd);
	var_dump($pdo);
}catch(PDOException $e){
	echo $e->getMessage();
}