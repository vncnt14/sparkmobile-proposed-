-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sparkmobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `carappearance`
--

CREATE TABLE `carappearance` (
  `appearance_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `windshield` varchar(255) NOT NULL,
  `interior` varchar(255) NOT NULL,
  `sidemirror` varchar(255) NOT NULL,
  `tires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carcondition`
--

CREATE TABLE `carcondition` (
  `condition_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `battery` varchar(255) NOT NULL,
  `lights` varchar(255) NOT NULL,
  `oil` varchar(255) NOT NULL,
  `water` varchar(255) NOT NULL,
  `brake` varchar(255) NOT NULL,
  `air` varchar(255) NOT NULL,
  `gas` varchar(255) NOT NULL,
  `engine` varchar(255) NOT NULL,
  `tire` varchar(255) NOT NULL,
  `self` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `registered_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `select_service`
--

CREATE TABLE `select_service` (
  `selected_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `servicename_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `services` varchar(225) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `select_service`
--

INSERT INTO `select_service` (`selected_id`, `user_id`, `servicename_id`, `vehicle_id`, `services`, `price`, `total_price`) VALUES
(253, 34, 31, 53, 'Body Wash', '250.00', '250'),
(254, 37, 31, 54, 'Body Wash', '250.00', '250');

-- --------------------------------------------------------

--
-- Table structure for table `servicedone`
--

CREATE TABLE `servicedone` (
  `servicedone_id` int(11) NOT NULL,
  `selected_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `services` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `timer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `servicename_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `servicename_id`, `service_name`, `services`, `price`) VALUES
(16, 31, 'Micro Detail', 'Body Wash', '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `service_names`
--

CREATE TABLE `service_names` (
  `servicename_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_names`
--

INSERT INTO `service_names` (`servicename_id`, `service_name`) VALUES
(31, 'Micro Detail');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `slot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `slotNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `user_id`, `vehicle_id`, `date`, `slotNumber`) VALUES
(639, 34, 53, '2024-03-27 01:03:41', '1'),
(641, 37, 54, '2024-03-27 01:04:46', '2');

-- --------------------------------------------------------

--
-- Table structure for table `total_price`
--

CREATE TABLE `total_price` (
  `total_price_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `selected_id` int(11) NOT NULL,
  `servicename_id` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `contact`, `address`, `email`, `username`, `password`, `role`, `profile`) VALUES
(34, 'Vincent', 'Crame', '09292497885', 'Davao City', 'vincentcrame7@gmail.com', 'vincent', 'crame', 'User', 0x75706c6f6164732f3131312e6a7067),
(35, '', '', '', '', '', 'admin', 'admin', 'Admin', ''),
(36, '', '', '', '', '', 'staff', 'staff', 'Staff', ''),
(37, 'Erwin', 'Acedillo', '09090910', 'Davao City', 'erwin@gmail.com', 'erwin', 'erwin', 'User', 0x75706c6f6164732f3334303633363335355f313130333234343139303539373639355f383139383239383939373835363438343432315f6e2e6a7067),
(38, 'Cristhel', 'Timola', '0985265411', 'Catigan, Davao City', 'alotmotcristhel@gmail.com', 'cristhel', 'timola', 'User', 0x75706c6f6164732f70686f746f5f363237333838373132373439343331303231315f632e6a7067),
(39, 'jess', 'jess', '', '', 'jess@gmail.com', '', 'jess', 'User', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `platenumber` varchar(255) NOT NULL,
  `chassisnumber` varchar(255) NOT NULL,
  `enginenumber` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `user_id`, `label`, `platenumber`, `chassisnumber`, `enginenumber`, `brand`, `model`, `color`, `profile`) VALUES
(53, 34, 'Personal', 'LTO 123', 'GHJ 234', '5WVC10338', 'Toyota', 'Vios', 'Blue', 0x75706c6f6164732f626c7565206361722e77656270),
(54, 37, 'Work', 'HGO 178', 'JGO 778', 'VHCSS12', 'Honda', 'Civic', 'Black', 0x75706c6f6164732f636172312e6a7067),
(57, 38, 'Personal', 'YBV123', '12121212', 'AZZ 5678', 'Suzuki', 'Swift', 'Red', 0x75706c6f6164732f312e77656270),
(59, 34, 'Work', '1CDF', 'FDC11', 'CCD11', 'Toyota', 'Innova', 'Red', 0x75706c6f6164732f636172322e706e67),
(60, 37, 'Work', 'EAP143', 'EAP143', 'EAP143', 'Suzuki', 'Swift', 'Blue', 0x75706c6f6164732f312e77656270);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carappearance`
--
ALTER TABLE `carappearance`
  ADD PRIMARY KEY (`appearance_id`),
  ADD KEY `fk_vehicle_id` (`vehicle_id`);

--
-- Indexes for table `carcondition`
--
ALTER TABLE `carcondition`
  ADD PRIMARY KEY (`condition_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `asdafer` (`vehicle_id`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`registered_id`),
  ADD KEY `fkk_user_id` (`user_id`),
  ADD KEY `fkk_vehicle_id` (`vehicle_id`),
  ADD KEY `fkk_selected_id` (`service_id`) USING BTREE;

--
-- Indexes for table `select_service`
--
ALTER TABLE `select_service`
  ADD PRIMARY KEY (`selected_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fkkk_service_id` (`servicename_id`),
  ADD KEY `fkkk_vehicle_id` (`vehicle_id`);

--
-- Indexes for table `servicedone`
--
ALTER TABLE `servicedone`
  ADD PRIMARY KEY (`servicedone_id`),
  ADD KEY `asdafer1_selected_id` (`selected_id`),
  ADD KEY `asdafer1_vehicle_id` (`vehicle_id`),
  ADD KEY `asdafer1_user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `fk_servicename_id` (`servicename_id`);

--
-- Indexes for table `service_names`
--
ALTER TABLE `service_names`
  ADD PRIMARY KEY (`servicename_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fkk_vehicle_id` (`vehicle_id`);

--
-- Indexes for table `total_price`
--
ALTER TABLE `total_price`
  ADD PRIMARY KEY (`total_price_id`),
  ADD KEY `asdafer_vehicle_id` (`vehicle_id`),
  ADD KEY `asdafer_user_id` (`user_id`),
  ADD KEY `asdafer_servicename_id` (`servicename_id`),
  ADD KEY `asdafer_selected_id` (`selected_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carappearance`
--
ALTER TABLE `carappearance`
  MODIFY `appearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carcondition`
--
ALTER TABLE `carcondition`
  MODIFY `condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `registered_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `select_service`
--
ALTER TABLE `select_service`
  MODIFY `selected_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `servicedone`
--
ALTER TABLE `servicedone`
  MODIFY `servicedone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service_names`
--
ALTER TABLE `service_names`
  MODIFY `servicename_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=642;

--
-- AUTO_INCREMENT for table `total_price`
--
ALTER TABLE `total_price`
  MODIFY `total_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carappearance`
--
ALTER TABLE `carappearance`
  ADD CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `carcondition`
--
ALTER TABLE `carcondition`
  ADD CONSTRAINT `asdafer` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `carcondition_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `registered`
--
ALTER TABLE `registered`
  ADD CONSTRAINT `fkk_selected_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `fkk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fkk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `select_service`
--
ALTER TABLE `select_service`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fkkk_service_id` FOREIGN KEY (`servicename_id`) REFERENCES `service_names` (`servicename_id`),
  ADD CONSTRAINT `fkkk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `servicedone`
--
ALTER TABLE `servicedone`
  ADD CONSTRAINT `asdafer1_selected_id` FOREIGN KEY (`selected_id`) REFERENCES `select_service` (`selected_id`),
  ADD CONSTRAINT `asdafer1_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `asdafer1_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_servicename_id` FOREIGN KEY (`servicename_id`) REFERENCES `service_names` (`servicename_id`);

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `slots_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `total_price`
--
ALTER TABLE `total_price`
  ADD CONSTRAINT `asdafer_selected_id` FOREIGN KEY (`selected_id`) REFERENCES `select_service` (`selected_id`),
  ADD CONSTRAINT `asdafer_servicename_id` FOREIGN KEY (`servicename_id`) REFERENCES `service_names` (`servicename_id`),
  ADD CONSTRAINT `asdafer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `asdafer_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
