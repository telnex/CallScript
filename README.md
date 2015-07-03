##CMS для речевых скриптов «холодных звонков» 
Версия: 1.0.0
###Описание системы
Пользователь открыв приложение, видит наименования доступных скриптов для выбора. После выбора скрипта, начинает работать по алгоритму. При этом на экран выводится один речевой модуль и вариант(ы) ответов. Кроме вариантов ответа, у звонаря есть возможность из любого места скрипта перейти в начало (кнопка «Стоп звонок») и в главное меню. Если в скрипте присутствуют логические элементы, то они обрабатываются автоматически, т.к. вряд ли пользователь вспомнит, какую он фразу говорил. Каждое нажатие на кнопку «новый звонок» +1 к счетчику звонков. Счетчик звонков расположен на стартовой странице «Новый звонок», а также в личном кабинете пользователя.
Время, потраченное на звонок, выводится в формате XX мин. YY сек. - это время между нажатием на кнопку «новый звонок» и кнопку «стоп-звонок».
Функция автоматического завершение звонка, если пользователь не нажал кнопку «Стоп звонок» и вышел.
Для администраторов создана админ-панель с основными функциями: настройка системы, управление пользователями, создание уведомлений и тд.

Подробное описание системы: http://www.factoblog.ru/2015/07/callscript.html
###Установка
Выгрузить на сервер все файлы, поправить настройки подключения к БД в файле system/core.php и залить дамп _callscript.sql в БД. 

По умолчанию: логин — Admin, пароль — pass.
###Пример
Демонстрационная версия скрипта: http://telwik.ru/callscript/

Логин/Пароль: User/pass.