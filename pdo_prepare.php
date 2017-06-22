<?php 
header('content-type:text/html;charset=utf-8');
try{
	$pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
	$sql='select * from user where username="dyf"';
	//准备SQL语句
	$stmt=$pdo->prepare($sql);
	//执行预处理语句
	$res=$stmt->execute();
	//var_dump($res);
	//fetch():得到结果集中的一条记录
	$row=$stmt->fetch();
	print_r($row);


	//打印全部数据
    //  while循环
	if($res){
		while($row=$stmt->fetch()){
			print_r($row);
			echo '<hr/>';
		}
	}
	//或者 fetchAll
    $rows=$stmt->fetchAll();
    print_r($rows);

    //根据fetch的参数不同，输出 关联数组、对象、或其他形式
    if($res){
		while($row=$stmt->fetch(PDO::FETCH_OBJ)){
			print_r($row);
			echo '<hr/>';
		}
	}
    //根据fetchAll的参数不同，输出 关联数组、对象、或其他形式
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	print_r($rows);
    echo '<hr/>';
    //根据setFetchModel参数不同，输出 关联数组、对象、或其他形式
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows=$stmt->fetchAll();
    print_r($rows);


    $stmt=$pdo->query($sql);
    echo $stmt->fetchColumn(0),'<br/>';
    echo $stmt->fetchColumn(1),'<br/>';
    echo $stmt->fetchColumn(2);

}catch(PDOException $e){
	echo $e->getMessage();
}