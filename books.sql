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
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre`) VALUES
(1, 'The Tale of Melon City, 1981 - (16 year olds and above)', 'Vikram Seth (68yrs) - novelist, poet', 'Poetry'),
(2, 'The Humble Administrator\'s Garden, 1985 - (18 year olds and above)', 'Vikram Seth (68yrs) - novelist, poet', 'Poetry'),
(3, 'All You Who Sleep Tonight, 1990 - (18 year olds and above)', 'Vikram Seth (68yrs) - novelist, poet', 'Poetry'),
(4, 'Akbarnama, 2011 - (18 year olds and above)', 'Abu\'l-Fazl ibn Mubarak (Deceased) - Biography', 'Biography'),
(5, 'The Cognitive Control of Motivation, 1969 - (18 year olds and above)', 'Phillip Zimbardo (87yrs) - Psychologist', 'Psychology'),
(6, 'Stanford Prison Experiment - A simulation study of the psychology of imprisonment, 1972 - (18 year olds and above)', 'Phillip Zimbardo (87yrs) - Psychologist', 'Psychology'),
(7, 'Influencing Attitudes and Changing Behavior, 1969 - (18 year olds and above)', 'Phillip Zimbardo (87yrs) - Psychologist', 'Psychology'),
(8, 'Sense and Sensibility, 1811 - (12 year olds and above)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(9, 'Pride and Prejudice, 1812 - (14 year olds and above)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(10, 'Mansfield Park, 1814 - (Adult Fiction)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(11, 'Emma, 1815 - (Children Fiction)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(12, 'Northanger Abbey, 1818 - (Teenage Fiction)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(13, 'Persuasion, 1818 - (Adult Fiction)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(14, 'Lady Susan, 1871 - (Adult Fiction)', 'Jane Austen (Deceased) - poet, novelist', 'Novel'),
(15, 'The Childhood of Jesus, 2013 - (12 to 15 year olds)', 'J. M. Coetzee (81yrs) - novelist, essayist, liguist', 'Novel'),
(16, 'The Schooldays of Jesus, 2016 - (8 to 10 year olds)', 'J. M. Coetzee (81yrs) - novelist, essayist, liguist', 'Novel'),
(17, 'The Death of Jesus, 2019 - (12 to 17 year olds)', 'J. M. Coetzee (81yrs) - novelist, essayist, liguist', 'Novel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
