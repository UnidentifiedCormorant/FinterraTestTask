
<h1>Инструкция по развёртыванию проекта</h1>


| <h3>Оглавление</h3> | 
| ------------- | 
| [Текст задания](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#текст-задания) | 
| [Ссылки](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#ссылки) | 
| [ПО, необходимые для запуска приложения](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#по-необходимое-для-запуска-приложения) | 
| [Развёртка проекта с использованием Git](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#развёртка-проекта-с-использованием-git) | 
| [Развёртка проекта из архива с Google Drive](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#развёртка-проекта-из-архива-с-google-drive) | 
| [Несколько комментариев касательно кода и приложения](https://github.com/UnidentifiedCormorant/FinterraTestTask/edit/master/README.md#несколько-комментариев-касательно-кода-и-приложения) | 

<h2>Текст задания</h2>

**Задача:**
Используя любой PHP-фреймворк создать приложение, которое имеет следующие возможности: любой пользователь приложения может выбрать любого другого пользователя приложения (кроме себя), чтобы сделать отложенный перевод денежных средств со своего счета на счет выбранного пользователя. При планировании такого перевода пользователь указывает сумму перевода в рублях, дату и время, когда нужно произвести перевод. Сумма перевода ограничена балансом клиента на момент планирования перевода с учетом ранее запланированных и невыполненных его исходящих переводов. Дата и время выбирается с точностью до часа с использованием календаря. Способ выбора пользователя - любой (можно просто ввод ID). Ввод данных должен валидироваться как на стороне клиента, так и на стороне сервера с выводом ошибок пользователю. 
Показать на сайте список всех пользователей и информацию об их одном последнем переводе с помощью одного SQL-запроса к БД. 
Реализовать сам процесс выполнения запланированных переводов. Не допустить ситуации, при которой у какого-либо пользователя окажется отрицательный баланс. 
Написанный для решения задачи код не должен содержать уязвимостей. Процесс регистрации и проверки прав доступа можно не реализовывать. Для этого допустимо добавить дополнительное поле ввода для указания текущего пользователя. Внешний вид страниц значения не имеет. Решение задачи должно содержать:

1. Весь текст поставленного тестового задания.
2. Четкую инструкцию по развертыванию проекта с целью проверки его работоспособности. Приветствуется использование Docker        (не    обязательно).
3. Миграции и сиды для наполнения БД демонстрационными данными. Решение можно прислать ссылкой на хранилище исходного кода        (GitHub, Bitbucket и др.), либо в виде архива.

<h2>Ссылки</h2>

[Проект на GitHub](https://github.com/UnidentifiedCormorant/FinterraTestTask)

[Архив на Google Drive (на всякий случай)](https://drive.google.com/file/d/1PmOTmP301cIxGcDP0yWMQGpEzykePxsW/view?usp=sharing) 

<h2>ПО, необходимое для запуска приложения</h2>
Для развёртывания проекта у вас должны быть установлены:

* **_Git_**
* **_PHP 8.0+_**
* **_Composer_**
* **Лбой локальный веб-сервер (XAMPP, WAMP, OpenServer и т.д.)**

<h2>Развёртка проекта с использованием Git</h2>

1. Откройте консоль, переместитесь в папку, куда будет клонироваться проект. Запустите команду 
```
git clone https://github.com/UnidentifiedCormorant/FinterraTestTask
```

   Дождитесь окончания клонирования.
   
2.	Откройте проект с помощью редактора кода/IDE. Создайте в корне проекта файл с названием **.env** и поместите в него код, представленный ниже.
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:s8Ex79KEKM4E9IenHScQYrCK9mTb2GllsfLVRWlfyGI=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_task_db
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
В данном коде описана конфигурация для СУБД MySQL. В случае использования другой СУБД, содержание файла .env будет отличаться.

3.	Запустите локальный веб-сервер (OpenServer, WAMP, XAMPP). Откройте PhpMyAdmin и создайте пустую базу данных под названием test_task_db.
4.	В проекте в терминале примените команду
```
composer install 
```
для установки необходимых пакетов для работы приложения.

5.	Примените команду 
```
php artisan migrate --seed 
```
для создания таблиц в базе и её заполнения тестовыми данными.

6.	Примените команду
```
php artisan serve
```
для запуска проекта и перейдите по ссылке http://127.0.0.1:8000. Вы должны увидеть страницу входа в веб-приложение.

7.	В приложении реализована простейшая авторизация. Для входа в приложение используйте логин **imTester@gmail.com** и пароль **1234**. Можно так же использовать логин и пароль любого случайным образом сгенерированного пользователя, которые можно скопировать из базы. Пароли не хэшируются.
8.	Примените команду 
```
php artisan queue:work 
```
для работы jobs-ов. Приложение готово к использованию.

После выполнения jobs-а, обновите страницу с приложением для вывода обновлённых данных.

<h2>Развёртка проекта из архива с Google Drive</h2>

**Примечание:** в файле .env описана конфигурация для СУБД MySQL. В случае использования другой СУБД, содержание файла **.env** будет отличаться.

1.	Запустите локальный веб-сервер (OpenServer, WAMP, XAMPP). Откройте PhpMyAdmin и создайте пустую базу данных под названием test_task_db.
2.	В проекте в терминале примените команду
```
composer install 
```
для установки необходимых пакетов для работы приложения.

3.	Примените команду 
```
php artisan migrate --seed 
```
для создания таблиц в базе и её заполнения тестовыми данными.

4.	Примените команду
```
php artisan serve
```
для запуска проекта и перейдите по ссылке http://127.0.0.1:8000. Вы должны увидеть страницу входа в веб-приложение.

5.	В приложении реализована простейшая авторизация. Для входа в приложение используйте логин **imTester@gmail.com** и пароль **1234**. Можно так же использовать логин и пароль любого случайным образом сгенерированного пользователя, которые можно скопировать из базы. Пароли не хэшируются.
6.	Примените команду 
```
php artisan queue:work 
```
для работы jobs-ов. Приложение готово к использованию.

После выполнения jobs-а, обновите страницу с приложением для вывода обновлённых данных.

<h2>Несколько комментариев касательно кода и приложения</h2>

В приложении реализована «ленивая» авторизация, без регистрации, смены пароля и т.д. Сделано это для того, чтобы безболезненно пользоваться фасадом `auth()`.
Касательно queue и jobs – они работают как часы. Для меня было настоящим открытием, что задания в таблице jobs выполнятся, даже если демон не активен. Моей первичный теорией было то, что если мы вызываем для jobs-а метод `delay()`, то демон считает секунды только когда активен. После нескольких простых тестов (запуск демона после истечения времени отсрочки, до истечения времени отсрочки и т.д.), стало понятно, что jobs-ы всегда выполняются в заданное время при активном демоне, а если демон запущен после истечения срока – выполняются тут же. Всё благодаря тому, что в таблицу заносится юниксовое время из метода PHP `time()`. Благодаря этому jobs-ы отработают когда надо, лишь бы был активен демон php artisan queue:work.
В коде предусмотрена строка для быстрой проверки работы jobs-ов.

>Время отсрочки в часах
```PHP
 DoDonateJob::dispatch($data, $this->transferService->transfer->id)
            ->afterCommit()
            ->delay(now()->addHours($this->donatService->CountHours($data)));

        //DoDonateJob::dispatch($data, $this->transferService->transfer->id)->afterCommit()->delay(now()->addSeconds($this->donatService->CountHours($data))); //Для быстрого теста
```

>Время отсрочки в минутах
```PHP
// DoDonateJob::dispatch($data, $this->transferService->transfer->id)
//            ->afterCommit()
//            ->delay(now()->addHours($this->donatService->CountHours($data)));

        DoDonateJob::dispatch($data, $this->transferService->transfer->id)->afterCommit()->delay(now()->addSeconds($this->donatService->CountHours($data))); //Для быстрого теста
```

Пару слов насчёт требования *«Показать на сайте список всех пользователей и информацию об их одном последнем переводе с помощью одного SQL-запроса к БД»* - оно выполнено не совсем честно, так как после запроса идёт обработка коллекции с результатами запроса. В идеале, её быть не должно и запрос должен отправлять нам уже готовые данные.

```php
public function index()
    {
        $usersJoin = User::where('users.id', '<>', auth()->id())
            ->leftJoin('transfers', 'users.id', '=', 'transfers.user_id')
            ->select('*', 'users.id as u_id')
            ->orderBy('transfers.date', 'desc')
            ->get();

        $users = $usersJoin->unique('u_id');

        return view('index', compact('users'));
    }
```
