CREATE DATABASE IF NOT EXISTS `eis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `eis`;


--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `id_depart` int(4) UNSIGNED NOT NULL,
  `name_depart` varchar(250) NOT NULL,
  `description_depart` text NOT NULL,
  `code_depart` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Подразделения/отделы';

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id_depart`, `name_depart`, `description_depart`, `code_depart`) VALUES
(1, 'Конструктора', 'Конструктора123', '001'),
(2, 'Отдел ЧПУ', 'Отдел ЧПУ321', '002'),
(3, 'На пилу', 'На пилу', '003'),
(4, 'Шпонировка', '1-й этаж. Шпонировка, пресса.', '004'),
(5, 'Кромка', 'Кромка', '005'),
(6, 'Присадка', 'Присадка Homag', '006'),
(7, 'Holzhen', 'Holzhen - фрезировка', '007'),
(8, 'SCM', 'SCM', '008'),
(9, 'Малыш - фрезеровка', 'Малыш - фрезеровка', '009'),
(10, 'Столярка', 'Столярка', '010'),
(11, 'Шлифовка', 'Шлифовка', '011'),
(12, 'Малярка', 'Малярка', '012'),
(13, 'Упаковка', 'Упаковка', '013'),
(14, 'Без подразделения', 'Сюда относятся, разнорабочие, уборщики, дворники, помощники в разных отделах, стажировщики и т.п..', '014');


--
-- Структура таблицы `position_worker`
--

CREATE TABLE `position_worker` (
  `id_position` int(4) UNSIGNED NOT NULL,
  `name_position` varchar(255) NOT NULL,
  `department_position` varchar(255) NOT NULL,
  `description_position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Должности';

--
-- Дамп данных таблицы `position_worker`
--

INSERT INTO `position_worker` (`id_position`, `name_position`, `department_position`, `description_position`) VALUES
(1, 'Бухгалтер', 'Бухгалтерия', ''),
(2, 'Генеральный директор', 'Руководители', ''),
(3, 'Водитель', 'Без подразделения', ''),
(4, 'Главный механик', 'Без подразделения', ''),
(5, 'Главный энергетик', 'Без подразделения', ''),
(6, 'Делопроизводитель', 'Без подразделения', ''),
(7, 'Директор производства', 'Руководители', ''),
(8, 'Заместитель директора производства', 'Руководители', ''),
(9, 'Кладовщик', 'Без подразделения', ''),
(10, 'Конструктор', 'Конструктора', ''),
(11, 'Маряр по дереву', 'Малярка', ''),
(12, 'Менеджер проекта', 'Без подразделения', ''),
(13, 'Начальник смены', 'Без подразделения', ''),
(14, 'Начальник снабжения и складского учета', 'Без подразделения', ''),
(15, 'Начальник участка ЧПУ', 'Отдел ЧПУ', ''),
(16, 'Начальник цеха мяхкой мебели и камня', 'Без подразделения', ''),
(17, 'Обивщик мягкой мебели', 'Без подразделения', ''),
(18, 'Оператор станка ЧПУ', 'Отдел ЧПУ', ''),
(19, 'ОТК', 'Без подразделения', ''),
(20, 'Подсобный рабочий', 'Без подразделения', ''),
(21, 'Помощник бухгалтера', 'Бухгалтерия', ''),
(22, 'Помощник оператора', 'Отдел ЧПУ', ''),
(23, 'Помощник руководителя', 'Без подразделения', ''),
(24, 'Программист ЧПУ', 'Отдел ЧПУ', ''),
(25, 'Рабочий мягкого цеха', 'Без подразделения', ''),
(26, 'Сборщик', 'Без подразделения', ''),
(27, 'Системный администратор', 'IT-отдел', ''),
(28, 'Станочник', 'Без подразделения', ''),
(29, 'Столяр', 'Столярка', ''),
(30, 'Технический директор', 'Руководители', ''),
(31, 'Упаковщик', 'Упаковка', ''),
(32, 'Швея-раскройщик', 'Без подразделения', ''),
(33, 'Шлифовщик', 'Шлифовка', ''),
(34, 'Шпонировщик', 'Шпонировка', ''),
(37, 'Разнорабочий', 'Без подразделения', 'Помощник по хозяйству.');

-- --------------------------------------------------------

--
-- Структура таблицы `status_tasks`
--

CREATE TABLE `status_tasks` (
  `id_st` int(2) UNSIGNED NOT NULL,
  `name_st` varchar(150) NOT NULL,
  `color_st` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Статусы заданий';

--
-- Дамп данных таблицы `status_tasks`
--

INSERT INTO `status_tasks` (`id_st`, `name_st`, `color_st`) VALUES
(1, 'Назначено', '#001eff'),
(2, 'Приостановлено', '#f4c82a'),
(3, 'Выполнено', '#15b300'),
(4, 'В архив', '#9d00a8');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(12) UNSIGNED NOT NULL,
  `name_task` varchar(250) NOT NULL,
  `priority_task` varchar(100) DEFAULT NULL,
  `status_task` int(2) UNSIGNED NOT NULL,
  `description_task` text NOT NULL,
  `department_task` int(4) UNSIGNED NOT NULL,
  `datetime_create_task` datetime NOT NULL,
  `datetime_out_task` datetime NOT NULL,
  `url_task` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Назначенные задания';

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id_task`, `name_task`, `priority_task`, `status_task`, `description_task`, `department_task`, `datetime_create_task`, `datetime_out_task`, `url_task`) VALUES
(2, 'Тестовое', 'Yes', 2, 'Проверка', 6, '2022-12-27 15:27:59', '2023-01-30 10:00:00', '1'),
(4, 'Кровать', 'Yes', 1, 'Сделать кровать для кого-либо...', 4, '2022-12-28 14:06:45', '2022-12-29 14:00:00', '1'),
(22, 'Шкаф', NULL, 1, 'Спроектировать шкаф купе.', 1, '2022-12-29 11:41:15', '2022-12-29 18:00:00', '1'),
(23, 'test', NULL, 1, 'testtesttestr', 3, '2023-01-17 09:47:31', '2023-01-17 11:48:00', '1'),
(24, 'тест2', NULL, 4, 'тесттесттестfsefsefsefsefsf', 4, '2023-01-17 15:42:23', '2023-01-19 18:42:00', '1'),
(25, 'Проверка', NULL, 3, 'Проверка Проверка Проверка Проверка', 2, '2023-01-19 14:28:14', '2023-01-25 18:00:00', '1'),
(27, 'Кухня', 'Yes', 1, 'Проверка', 5, '2023-01-20 11:34:56', '2023-01-30 11:35:00', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_history`
--

CREATE TABLE `tasks_history` (
  `id_th` int(12) UNSIGNED NOT NULL,
  `id_task` int(12) UNSIGNED NOT NULL,
  `depart_th` int(4) UNSIGNED NOT NULL,
  `depart_out_th` int(4) UNSIGNED NOT NULL,
  `datetime_th` datetime NOT NULL,
  `status_th` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='История/архив заданий';

--
-- Дамп данных таблицы `tasks_history`
--

INSERT INTO `tasks_history` (`id_th`, `id_task`, `depart_th`, `depart_out_th`, `datetime_th`, `status_th`) VALUES
(97, 25, 2, 2, '2023-01-23 08:42:13', 1),
(98, 23, 3, 3, '2023-01-23 08:42:28', 1),
(99, 22, 1, 1, '2023-01-23 08:42:39', 1),
(100, 4, 2, 2, '2023-01-23 08:42:46', 1),
(101, 2, 5, 5, '2023-01-23 08:42:51', 1),
(104, 24, 4, 4, '2023-01-23 08:54:13', 4),
(125, 27, 2, 4, '2023-01-23 12:46:39', 1),
(126, 27, 2, 2, '2023-01-23 13:21:54', 3),
(127, 27, 4, 2, '2023-01-23 13:22:00', 1),
(128, 27, 4, 4, '2023-01-23 13:22:38', 3),
(129, 27, 5, 4, '2023-01-23 13:22:47', 1),
(130, 23, 3, 3, '2023-01-23 13:27:38', 3),
(131, 2, 5, 5, '2023-01-23 13:30:20', 3),
(132, 2, 6, 5, '2023-01-23 13:30:26', 1),
(133, 4, 2, 2, '2023-01-23 14:05:29', 3),
(134, 4, 4, 2, '2023-01-23 14:05:48', 1),
(135, 25, 2, 2, '2023-01-25 15:45:38', 3),
(136, 2, 6, 6, '2024-02-21 14:13:20', 2),
(137, 27, 5, 5, '2024-02-24 03:16:13', 1),
(138, 25, 2, 2, '2024-03-07 11:57:14', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `id_worker` int(5) UNSIGNED NOT NULL,
  `surname_worker` varchar(100) NOT NULL,
  `name_worker` varchar(100) NOT NULL,
  `patronymic_worker` varchar(100) NOT NULL,
  `position_worker` varchar(255) NOT NULL,
  `department_worker` varchar(250) NOT NULL,
  `phone_worker` varchar(16) NOT NULL,
  `login_worker` varchar(25) NOT NULL,
  `password_worker` varchar(255) NOT NULL,
  `pass_nocript_worker` varchar(255) NOT NULL,
  `email_worker` varchar(150) NOT NULL,
  `messager_worker` varchar(150) NOT NULL,
  `description_worker` text NOT NULL,
  `access_level` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Сотрудники';

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`id_worker`, `surname_worker`, `name_worker`, `patronymic_worker`, `position_worker`, `department_worker`, `phone_worker`, `login_worker`, `password_worker`, `pass_nocript_worker`, `email_worker`, `messager_worker`, `description_worker`, `access_level`) VALUES
(1, 'Тестов', 'Тест', 'Тестович', 'Начальник участка ЧПУ', 'Отдел ЧПУ', '+7(111)111-11-11', 'test', '$2y$10$/C9LAk/5oJHhc8JEb9uEKeQ4x2FlG5Ykv4x1pwmaClHw.RPOkmfcm', 'test', 'test@test.ru', 'test', 'test', 15),

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_depart`);

--
-- Индексы таблицы `position_worker`
--
ALTER TABLE `position_worker`
  ADD PRIMARY KEY (`id_position`);

--
-- Индексы таблицы `status_tasks`
--
ALTER TABLE `status_tasks`
  ADD PRIMARY KEY (`id_st`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`);

--
-- Индексы таблицы `tasks_history`
--
ALTER TABLE `tasks_history`
  ADD PRIMARY KEY (`id_th`);

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id_worker`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `id_depart` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `position_worker`
--
ALTER TABLE `position_worker`
  MODIFY `id_position` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `status_tasks`
--
ALTER TABLE `status_tasks`
  MODIFY `id_st` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `tasks_history`
--
ALTER TABLE `tasks_history`
  MODIFY `id_th` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT для таблицы `worker`
--
ALTER TABLE `worker`
  MODIFY `id_worker` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

