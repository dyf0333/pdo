<?php 
header('content-type:text/html;charset=utf-8');
$username=$_POST['username'];
$password=$_POST['password'];
try{
	$pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
	//echo $pdo->quote($username);
	//$sql="select * from user where username='{$username}' and password='{$password}'";
	//echo $sql;
	//通过quote():返回带引号的字符串，过滤字符串中的特殊字符
	$username=$pdo->quote($username);
	$sql="select * from user where username={$username} and password='{$password}'";
	echo $sql;
	$stmt=$pdo->query($sql);
	//PDOStatement对象的方法：rouCount()：对于select操作返回的结果集中记录的条数，
	//对于INSERT、UPDATE、DELETE返回受影响的记录的条数
	echo $stmt->rowCount();


    //带预处理语句的防注入方式
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql="select * from user where username=:username and password=:password";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(":username"=>$username,":password"=>$password));
    echo $stmt->rowCount();

    //问号占位符
    $pdo=new PDO('mysql:host=localhost;dbname=imooc','root','root');
    $sql="select * from user where username=? and password=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($username,$password));
    echo $stmt->rowCount();

    /**
     * 具体pdo的bind参数数据
     *      可查看 php手册   PDOStatement::bindParam
     */

    /**
     *  通过冒号占位符及bindParam绑定参数，防止注入
     *  新增
     */
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql="INSERT user(username,password,email) VALUES(:username,:password,:email)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":username",$username,PDO::PARAM_STR);
    $stmt->bindParam(":password",$password,PDO::PARAM_STR);
    $stmt->bindParam(":email",$email);
    $username='dyf';
    $password='dyf';
    $email='dyf@dyf.com';
    $stmt->execute();
    $username='MR.dyf';
    $password='MR.dyf';
    $email='MR.dyf@dyf.com';
    $stmt->execute();
    echo $stmt->rowCount();

    /**
     *  通过问号占位符及bindParam绑定参数，防止注入
     *  新增
     */
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql="INSERT user(username,password,email) VALUES(?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(1,$username);      // 注意：从1开始
    $stmt->bindParam(2,$password);
    $stmt->bindParam(3,$email);
    $username='dyf';
    $password='dyf';
    $email='dyf@dyf.com';
    $stmt->execute();
    echo $stmt->rowCount();


    /**
     *  通过冒号占位符及bindParam绑定参数，防止注入
     *  删除
     */
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql='DELETE FROM user WHERE id<:id';
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":id",$id,PDO::PARAM_INT);
    $id=10;
    $stmt->execute();
    echo $stmt->rowCount();


    /**
     *  bindValue
     */
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql='INSERT user(username,password,email) VALUES(?,?,?)';
    $stmt=$pdo->prepare($sql);
    $username='dyf';
    $password='dyf';
    $stmt->bindValue(1,$username);
    $stmt->bindValue(2,$password);
    $stmt->bindValue(3,'dyf@dyf.com');
    $stmt->execute();
    echo $stmt->rowCount();
    $username='dyf';
    $password='dyf';
    $stmt->bindValue(1,$username);
    $stmt->bindValue(2,$password);
    $stmt->execute();
    echo $stmt->rowCount();

    /**
     *  bindColumn 使用方法
     *  列值绑定到指定变量上
     */
    $pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
    $sql='SELECT username,password,email FROM user';
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    echo '结果集中的列数一共有：'.$stmt->columnCount();  //结果集中的列数
    echo '<hr/>';
    print_r($stmt->getColumnMeta(0));    //返回结果集中的列中的数据
    echo '<hr/>';
    $stmt->bindColumn(1, $username);
    $stmt->bindColumn(2,$password);
    $stmt->bindColumn(3, $email);
    while($stmt->fetch(PDO::FETCH_BOUND)){
        echo '用户名：'.$username.'-密码：'.$password.'-邮箱：'.$email.'<hr/>';
    }

    /**
     *  fetchColumn 每次，指针向下一列
     */
    $sql='SELECT username,password,email FROM user';
    $stmt=$pdo->query($sql);
    echo $stmt->fetchColumn(0),'<br/>';
    echo $stmt->fetchColumn(1),'<br/>';
    echo $stmt->fetchColumn(2);

    /**
     *  debugDumpParams
     *  打印预处理语句
     */
    $sql='INSERT user(username,password,email) VALUES(?,?,?)';
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(1, $username,PDO::PARAM_STR);
    $stmt->bindParam(2,$password,PDO::PARAM_STR);
    $stmt->bindParam(3,$email,PDO::PARAM_STR);
    $username='testParam';
    $password='testParam';
    $email='testParam@dyf.com';
    $stmt->execute();
    $stmt->debugDumpParams();

}catch(PDOException $e){
	echo $e->getMessage();
}
