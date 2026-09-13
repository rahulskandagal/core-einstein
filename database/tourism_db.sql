-- Tourism Destination Management System Database
-- Created for Internship Project

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET TIME_ZONE = "+00:00";

CREATE DATABASE IF NOT EXISTS `tourism_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tourism_db`;

-- --------------------------------------------------------

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping sample admin (username: rahulsk, password: 1234)
INSERT INTO `admins` (`username`, `password`, `email`) VALUES
('rahulsk', '$2y$10$ez3jK1q9crRF3TEC5sSLH.XknmwuH.BaqjBBiGXbly3MTZ1rehuR6', 'rahulskandagalpc@gmail.com');

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default_user.png',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `destinations`
CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL, -- e.g., Beach, Mountain, City, Historical
  `country` varchar(100) NOT NULL,
  `short_desc` text NOT NULL,
  `long_desc` longtext NOT NULL,
  `best_time` varchar(100) DEFAULT NULL,
  `travel_cost` decimal(10,2) DEFAULT NULL,
  `image_main` varchar(255) NOT NULL,
  `image_slider1` varchar(255) DEFAULT NULL,
  `image_slider2` varchar(255) DEFAULT NULL,
  `image_slider3` varchar(255) DEFAULT NULL,
  `location_map` text DEFAULT NULL,
  `attractions` text DEFAULT NULL,
  `hotels` text DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `rating` decimal(2,1) DEFAULT 4.5,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping sample destinations
INSERT INTO `destinations` (`title`, `category`, `country`, `short_desc`, `long_desc`, `best_time`, `travel_cost`, `image_main`, `is_popular`, `rating`) VALUES
('Bali Paradise', 'Beach', 'Indonesia', 'Crystal clear waters and vibrant culture.', 'Experience the spiritual essence and tropical beauty of Bali. From the lush jungles of Ubud to the stunning beaches of Seminyak, Bali offers a diverse range of experiences for every traveler.', 'April to October', 1200.00, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80', 1, 4.8),
('Swiss Alps', 'Mountain', 'Switzerland', 'Snowy peaks and breathtaking landscapes.', 'The Swiss Alps represent the pinnacle of mountain beauty. Enjoy skiing in Zermatt, hiking in Grindelwald, or simply taking in the majestic views of the Matterhorn.', 'December to March (Skiing), June to September (Hiking)', 2500.00, 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1200&q=80', 1, 4.9),
('Paris Lights', 'City', 'France', 'The city of love, fashion, and art.', 'Paris is a global center for art, fashion, gastronomy, and culture. Its 19th-century cityscape is crisscrossed by wide boulevards and the River Seine.', 'April to June, October to early November', 1800.00, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80', 1, 4.7),
('Santorini', 'Beach', 'Greece', 'Iconic white buildings and blue domes.', 'Santorini is one of the Cyclades islands in the Aegean Sea. It was devastated by a volcanic eruption in the 16th century BC, forever shaping its rugged landscape.', 'September to October', 2100.00, 'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?auto=format&fit=crop&w=1200&q=80', 0, 4.9);

-- --------------------------------------------------------

-- Table structure for table `enquiries`
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `destination_name` varchar(255) DEFAULT NULL,
  `people_count` int(11) NOT NULL,
  `travel_date` date NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending', -- Pending, Contacted, Completed
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `wishlist`
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`destination_id`) REFERENCES `destinations`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
