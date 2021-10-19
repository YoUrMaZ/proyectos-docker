
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE eventoscalendar (
  id int(11) NOT NULL,
  evento varchar(250) DEFAULT NULL,
  color_evento varchar(20) DEFAULT NULL,
  fecha_inicio varchar(20) DEFAULT NULL,
  fecha_fin varchar(20) DEFAULT NULL
);

INSERT INTO eventoscalendar (id, evento, color_evento, fecha_inicio, fecha_fin) VALUES
(51, 'Mi Primera Prueba', 'teal', '2021-07-07', '2021-07-08'),
(52, 'Mi Segunda Prueba', 'amber', '2021-07-17', '2021-07-18'),
(53, 'Mi Tercera Prueba', 'orange', '2021-07-03', '2021-07-04');

ALTER TABLE eventoscalendar
  ADD PRIMARY KEY (id);

ALTER TABLE eventoscalendar
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;
