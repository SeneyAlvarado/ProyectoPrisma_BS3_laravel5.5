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
*/	

INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('1',
 'Administrador', 'Es el administrador de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('2', 
 'Recepcionista', 'Recepción de trabajos', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('3',
 'Jefe diseño', 'Es el jefe de diseño de una sucursal de Prisma', '1');
  INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('4',
 'Diseñador', 'Diseñador de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('5',
 'Jefe impresión', 'Jefe impresión de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('6',
 'Impresión', 'Encargado de imprimir trabajos en una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('7',
 'Jefe post producción', 'Jefe post producción de una sucursal de Prisma', '1');
 INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES ('8',
 'Post producción', 'Persona del equipo de post produccion de una sucursal de Prisma', '1');

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

INSERT INTO `clients` (`id`,`type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, 1,'Seney Leonardo', 
	'San Juanillo de Naranjo, 150 metros sur del cementerio del lugar', '207810358', 1);

INSERT INTO `physical_clients` (`id`, `lastname`, `second_lastname`, `client_id`) VALUES (NULL,'Alvarado', 'Carvajal', '1');

INSERT INTO `clients` (`id`,`type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, 2 ,'Acueducto de San Juanillo', 
	'San Juanillo de Naranjo, 150 metros norte de la iglesia del lugar', '3001-52014-520', 1);

INSERT INTO `juridical_clients` (`id`, `client_id`) VALUES (NULL, '2');

INSERT INTO `clients` (`id`, `type`, `name`, `address`, `identification`, `active_flag`) VALUES (NULL, '1', 'Yerick Patricio', 'Copán San Ramón, Alajuela', 'FF154101', '1');

INSERT INTO `physical_clients` (`id`, `lastname`, `second_lastname`, `client_id`) VALUES (NULL, 'Ramírez', 'Villalobos', '3');

INSERT INTO `phones` (`id`, `number`, `client_id`, `active_flag`) VALUES (NULL, '24510000', '2', '1');
INSERT INTO `phones` (`id`, `number`, `client_id`, `active_flag`) VALUES (NULL, '24501111', '2', '1');
INSERT INTO `phones` (`id`, `number`, `client_id`, `active_flag`) VALUES (NULL, '61041376', '1', '1');
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

INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('1', '1', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('2', '2', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('3', '4', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('4', '3', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('5', '5', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('6', '5', '2', '0', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('7', '1', '3', '1', '0', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('8', '3', '3', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('9', '5', '3', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('10', '1', '4', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('11', '3', '4', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('12', '5', '4', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('13', '2', '5', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('14', '3', '5', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('15', '4', '5', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('16', '6', '5', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('17', '2', '6', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('18', '3', '6', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('19', '4', '6', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('20', '6', '6', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('21', '3', '7', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('22', '7', '7', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('23', '3', '8', '1', '1', '1', '1');
INSERT INTO `state_user_types` (`id`, `states_id`, `user_types_id`, `state_notification`, `view_state`, `edit_state`, `active_flag`) VALUES ('24', '7', '8', '1', '1', '1', '1');


/************************************************************* *********************************/
INSERT INTO `orders` (`id`, `entry_date`, `quotation_number`, `client_owner`, `client_contact`, 
	`branch_id`, `coin_id`, `exchange_rate`, `total`, `advance_payment`, `active_flag`)
	 VALUES (NULL, '2019-06-06 00:00:00', NULL, '2', '1', '1', '2', '582.11', '2112', NULL, '1');

INSERT INTO `order_order_states` (`id`, `date`, `order_states_id`, `order_id`, `user_id`) VALUES (NULL, '2019-06-12 00:00:00', '1', '1', '1');

INSERT INTO `works` (`id`, `priority`, `approximate_date`, `entry_date`, `designer_date`, `print_date`, `post_production_date`, `drying_hours`, `observation`, `order_id`, `designer_id`, `product_id`, `active_flag`) 
VALUES (NULL, '1', '2019-06-26 00:00:00', '2019-06-25 00:00:00', NULL, NULL, NULL, NULL, 'Calcomanía DBZ', '1', NULL, '3', '1');

INSERT INTO `works` (`id`, `priority`, `approximate_date`, `entry_date`, `designer_date`, `print_date`, `post_production_date`, `drying_hours`, `observation`, `order_id`, `designer_id`, `product_id`, `active_flag`) 
VALUES (NULL, '0', '2019-12-24 00:00:00', '2019-06-25 00:00:00', NULL, NULL, NULL, NULL, 'Tarjeta navideña', '1', NULL, '2', '1');

INSERT INTO `works` (`id`, `priority`, `approximate_date`, `entry_date`, `designer_date`, `print_date`, `post_production_date`, `drying_hours`, `observation`, `order_id`, `designer_id`, `product_id`, `active_flag`) 
VALUES (NULL, '1', '2019-07-14 00:00:00', '2019-06-25 00:00:00', NULL, NULL, NULL, NULL, 'Seney', '1', NULL, '1', '1');


INSERT INTO `state_work` (`id`, `date`, `states_id`, `work_id`, `user_id`) VALUES (NULL, '2019-06-20 00:00:00', '1', '1', '1');
INSERT INTO `state_work` (`id`, `date`, `states_id`, `work_id`, `user_id`) VALUES (NULL, '2019-06-26 00:00:00', '2', '1', '1');

INSERT INTO `state_work` (`id`, `date`, `states_id`, `work_id`, `user_id`) VALUES (NULL, '2019-06-20 00:00:00', '1', '3', '1');

INSERT INTO `state_work` (`id`, `date`, `states_id`, `work_id`, `user_id`) VALUES (NULL, '2019-06-20 00:00:00', '1', '2', '1');

INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '2', '1', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '1', '1', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '3', '3', '1');
INSERT INTO `client_contacts` (`id`, `client_id`, `contact_id`, `active_flag`) VALUES (NULL, '3', '1', '1');
/*********************************************************************************************/

COMMIT;