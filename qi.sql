-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 20 apr 2018 om 18:49
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qi`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `filelocation` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besch` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `filelocation`, `besch`, `user`) VALUES
(39, 'files/vanlaere@bram.com-1523612954.jpg', 'off white webdesign !', 'vanlaere@bram.com'),
(40, 'files/vanlaere@bram.com-1523612982.jpg', 'jaden smith kleding lijn !', 'vanlaere@bram.com'),
(43, 'files/vanlaere@bram.com-1523613062.jpg', 'design van soho house !', 'vanlaere@bram.com'),
(44, 'files/vanlaere@bram.com-1523613282.jpg', 'nieuwe aanwinst !', 'vanlaere@bram.com'),
(45, 'files/vanlaere@bram.com-1523613302.jpg', 'shoot 1', 'vanlaere@bram.com'),
(46, 'files/vanlaere@bram.com-1523613316.jpg', 'shoot 2', 'vanlaere@bram.com'),
(47, 'files/vanlaere@bram.com-1523613445.jpg', 'amazon icoon !', 'vanlaere@bram.com'),
(48, 'files/vanlaere@bram.com-1523613487.jpg', 'zonnige dag !', 'vanlaere@bram.com'),
(49, 'files/vanlaere@bram.com-1523613509.jpg', 'dubai !', 'vanlaere@bram.com'),
(50, 'files/vanlaere@bram.com-1523613538.jpg', 'yeezys in santa monica !', 'vanlaere@bram.com'),
(51, 'files/vanlaere@bram.com-1523613552.jpg', 'water !', 'vanlaere@bram.com'),
(52, 'files/vanlaere@bram.com-1523613566.jpg', 'route 66 !', 'vanlaere@bram.com'),
(53, 'files/vanlaere@bram.com-1523613613.jpg', 'chilling !', 'vanlaere@bram.com'),
(54, 'files/vanlaere@bram.com-1523613640.jpg', 'kerst !', 'vanlaere@bram.com'),
(55, 'files/vanlaere@bram.com-1523613673.jpg', 'Los Angeles ! #flex', 'vanlaere@bram.com'),
(60, 'files/test@olah.com-1524231925.jpg', 'this is a very nice test boy\r\n', 'test@olah.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `avatar`, `bio`, `firstname`, `lastname`) VALUES
(1, 'thomaslaeremans@hotmail.com', '$2y$10$aR9jx3slNlqDWKTsMT342uFuBWAgKnrntE1omtplEi9yoNeIMLaSe', '', '', 'Thomas', 'Laeremans'),
(2, 'kathy@me.com', '$2y$10$WbumBVFINdETcgNC5iUEXukTfhhcaJB/tUhjmzgnlTcbBwg5P2euS', '', '', 'kathy', 'arana'),
(4, 'test@test.com', '$2y$10$/1VWlr5C1RmllUvWJS0yie96JZv4969siBIxsoxUzqmfX0DK8SstW', '', '', 'test', 'test'),
(5, 'joris@joris.com', '$2y$10$1JX1WR4g8//CRWc.aqmxmemPTItPa/9.uj9bXRvKwHDLliCSQA6uu', '', '', 'joris', 'joris'),
(45, 'bram@bram.com', '$2y$12$w6CgLj9Xye7jPfECSeFns.5AA5Gc49e6t5cCJhOUo0aHbtWyV9Edu', '', '', 'test1234', 'test1234'),
(46, 'olah@bram.com', '$2y$10$0f2THbS80vsmcAccEttEM.g0A3gAooEsTibuzLdC7guZmHamMfdjW', '', '', 'de', 'edede'),
(48, 'bram@test4321.com', '$2y$12$8OTVtpuFdn7Du9D.5rm6MunRjMdgaty5Etbd2oXHm1b/z/UvuuxOu', '', 'alles werkt boy', 'dede', 'dedede');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
