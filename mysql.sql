-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 05:58 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creator`
--

-- --------------------------------------------------------

--
-- Table structure for table `extra_page`
--

CREATE TABLE `extra_page` (
  `id` int(11) NOT NULL,
  `name_function` text,
  `name_description` text,
  `project_id` text,
  `id_view` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_complete_code`
--

CREATE TABLE `field_complete_code` (
  `id` int(11) NOT NULL,
  `id_form` text,
  `full_code` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_data`
--

CREATE TABLE `field_data` (
  `id` int(11) NOT NULL,
  `id_form` text,
  `id_field` text,
  `data_name` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_data_lookup`
--

CREATE TABLE `field_data_lookup` (
  `id` int(11) NOT NULL,
  `id_form` text,
  `id_field` text,
  `lookup_name` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_session`
--

CREATE TABLE `field_session` (
  `id` int(11) NOT NULL,
  `id_form` text,
  `role` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_set`
--

CREATE TABLE `field_set` (
  `id` int(11) NOT NULL,
  `type_field` text,
  `id_name` text,
  `label` text,
  `placeholder` text,
  `required` int(11) NOT NULL,
  `breakline` int(11) NOT NULL,
  `html_code` text,
  `id_form` text,
  `data_lookup` int(11) NOT NULL,
  `data_hardcode` int(11) NOT NULL,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graph_column`
--

CREATE TABLE `graph_column` (
  `id` int(11) NOT NULL,
  `tbl` text,
  `column_graph` text,
  `id_graph` text,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graph_create`
--

CREATE TABLE `graph_create` (
  `id` int(11) NOT NULL,
  `id_graph` text,
  `graph_type` text,
  `graph_operation` text,
  `graph_name` text,
  `graph_duration` text,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `graph_desc` text,
  `tbl` text,
  `graph_column` text,
  `graph_title` text,
  `graph_label` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE `project_file` (
  `id` int(11) NOT NULL,
  `id_form` text,
  `table_name` text,
  `module` text,
  `sub_module` text,
  `controller_name` text,
  `description_name` text,
  `insert_file` text,
  `update_file` text,
  `list_file` text,
  `project_id` text,
  `navbar_show` text,
  `icon` text,
  `module_avatar` text,
  `api` text,
  `api_id` text,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_login`
--

CREATE TABLE `project_login` (
  `id` int(11) NOT NULL,
  `first_name` text,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `setup_register` int(11) NOT NULL,
  `team_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_lookup_helper`
--

CREATE TABLE `project_lookup_helper` (
  `id` int(11) NOT NULL,
  `table_name` text,
  `column_name` text,
  `function_name` text,
  `validate_by` text,
  `segment` text,
  `column_segment` text,
  `project_id` text,
  `uid` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_role`
--

CREATE TABLE `project_role` (
  `id` int(11) NOT NULL,
  `role` text,
  `project_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_table`
--

CREATE TABLE `project_table` (
  `id` int(11) NOT NULL,
  `table_name` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_url`
--

CREATE TABLE `project_url` (
  `id` int(11) NOT NULL,
  `controller` text,
  `function` text,
  `url` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(11) NOT NULL,
  `first_name` text,
  `last_name` text,
  `phone_number` text,
  `avatar` text,
  `address` text,
  `user_id` text,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `random_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_user_required`
--

CREATE TABLE `project_user_required` (
  `id` int(11) NOT NULL,
  `first_name` int(11) DEFAULT NULL,
  `last_name` int(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `project_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register_table`
--

CREATE TABLE `register_table` (
  `id` int(11) NOT NULL,
  `name_table` text,
  `desc_table` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_main_page`
--

CREATE TABLE `set_main_page` (
  `id` int(11) NOT NULL,
  `theme` text,
  `project_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extra_page`
--
ALTER TABLE `extra_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_complete_code`
--
ALTER TABLE `field_complete_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_data`
--
ALTER TABLE `field_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_data_lookup`
--
ALTER TABLE `field_data_lookup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_session`
--
ALTER TABLE `field_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_set`
--
ALTER TABLE `field_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graph_column`
--
ALTER TABLE `graph_column`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graph_create`
--
ALTER TABLE `graph_create`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_login`
--
ALTER TABLE `project_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_lookup_helper`
--
ALTER TABLE `project_lookup_helper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_role`
--
ALTER TABLE `project_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_table`
--
ALTER TABLE `project_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_url`
--
ALTER TABLE `project_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_user_required`
--
ALTER TABLE `project_user_required`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_table`
--
ALTER TABLE `register_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_main_page`
--
ALTER TABLE `set_main_page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extra_page`
--
ALTER TABLE `extra_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `field_complete_code`
--
ALTER TABLE `field_complete_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_data`
--
ALTER TABLE `field_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_data_lookup`
--
ALTER TABLE `field_data_lookup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `field_session`
--
ALTER TABLE `field_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `field_set`
--
ALTER TABLE `field_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `graph_column`
--
ALTER TABLE `graph_column`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `graph_create`
--
ALTER TABLE `graph_create`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `project_login`
--
ALTER TABLE `project_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_lookup_helper`
--
ALTER TABLE `project_lookup_helper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_role`
--
ALTER TABLE `project_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project_table`
--
ALTER TABLE `project_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `project_url`
--
ALTER TABLE `project_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_user_required`
--
ALTER TABLE `project_user_required`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `register_table`
--
ALTER TABLE `register_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `set_main_page`
--
ALTER TABLE `set_main_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
