-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 29 2015 г., 23:33
-- Версия сервера: 5.1.62-community
-- Версия PHP: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `callscript`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ans` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `ans`) VALUES
(1, 'Что вы хотели?\r\nПо какому вопросу?'),
(2, 'Я руководитель'),
(3, 'Чем вы занимаетесь? Что это за компания? '),
(4, 'Никого нет на месте'),
(5, 'Да. Что вы хотели?'),
(6, 'Нет'),
(7, 'Что вы предлагаете? Что вы хотите? Что за сотрудничество'),
(8, 'Нет, нам это не нужно'),
(9, 'Не говорит имени'),
(10, 'Говорит имя'),
(11, 'Далее >>'),
(13, 'Да'),
(14, 'Lorem ipsum dolor sit amet'),
(15, 'Lorem ipsum dolor sit amet'),
(16, 'Lorem ipsum dolor sit amet'),
(17, 'Lorem ipsum dolor sit amet'),
(18, 'Lorem ipsum dolor sit amet'),
(19, 'Lorem ipsum dolor sit amet'),
(20, 'Lorem ipsum dolor sit amet'),
(21, 'Lorem ipsum dolor sit amet'),
(22, 'Lorem ipsum dolor sit amet'),
(23, 'Lorem ipsum dolor sit amet'),
(24, 'Lorem ipsum dolor sit amet'),
(25, 'Lorem ipsum dolor sit amet'),
(26, 'Lorem ipsum dolor sit amet'),
(27, 'Lorem ipsum dolor sit amet'),
(28, 'Lorem ipsum dolor sit amet'),
(29, 'Lorem ipsum dolor sit amet'),
(30, 'Lorem ipsum dolor sit amet'),
(31, 'Lorem ipsum dolor sit amet'),
(32, 'Lorem ipsum dolor sit amet'),
(33, 'Lorem ipsum dolor sit amet'),
(34, 'Lorem ipsum dolor sit amet'),
(35, 'Lorem ipsum dolor sit amet'),
(36, 'Lorem ipsum dolor sit amet'),
(37, 'Lorem ipsum dolor sit amet');

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `user` varchar(20) NOT NULL,
  `block1` varchar(3) NOT NULL,
  `block2` varchar(3) NOT NULL,
  `block3` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (`user`, `block1`, `block2`, `block3`) VALUES
('Admin', 'no', 'no', 'no');

-- --------------------------------------------------------
--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ques` text NOT NULL,
  `block` int(2) NOT NULL,
  `ans` varchar(20) NOT NULL,
  `link` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `ques`, `block`, `ans`, `link`) VALUES
(1, 'Добрый день!<br>\n<em>(пауза, даем возможность поздороваться, не надо торопиться при разговоре!!!)</em><br>\nМеня зовут _СВОЕ_ИМЯ, компания "_КОМПАНИЯ". Это _ИМЯ_КОМПАНИИ, верно?<br>\nДа<br>\nСоедините меня, пожалуйста, с руководителем\n<em>(если нет руководителя, то с коммерческим, если нет коммерческого то с руководителем отдела продаж)</em> ', 0, '1,2,3,4', '4,3,5,6'),
(3, '(Добрый день)<br>\nСкажите, пожалуйста, как я могу к вам обращаться?<br>\n<em>(пауза)</em><br>\nОчень приятно. _ИМЯ_КЛИЕНТА_, Вам сейчас удобно говорить?', 0, '5,6', 'cond1,7'),
(4, 'Вариант №1:<br>\nСкажите, пожалуйста, как я могу к вам обращаться?<br>\nВариант №2:<br>\nИзвините, а вас как зовут?', 0, '9,10', '48,43'),
(5, 'Вариант №1:<br>\nСкажите, пожалуйста, как я могу к вам обращаться?<br>\nВариант №2:<br>\nИзвините, а как вас  зовут?<br>', 0, '9,10', '46,43'),
(6, 'Вариант №1:<br>\nСкажите, пожалуйста, как я могу к вам обращаться?<br>\nВариант №2:<br>\nИзвините, а как вас зовут?', 0, '9,10', '37,42'),
(7, ' _ИМЯ_ Подскажите во сколько вам перезвонить<br><em>(пауза)</em><br>\nСпасибо. Я вам перезвоню', 0, '', ''),
(8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam est quibusdam in esse ad illum minus ut dolorum eius officia quam unde delectus, dolor recusandae sunt voluptates quod quidem hic?', 0, '7,8', '9,18'),
(9, '_ИМЯ_ Давайте, чтобы сэконмить и ваше и наше время мы поступим так: я задам Вам несколько вопросов о вашем бизнесе, чтобы лучше сформулировать свое предложение. Если поймете что будет толк, будем разговаривать дальше. Если нет, то нет. Хорошо?<br><em>Вариант 2:</em><br>Давайте сейчас с вами, для того чтобы сэкономить и ваше и наше время поступим так: я задам несколько вопросов о вашем бизнесе, затем озвучу свое предложение. Если поймете, что вам интересно - будем разговаривать дальше. Если нет -  то нет. Хорошо?', 0, '11', '10'),
(10, 'Скажите, тема увеличения продаж вам интересна?', 2, '13,6', '12,11'),
(11, 'Хорошо. А Вам хотелось бы повысить эффективность работы вашей компании, чтобы не думать о конкурентах?', 3, '13,6', '12,14'),
(12, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6,14,15,16,17,18', 'cond2,15,16,17,27,18'),
(13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6,14,15,16,17,18', 'cond2,15,16,17,27,18'),
(14, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '19,20', '13,18'),
(15, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13,18,21,15', '33,18,17,16'),
(16, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13,6', '23,18'),
(17, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '22,23', '24,44'),
(18, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit! \nПродиктуйте мне, пожалуйста, свой  электронный адрес.\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(19, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13,6,16', '35,18,45'),
(20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13', '25'),
(21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(22, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13', '25'),
(23, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6,13,16', 'cond2,33,17'),
(24, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '16,24,25,26,27', '45,35,30,31,18'),
(25, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '16,24,25,26,27', '45,35,30,31,18'),
(26, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '13,6', '25,18'),
(27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(28, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6,13,16', '18,35,45'),
(29, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '28', '34'),
(30, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(31, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '16', '45'),
(32, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '19', '18'),
(33, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(34, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6', '32'),
(35, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '29,30', '29,33'),
(36, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '29', '29'),
(37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '11', '42'),
(38, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '32', '39'),
(39, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '11', '40'),
(40, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '11', '41'),
(41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(42, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '33,34', '41,38'),
(43, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '', ''),
(45, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '31', '36'),
(46, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '35', '47'),
(47, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '36,34', '42,38'),
(48, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '35', '43'),
(49, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, libero dolores veniam quis. Amet, dolorum quasi cupiditate voluptatibus ab consectetur totam. Magnam sit deserunt sint, dolores eaque modi. Quas, sit!', 0, '6,13', '42,3');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` varchar(50) NOT NULL,
  `value` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `value`) VALUES
('keywords', ''),
('description', 'CallScript'),
('http', 'http://callscript.ru/'),
('site', 'CallScript'),
('str', '10'),
('style', 'default'),
('password', 'extrapass'),
('reg_mail', 'mail@callscript.ru');
-- --------------------------------------------------------

--
-- Структура таблицы `stat`
--

CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user` int(20) NOT NULL,
  `start_time` int(20) NOT NULL,
  `stop_time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(1) NOT NULL,
  `name` varchar(32) NOT NULL,
  `reg_time` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `where` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `level`, `name`, `reg_time`, `time`, `where`) VALUES
(1, 'Admin', '0f52dbccfc7b35279b4d34051c3537a4', '3', 'Дмитрий Сержантов', 1408887287, 1435606369, 'Скрипты');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
