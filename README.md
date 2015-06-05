# tinyshop-v2
Tiny shop on slim framework with Bootsrap 3, Twig and Eloquent ORM.
</br>Based on https://github.com/Sevnekish/tinyshop

<pre>
git clone https://github.com/Sevnekish/tinyshop-v2.git
cd tinyshop-v2
curl -s http://getcomposer.org/installer | php
php composer.phar install
</pre>

_phinx.yml                  -> phinx.yml
config/_database_config.ini -> config/database_config.ini 

Validator из ларавел нет смысла прикручивать, ибо не все работает, в частности, проверка значений на уникальность в бд. Можно сделать, чтобы работало, но уже проще просто пользоваться ларавелом. Поэтому будет взят отдельный движок для валидаций и на его основе будет разработан свой класс валидатор специально для этого приложения, как было ранее. Но для его работы нужен инстанс бд, который сейчас создается непосредственно в bootstrap файле, поэтому его нужно вынести в отдельный класс.

Откат. Валидация заработала. Применен дьявольский костыль.


Можно воспользоваться миграциями для получения чистой базы данных, либо загрузить дамп базы с готовыми примерами.
vendor/robmorgan/phinx/bin/phinx create NameOfMigration