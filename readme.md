# Laravel 数据填充

## 创建表

### 使用 `migrate` 生成表的迁移文件.

`php artisan make:migration create_articles_table --create=articles`

```shell
➜  laravel-seeder git:(master) ✗ php artisan make:migration create_articles_table --create=articles
Created Migration: 2018_08_25_042752_create_articles_table
➜  laravel-seeder git:(master) ✗
```



### 设计表

编辑刚刚生成的迁移文件. 添加字段 `title`, `content`, `status` 字段.

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->comment('标题');
            $table->text('content')->comment('内容');
            $table->boolean('status')->comment('状态, 1: 显示, 0: 不显示');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

```

### 生成表

`php artisan migrate`

```shell
root@5c9598078ab8:/var/www/laravel-seeder# php artisan migrate
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table
Migrating: 2018_08_25_042752_create_articles_table
Migrated:  2018_08_25_042752_create_articles_table
root@5c9598078ab8:/var/www/laravel-seeder#
```



## 生成 Model

`php artisan make:model Article`

```shell
root@5c9598078ab8:/var/www/laravel-seeder# php artisan make:model Article
Model created successfully.
root@5c9598078ab8:/var/www/laravel-seeder#
```



## 设置虚拟数据

在 `database/factories` 目录下新建文件. 

`ArticleFactory.php`

```php
<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'status' => $faker->boolean(),
    ];
});

```

## 生成虚拟数据

在命令行下. 执行 `php artisan tinker`

先声明命名空间.

`namespace App;`

再创建 20 条数据. 

`factory(Article::class, 20)->create();`

```shell
root@5c9598078ab8:/var/www/laravel-seeder# php artisan tinker
Psy Shell v0.9.6 (PHP 7.2.4-1+ubuntu16.04.1+deb.sury.org+1 — cli) by Justin Hileman
>>> namespace App;
>>> factory(Article::class, 20)->create();
=> Illuminate\Database\Eloquent\Collection {#2874
     all: [
       App\Article {#2870
         title: "Earum at ducimus dolorum hic nihil ea dolorem.",
         content: "Omnis autem est molestias et maiores deserunt sint. Eos iusto sit voluptatem. Cupiditate omnis voluptas maxime quas molestiae culpa nesciunt.",
         status: true,
         updated_at: "2018-08-25 05:09:30",
         created_at: "2018-08-25 05:09:30",
         id: 1,
       },
       App\Article {#2868
         title: "Impedit ipsum repellat omnis provident.",
         content: "Voluptas et sapiente blanditiis velit. Perferendis omnis impedit voluptatum deserunt error. Vitae consequatur ex ipsa vitae. Qui quia illum rerum delectus nemo omnis.",
         status: false,
         updated_at: "2018-08-25 05:09:30",
         created_at: "2018-08-25 05:09:30",
         id: 2,
       },
       // 省略...
     ],
   }
>>>
```

查看数据库, 数据已经生成了. 



![image-20180825131303267](assets/image-20180825131303267.png)

