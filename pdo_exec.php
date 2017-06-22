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

	//增
    //$sql='INSERT user(username,password,email) VALUES("dyf","'.md5('123123').'","laravel@qq.com")';
    //改
    //$sql='update user set username="dyf" where id=1';
    //删
    //$sql='delete from user where id=1';

	$res=$pdo->exec($sql);
    echo '受影响的记录的条数为：'.$res,'<br/>';
    //$pdo->lastInsertId():得到新插入记录的ID号
    echo '最后插入的ID号为'.$pdo->lastInsertId(); //lastInsertId只能获取最后insert的ID

    //当sql执行有误，就会有错误码及其错误信息
    if($res===false){
        //$pdo->errorCode():SQLSTATE的值
        echo $pdo->errorCode();
        echo '<hr/>';
        //$pdo->errorInfo():返回的错误信息的数组，数组中包含3个单元
        //0=>SQLSTATE,1=>CODE,2=>INFO
        $errInfo=$pdo->errorInfo();
        print_r($errInfo);
    }

    //查询
    //$sql='select * from user where id=1';
    $sql='select id,username,email from user';
    //$pdo->query($sql)，执行SQL语句，返回PDOStatement对象
    $stmt=$pdo->query($sql);
    var_dump($stmt);
    echo '<hr/>';
    foreach($stmt as $row){
        print_r($row);
        echo '编号：'.$row['id'],'<br/>';
        echo '用户名：'.$row['password'],'<br/>';
        echo '邮箱：'.$row['email'],'<br/>';
        echo '<hr/>';
    }


}catch(PDOException $e){
	echo $e->getMessage();
}


