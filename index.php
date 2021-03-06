<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
head('Главная');?>
<h1>CMS для речевых скриптов «холодных звонков»</h1>
<p><i>Версия: 1.0.0</i></p>
<h2>Описание системы</h2>
<p>Пользователь открыв приложение, видит наименования доступных скриптов для выбора. После выбора скрипта, начинает работать по алгоритму. При этом на экран выводится один речевой модуль и вариант(ы) ответов. Кроме вариантов ответа, у звонаря есть возможность из любого места скрипта перейти в начало (кнопка "Стоп звонок") и в главное меню. Если в скрипте присутствуют логические элементы, то они обрабатываются автоматически, т.к. вряд ли пользователь вспомнит, какую он фразу говорил. Каждое нажатие на кнопку «новый звонок» +1 к счетчику звонков. Счетчик звонков расположен на стартовой странице «Новый звонок», а также в личном кабинете пользователя. чтобы звонарь его видел. Время, потраченное на звонок, выводится в формате XX мин. YY сек. - это время между нажатием на кнопку "новый звонок" и кнопку "стоп-звонок". Автоматическое завершение звонка, если пользователь не нажал кнопку «Стоп звонок» и вышел.</p>
<p>Для администраторов создана админ-панель с основными функциями: настройка системы, управление пользователями, создание уведомлений и тд.</p>
<h2>Структура системы</h2>
<p>Главная → Модуль речевых скриптов.<br>
Главная → Личный кабинет.<br>
Главная → Статистика.<br>
Главная → Рейтинг.<br>
Главная → Онлайн.<br>
Главная → Помощь.<br>
Главная → Админ-панель.<br>
Админ-панель → Управление пользователями.<br>
Админ-панель → Управление уведомлениями.<br>
Админ-панель → Статистика системы.<br>
Админ-панель → Настройка системы.</p>
<?php
foot($t);
exit;
?>