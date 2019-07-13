use prisma;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 1;
START TRANSACTION;
SET time_zone = "+00:00";

/* 
 Clients:
 Physical client type == 1
 Juridical client type == 2

 Coins:
 id=1 must be Colones 
 id=2 must be Dolars
   
 Work states:
 1 - Recepción
 2- Entregado
 3- Cancelado
 4- Diseño 
 5- Impresion
 6- PostProduccion
 7- Finalizado

 Order States:
 1 - En progreso
 2- Entregada 
 3- Cancelada

 User Types:
 1 - Admin
 2 - Recepcionista
 3 - Jefe Diseño
 4 - Diseño
 5 - Jefe impresión
 6 - Impresión 
 7 - PostProducción
*/	

INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('1',
 'Administrador', 'Administrador de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('2', 
 'Recepcionista', 'Recepción de trabajos', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('3',
 'Jefe diseño', 'Jefe de diseño de una sucursal de Prisma', '1');
  INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('4',
 'Diseñador', 'Diseñador de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('5',
 'Jefe impresión', 'Jefe impresión de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('6',
 'Impresión', 'Encargado de impresión en una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('7',
 'Post Producción', 'Usuario de Post Producción de una sucursal de Prisma', '1');

INSERT INTO `branches` (`id`, `name`, `active_flag`) VALUES (NULL,
 'San Ramón #1', '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`,
	`active_flag`) VALUES (NULL,'Seney Leonardo', 'Alvarado', 'Carvajal', 'SeneyAlv',
	 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'seneyalv@grupoprisma.co.cr', '1', '1', '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
 'Ana', 'Gómez', 'Jiménez', 'AnaGo', 
 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'anarecepcion@gmail.com', '1', '2', NULL, '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
 'Angie', 'López', 'Martínez', 'AnPLM', 
 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'angie@gmail.com', '1', '3', NULL, '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
 'Yerick', 'Ramirez', 'Villalobos', 'YerickRam', 
 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'yerick@gmail.com', '1', '4', NULL, '1');

 INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
  'José', 'Guzmán', 'Arrieta', 'JoGuz', 
  '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'jose.guzman@grupoprisma.co.cr', '1', '5', NULL, '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
 'Adán', 'Talavera', 'Figueres', 'AdnT', 
 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'adan@gmail.com', '1', '6', NULL, '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`, `remember_token`, `active_flag`) VALUES (NULL,
 'Fernando', 'Madrigal', 'Torres', 'FerMa', 
 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'fernado.madrigal@grupoprisma.co.cr', '1', '7', NULL, '1');

INSERT INTO `clients` (`id`,`type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, 1,'Seney Leonardo', 
	'San Juanillo de Naranjo, 150 metros sur del cementerio del lugar', '207810358', 1);

INSERT INTO `physical_clients` (`id`, `lastname`, `second_lastname`, `client_id`) VALUES (NULL,'Alvarado', 'Carvajal', '1');

INSERT INTO `clients` (`id`,`type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, 2 ,'Acueducto de San Juanillo', 
	'San Juanillo de Naranjo, 150 metros norte de la iglesia del lugar', '3001-52014-520', 1);

INSERT INTO `juridical_clients` (`id`, `client_id`) VALUES (NULL, '2');

INSERT INTO `clients` (`id`, `type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, '1', 'Yerick', 'Copán San Ramón, Alajuela', 'FF154101', '1');

INSERT INTO `physical_clients` (`id`, `lastname`, `second_lastname`, `client_id`) VALUES (NULL, 'Ramírez', 'Villalobos', '3');

INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '2', '1', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '1', '1', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '3', '3', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '3', '1', '1');

INSERT INTO `phones` (`id`, `number`, `client_id`, `active_flag`) VALUES (NULL, '24517906', '2', '1');
INSERT INTO `phones` (`id`, `number`, `client_id`, `active_flag`) VALUES (NULL, '86292999', '1', '1');
INSERT INTO `emails` (`id`, `email`, `client_id`, `active_flag`) VALUES (NULL, 'seneyac@gmail.com', '1', '1');

INSERT INTO `materials` (`id`, `name`, `active_flag`, `description`, `branch_id`) VALUES (NULL, 'Lona #7', '1', 'Lona #7 de 7x14', '1');
INSERT INTO `materials` (`id`, `name`, `active_flag`, `description`, `branch_id`) VALUES (NULL, 'Papel adhesivo #5 ', '1', 'Papel adhesivo resistente al agua', '1');
INSERT INTO `materials` (`id`, `name`, `active_flag`, `description`, `branch_id`) VALUES (NULL, 'Tinta roja', '1', 'Tinta roja anticorrosiva', '1');

INSERT INTO `products` (`id`, `name`, `description`, `branch_id`, `active_flag`) VALUES (NULL, 'Tarjeta de presentación', 'Tarjeta de presentación (personal o empresarial)', '1', '1');
INSERT INTO `products` (`id`, `name`, `description`, `branch_id`, `active_flag`) VALUES (NULL, 'Fotografía navideña', 'Fotografía navideña con detallado especial', '1', '1');
INSERT INTO `products` (`id`, `name`, `description`, `branch_id`, `active_flag`) VALUES (NULL, 'Calcomanía', 'Calcomanía super adhesiva', '1', '1');

INSERT INTO `coins` (`id`, `name`, `active_flag`) VALUES (NULL, 'Colón', '1');
INSERT INTO `coins` (`id`, `name`, `active_flag`) VALUES (NULL, 'Dólar', '1');

INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('1', 'Recepción', 'Trabajo creado y en recepción', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('2', 'Entregado', 'Trabajo finalizado satisfactoriamente', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('3', 'Cancelado', 'Trabajo cancelado', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('4', 'Diseño', 'Trabajo está en diseño', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('5', 'Impresión', 'Trabajo está en impresión', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('6', 'Post-producción', 'Trabajo está en post-producción', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('7', 'Finalizado', 'Trabajo está terminado', '1');

INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('1', 'En progreso', '1');
INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('2', 'Entregada', '1');
INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('3', 'Cancelada', '1');

/*Recepcionista-Recepción-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '1', '2', '0', '1', '1', '1');

/*Recepcionista-Cancelado-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '3', '2', '0', '1', '1', '1');

/*Recepcionista-Finalizado-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '7', '2', '0', '1', '1', '1');

/*Recepcionista-Entregado-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '2', '2', '0', '1', '1', '1');

/*Recepcionista-Diseño-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '4', '2', '0', '1', '1', '1');

/*Jefe Diseño-Cancelado-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '3', '3', '0', '1', '1', '1');

/*Jefe Diseño-Diseño-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '4', '3', '1', '1', '1', '1');

/*Jefe Diseño-Impresión-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '5', '3', '0', '1', '1', '1');

/*Diseñador-Diseño-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '4', '4', '1', '1', '1', '1');

/*Diseñador-Impresión-*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '5', '4', '0', '1', '1', '1');

/*Jefe Impresión-Diseño*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '4', '5', '0', '1', '1', '1');

/*Jefe Impresión-Cancelado*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '3', '5', '0', '1', '1', '1');

/*Jefe Impresión-Impresión*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '5', '5', '1', '1', '1', '1');

/*Jefe Impresión-PostProducción*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '6', '5', '0', '1', '1', '1');

/*Impresión-Impresión*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '5', '6', '1', '1', '1', '1');

/*Impresión-PostProducción*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '6', '6', '0', '1', '1', '1');

/*PostProducción-Entregado*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '2', '7', '0', '1', '1', '1');

/*PostProducción-Cancelado*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '3', '7', '0', '1', '1', '1');

/*PostProducción-PostProducción*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '6', '7', '1', '1', '1', '1');

/*PostProducción-Finalizado*/
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES (NULL, '7', '7', '0', '1', '1', '1');

COMMIT;