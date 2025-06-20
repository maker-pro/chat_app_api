# 环境配置信息
 - php版本：`7.3.33`
 
#

# 使用的扩展
[路由](https://github.com/nikic/FastRoute)、[报错](https://github.com/filp/whoops)、[配置](https://github.com/hassankhan/config)

# 
```
	"autoload": {
        "psr-4": {
			...
            "model\\":"model/"
			...
        }
    },
```
每次更新完 `psr-4` 就需要执行一次 `composer dump-autoload`# chat_app_api
