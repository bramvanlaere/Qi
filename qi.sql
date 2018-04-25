-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 25 apr 2018 om 10:52
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
-- Tabelstructuur voor tabel `friendlist`
--

CREATE TABLE `friendlist` (
  `Id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `friendid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `friendlist`
--

INSERT INTO `friendlist` (`Id`, `userid`, `friendid`) VALUES
(2, 48, 2),
(4, 49, 5),
(6, 5, 48),
(7, 48, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `filelocation` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageuserid` int(11) NOT NULL,
  `besch` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `filelocation`, `imageuserid`, `besch`, `user`) VALUES
(70, 'files/5-1524493459.jpg', 5, 'route 66 ! #LA', 'joris@joris.com'),
(71, 'files/48-1524493661.jpg', 48, 'nieuwe outfit #fashion #sunglasses', 'bram@test1234.com'),
(72, 'files/5-1524560216.jpg', 5, 'kerstmis #lol', 'joris@joris.com'),
(73, 'files/5-1524560318.jpg', 5, 'New York City of dreams #NYC', 'joris@joris.com'),
(74, 'files/48-1524562066.jpg', 48, 'nieuwe schoenen ! #fashion', 'bram@test1234.com'),
(75, 'files/48-1524562905.jpg', 48, 'fashion', 'bram@test1234.com');

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
(5, 'joris@joris.com', '$2y$10$1JX1WR4g8//CRWc.aqmxmemPTItPa/9.uj9bXRvKwHDLliCSQA6uu', 'avatars/5_avatar.jpg', 'koffie aan het drinken #developerslife', 'joris', 'joris'),
(45, 'bram@bram.com', '$2y$12$w6CgLj9Xye7jPfECSeFns.5AA5Gc49e6t5cCJhOUo0aHbtWyV9Edu', '', '', 'test1234', 'test1234'),
(48, 'test1234@bram.com', '$2y$12$Se8qMYbAd5HRF/SWdb93..HMUFDtFW5t4kgT65j6dAyFA84MnNMFq', 'avatars/48_avatar.jpg', 'olah', 'dede', 'dedede'),
(49, 'demo@test.com', '$2y$10$93t7yJ4auOJy835kObARI.dy3t.nkVUq0MS7FDRCYz0CYWkFUvZnm', 'avatars/49_avatar.jpg', 'ðŸ˜€', 'test1234', 'test1234');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `friendlist`
--
ALTER TABLE `friendlist`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT voor een tabel `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
