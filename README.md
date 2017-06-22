# pdo
pdo学习

## 三种pdo链接方式：pdo_connect_params.php、pdo_connect_dsn.php、pdo_connect_dsn_config.php

    参数链接    
    url找到文件，通过文件里的链接参数链接    
    通过php配置文件里的链接参数链接   


## pdo函数：pdo_exec.php(exec 和 query)
        
    exec();     
        //exec():执行一条sql语句并返回其受影响的记录的条数,如果没有受影响的记录，他返回0
        //exec对于select没有作用

    lastInsertId()  返回最后插入行的ID

    errorCode() 获取跟数据库句柄上一次操作相关的SQLstate
    errorInfo() 获取跟数据库句柄上一次操作相关的错误信息
    
    query() 执行一条sql语句，返回PDOStatement对象
    
## pdo函数，预处理的形式查询语句：pdo_prepare.php

    prepare()   准备要执行SQL语句，返回PDOStatement对象
    execute()   执行一条预处理语句
    fetch() 、 fetchAll()
        及其输出形式的参数，比如可以关联数组形式、对象形式输出等。。
    fetchColumn()
    
## pdo属性，pdo_attribute.php

    getAttribute()
    setAttribute()
    遍历所有pdo属性
    通过new PDO第四个参数进行属性设置
    
## pdo防注入 login.php、doAction.php
    
    quote   返回带引号的字符串，过滤字符串中的特殊符
    prepare 带预处理语句的防注入方式
        参数 用冒号：占位符
             用问号？占位符
    bindParam() 然后 execute()
    bindValue() 然后 execute()
    bindColumn  列值绑定到指定变量上
    fetchColumn 每次，指针向下一列
    debugDumpParams 打印预处理语句
    
## pdo错误处理  pdo_error.php
    
    通过setAttribute设置报错信息
        /*
         PDO::ERRMODE_SLIENT:默认模式，静默模式
         PDO::ERRMODE_WARNING:警告模式
         PDO::ERRMODE_EXCEPTION:异常模式
         */
         
## pdo事务    pdo_transaction.php
    
    beginTransaction 开启一个事务
    commit           提交事务
    rollBack         回滚事务、
    inTransaction    检测是否在一个内
    
## pdo提升数据库效率   pdo_improve.php

    mysql直连效率更高
    
## pdo链接mysql对象 PdoMySQL.class.php
    
    从链接初始化到获取数据等各种功能
    
## pdo功能实战 app项目

    注册功能
    注册用swiftmailer发送邮件
    通过邮件激活账户
    登录