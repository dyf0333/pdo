<?php 
header('content-type:text/html;charset=utf-8');
try{
	$dsn='mysql:host=localhost;dbname=laravel';
	$username='root';
	$passwd='123123';
	$pdo=new PDO($dsn, $username, $passwd);
	echo '自动提交：'.$pdo->getAttribute(PDO::ATTR_AUTOCOMMIT); //默认是1，自动开启
	echo '<br/>';
	echo 'PDO默认的错误处理模式：'.$pdo->getAttribute(PDO::ATTR_ERRMODE); //默认是0
	$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0); //0，关闭
	echo '<br/>';
	echo '自动提交：'.$pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);


    //遍历所有pdo属性
    $attrArr=array(
        'AUTOCOMMIT','ERRMODE','CASE','PERSISTENT','TIMEOUT','ORACLE_NULLS',
        'SERVER_INFO','SERVER_VERSION','CLIENT_VERSION','CONNECTION_STATUS'
    );
    foreach($attrArr as $attr){
        echo "PDO::ATTR_$attr: ";
        //constant 获取常量的值
        echo $pdo->getAttribute(constant("PDO::ATTR_$attr")),'<br/>';
    }


    //set 设置属性
    $options=array(
        PDO::ATTR_AUTOCOMMIT=>0,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    );
    //第四个参数
    $pdo=new PDO($dsn, $username, $passwd, $options);
    echo $pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);
    echo '<br/>';
    echo $pdo->getAttribute(PDO::ATTR_ERRMODE);

}catch(PDOException $e){
	echo $e->getMessage();
}