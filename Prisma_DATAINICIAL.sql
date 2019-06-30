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
 1 - Iniciado
 2- Finalizado 
 3- Cancelado

 Order States:
 1 - En progreso
 2- Entregada 
 3- Cancelada
*/	

INSERT INTO `user_types` (`id`, `name`, `description`, `active_flag`) VALUES (NULL,
 'Administrador', 'Es el administrador de una sucursal de Prisma', '1');

INSERT INTO `branches` (`id`, `name`, `active_flag`) VALUES (NULL,
 'San Ramón #1', '1');

INSERT INTO `users` (`id`, `name`, `lastname`, `second_lastname`, `username`, `password`, `email`, `branch_id`, `user_type_id`,
	`active_flag`) VALUES (NULL,'Seney Leonardo', 'Alvarado', 'Carvajal', 'SeneyAlv',
	 '$2y$10$JuEerCyy9tUswU/vkANiqepQn8KsXGZ93/3YYBjIonKbbsfDB2E0a', 'seneyalv@grupoprisma.co.cr', '1', '1', '1');

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

INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('1', 'Inicio', 'Trabajo creado', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('2', 'Entregado', 'Trabajo finalizado satisfactoriamente', '1');
INSERT INTO `states` (`id`, `name`, `description`, `active_flag`) VALUES ('3', 'Cancelado', 'Trabajo cancelado', '1');

INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('1', 'En progreso', '1');
INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('2', 'Entregada', '1');
INSERT INTO `order_states` (`id`, `name`, `active_flag`) VALUES ('3', 'Cancelada', '1');




/************************************************************* *********************************/
INSERT INTO `orders` (`id`, `entry_date`, `quotation_number`, `client_owner`, `client_contact`, 
	`branch_id`, `coin_id`, `exchange_rate`, `total`, `advance_payment`, `active_flag`)
	 VALUES (NULL, '2019-06-06 00:00:00', NULL, '2', '1', '1', '1', '582.11', '2112', NULL, '1');

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
/*********************************************************************************************/

COMMIT;