-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 25, 2021 at 08:56 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `user_auth_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `age`, `genre`) VALUES
(1, 'Vikram Seth', '68yrs', 'novelist, poet'),
(2, 'Abu\'l-Fazl ibn Mubarak', '(Deceased)', 'Biography'),
(3, 'Phillip Zimbardo', '87yrs', 'Psychologist'),
(4, 'Jane Austen', '(Deceased)', 'poet, novelist'),
(5, 'J. M. Coetzee', '81yrs', 'novelist, essayist, liguist');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `age_group` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `year`, `genre`, `age_group`, `author_id`) VALUES
(1, 'The Tale of Melon City', 1981, 'Poetry', '(16 year olds and above)', 1),
(2, 'The Humble Administrator\'s Garden', 1985, 'Poetry', '(18 year olds and above)', 1),
(3, 'All You Who Sleep Tonight', 1990, 'Poetry', '(18 year olds and above)', 1),
(4, 'Akbarnama', 2011, 'Biography', '(18 year olds and above)', 2),
(5, 'The Cognitive Control of Motivation', 1969, 'Psychology', '(18 year olds and above)', 3),
(6, 'Stanford Prison Experiment - A simulation study of the psychology of imprisonment', 1972, 'Psychology', '(18 year olds and above)', 3),
(7, 'Influencing Attitudes and Changing Behavior', 1969, 'Psychology', '(18 year olds and above)', 3),
(8, 'Sense and Sensibility', 1811, 'Novel', '(12 year olds and above)', 4),
(9, 'Pride and Prejudice', 1812, 'Novel', '(14 year olds and above)', 4),
(10, 'Mansfield Park', 1814, 'Novel', '(Adult Fiction)', 4),
(11, 'Emma', 1815, 'Novel', '(Children Fiction)', 4),
(12, 'Northanger Abbey', 1818, 'Novel', '(Teenage Fiction)', 4),
(13, 'Persuasion', 1818, 'Novel', '(Adult Fiction)', 4),
(14, 'Lady Susan', 1871, 'Novel', '(Adult Fiction)', 4),
(15, 'The Childhood of Jesus', 2013, 'Novel', '(12 to 15 year olds)', 5),
(16, 'The Schooldays of Jesus', 2016, 'Novel', '(8 to 10 year olds)', 5),
(17, 'The Death of Jesus', 2019, 'Novel', '(12 to 17 year olds)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(1, 'admin', 'admin@example.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);
