-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2021 at 07:39 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `user_auth_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `age_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `year`, `genre`, `age_group`) VALUES
(1, 'The Tale of Melon City', 1981, 'Poetry', '(16 year olds and above)'),
(2, "The Humble Administrator's Garden", 1985, 'Poetry', '(18 year olds and above)'),
(3, 'All You Who Sleep Tonight', 1990, 'Poetry', '(18 year olds and above)'),
(4, 'Akbarnama', 2011, 'Biography', '(18 year olds and above)'),
(5, 'The Cognitive Control of Motivation', 1969, 'Psychology', '(18 year olds and above)'),
(6, 'Stanford Prison Experiment - A simulation study of the psychology of imprisonment', 1972, 'Psychology', '(18 year olds and above)'),
(7, 'Influencing Attitudes and Changing Behavior', 1969, 'Psychology', '(18 year olds and above)'),
(8, 'Sense and Sensibility', 1811, 'Novel', '(12 year olds and above)'),
(9, 'Pride and Prejudice', 1812, 'Novel', '(14 year olds and above)'),
(10, 'Mansfield Park', 1814, 'Novel', '(Adult Fiction)'),
(11, 'Emma', 1815, 'Novel', '(Children Fiction)'),
(12, 'Northanger Abbey', 1818, 'Novel', '(Teenage Fiction)'),
(13, 'Persuasion', 1818, 'Novel', '(Adult Fiction)'),
(14, 'Lady Susan', 1871, 'Novel', '(Adult Fiction)'),
(15, 'The Childhood of Jesus', 2013, 'Novel', '(12 to 15 year olds)'),
(16, 'The Schooldays of Jesus', 2016, 'Novel', '(8 to 10 year olds)'),
(17, 'The Death of Jesus', 2019, 'Novel', '(12 to 17 year olds)');

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--
INSERT INTO `authors` (`author_id`, `author_name`, `age`, `genre`, `book_id`) VALUES
(1, 'Vikram Seth', '68yrs', 'novelist, poet', 1),
(2, 'Vikram Seth', '68yrs', 'novelist, poet', 2),
(3, 'Vikram Seth', '68yrs', 'novelist, poet', 3),
(4, "Abu'l-Fazl ibn Mubarak", '(Deceased)', 'Biography', 4),
(5, 'Phillip Zimbardo', '87yrs', 'Psychologist', 5),
(6, 'Phillip Zimbardo', '87yrs', 'Psychologist', 6),
(7, 'Phillip Zimbardo', '87yrs', 'Psychologist', 7),
(8, 'Jane Austen', '(Deceased)', 'poet, novelist', 8),
(9, 'Jane Austen', '(Deceased)', 'poet, novelist', 9),
(10, 'Jane Austen', '(Deceased)', 'poet, novelist', 10),
(11, 'Jane Austen', '(Deceased)', 'poet, novelist', 11),
(12, 'Jane Austen', '(Deceased)', 'poet, novelist', 12),
(13, 'Jane Austen', '(Deceased)', 'poet, novelist', 13),
(14, 'Jane Austen', '(Deceased)', 'poet, novelist', 14),
(15, 'J. M. Coetzee', '81yrs', 'novelist, essayist, liguist', 15),
(16, 'J. M. Coetzee', '81yrs', 'novelist, essayist, liguist', 16),
(17, 'J. M. Coetzee', '81yrs', 'novelist, essayist, liguist', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
