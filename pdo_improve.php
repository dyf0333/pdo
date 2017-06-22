<?php
/**
 * 链接数据库效率测试
 */
header('content-type:text/html;charset=utf-8');
//1.通过PDO连接数据库
$pStartTime=microtime(true);
for($i=1;$i<=100;$i++){
	$pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
}
$pEndTime=microtime(true);
$res1=$pEndTime-$pStartTime;

//2.通过MySQL连接数据库
$mStartTime=microtime(true);
for($i=1;$i<=100;$i++){
	$link = mysqli_connect('localhost','root','123123');
	mysqli_select_db($link,'laravel');
}
$mEndTime=microtime(true);
$res2=$mEndTime-$mStartTime;
echo $res1,'<br/>',$res2;
echo '<hr/>';
if($res1>$res2){
	echo 'PDO连接数据库MySQL的'.round($res1/$res2).'倍';
}else{
	echo 'MySQL连接数据库PDO的'.round($res2/$res1).'倍';
}


/**
 * 插入数据效率测试
 */
//1.通过PDO连接数据库
$pStartTime=microtime(true);
$pdo=new PDO('mysql:host=localhost;dbname=laravel','root','123123');
$sql='INSERT test2 VALUES(:id)';
$stmt=$pdo->prepare($sql);
for($i=1;$i<=500;$i++){
    $id=1;
    $stmt->bindParam(':id', $id,PDO::PARAM_INT);
    $stmt->execute();
}
$pEndTime=microtime(true);
$res1=$pEndTime-$pStartTime;
unset($pdo);//$pdo=null;
//2.通过MySQL连接数据库
$mStartTime=microtime(true);
$link = mysqli_connect('localhost','root','123123');
mysqli_select_db($link,'laravel');
for($i=1;$i<=500;$i++){
    $sql='INSERT test2 VALUES(2)';
    mysqli_query($link,$sql);
}
mysqli_close($link);
$mEndTime=microtime(true);
$res2=$mEndTime-$mStartTime;
echo $res1,'<br/>',$res2;
echo '<hr/>';
if($res1>$res2){
    echo 'PDO插入500条记录的是MySQL'.round($res1/$res2).'倍';
}else{
    echo 'MySQL插入500条记录的是PDO的'.round($res2/$res1).'倍';
}



