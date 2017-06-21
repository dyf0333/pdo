# pdo
pdo学习

## 三种pdo链接方式：
        
    参数链接    pdo_connect_params
    url找到文件，通过文件里的链接参数链接    pdo_connect_dsn
    通过php配置文件里的链接参数链接   pdo_connect_dsn_config


## pdo函数：
        
    exec();     pdo_exec
        //exec():执行一条sql语句并返回其受影响的记录的条数,如果没有受影响的记录，他返回0
        //exec对于select没有作用
