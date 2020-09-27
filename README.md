# lumen-artisan-storage-link

移植Laravel的 `php artisan storage:link` [创建符号连接]指令到Lumen

# Usage

在 **'app/commands/kernel.php'** 中注册指令：

```
protected $commands = [
	\AdamTyn\Lumen\Artisan\StorageLinkCommand::class
];
```
