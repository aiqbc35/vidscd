#说明
>1、下载后，需要composer update

>2、需要给予bootstrap/ storage/ 可读写权限 

>3、需要删除php.ini->disable_functions里面的函数：proc_open，proc_get_status，exec

>4、lnmp1.4需要执行/lnmp/tools/remove_open_basedir_restriction.sh来解决跨目录的问题。

>5、需要在虚拟机文件nginx.conf增加:

    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
##优化
####1. 配置信息缓存

使用以下 Artisan 自带命令，把 `config` 文件夹里所有配置信息合并到一个文件里，减少运行时文件的载入数量：

    php artisan config:cache
    
 上面命令会生成文件 `bootstrap/cache/config.php`，可以使用以下命令来取消配置信息缓存：
 
     php artisan config:clear
     
 此命令做的事情就是把 `bootstrap/cache/config.php` 文件删除。
 
 >注意：配置信息缓存不会随着更新而自动重载，所以，开发时候建议关闭配置信息缓存，一般在生产环境中使用，可以配合 Envoy 任务运行器 一起使用。
 
 ####2. 路由缓存
 
 路由缓存可以有效的提高路由器的注册效率，在大型应用程序中效果越加明显，可以使用以下命令：
 
     php artisan route:cache
     
 以上命令会生成 `bootstrap/cache/routes.php`文件，需要注意的是，路由缓存不支持路由匿名函数编写逻辑，详见：[文档 - 路由缓存](https://doc.laravel-china.org/docs/5.1/controllers#%E8%B7%AF%E7%94%B1%E7%BC%93%E5%AD%98)。
 
 可以使用下面命令清除路由缓存：
 
     php artisan route:clear
     
 此命令做的事情就是把 `bootstrap/cache/routes.php` 文件删除。
 
 >注意：路由缓存不会随着更新而自动重载，所以，开发时候建议关闭路由缓存，一般在生产环境中使用，可以配合 [Envoy 任务运行器](https://doc.laravel-china.org/docs/5.1/envoy) 一起使用。
 
 ####3. 类映射加载优化
 `optimize`命令把常用加载的类合并到一个文件里，通过减少文件的加载，来提高运行效率：
 
     php artisan optimize --force
     
 会生成 `bootstrap/cache/compiled.php` 和 `bootstrap/cache/services.json` 两个文件。
 
 你可以可以通过修改 `config/compile.php` 文件来添加要合并的类。
 
 在 `productio`n 环境中，参数 `--force` 不需要指定，文件就会自动生成。
 
 要清除类映射加载优化，请运行以下命令：
 
     php artisan clear-compiled
     
 此命令会删除上面 `optimize` 生成的两个文件。
 
 >注意：此命令要运行在 `php artisan config:cache` 后，因为 `optimize` 命令是根据配置信息（如：`config/app.php` 文件的 `providers`数组）来生成文件的。
 
 ####4. 自动加载优化
 此命令不止针对于 Laravel 程序，适用于所有使用 `composer`来构建的程序。此命令会把PSR-0和PSR-4转换为一个类映射表，来提高类的加载速度。
 
    composer dumpautoload -o
    
 >注意：`php artisan optimize --force` 命令里已经做了这个操作。
 
 ####[点击参考具体优化](https://laravel-china.org/articles/2020/ten-laravel-5-program-optimization-techniques)