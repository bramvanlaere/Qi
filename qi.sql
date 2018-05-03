-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 03 mei 2018 om 10:58
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
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `commentuserid` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentimageid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 48, 5),
(4, 5, 48),
(6, 53, 48),
(7, 48, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `likeid` int(11) NOT NULL,
  `likeimageid` int(11) NOT NULL,
  `likesendid` int(11) NOT NULL,
  `likereceiveid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`likeid`, `likeimageid`, `likesendid`, `likereceiveid`) VALUES
(71, 87, 48, 48);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `filelocation` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageuserid` int(11) NOT NULL,
  `besch` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `filelocation`, `imageuserid`, `besch`, `user`, `timestamp`) VALUES
(70, 'files/5-1524493459.jpg', 5, 'route 66 ! #LA', 'joris@joris.com', '2018-05-01 08:51:04'),
(71, 'files/48-1524493661.jpg', 48, 'nieuwe outfit #fashion #sunglasses', 'bram@test1234.com', '2018-05-01 08:51:04'),
(72, 'files/5-1524560216.jpg', 5, 'kerstmis #lol', 'joris@joris.com', '2018-05-01 08:51:04'),
(73, 'files/5-1524560318.jpg', 5, 'New York City of dreams #NYC', 'joris@joris.com', '2018-05-01 08:51:04'),
(74, 'files/48-1524562066.jpg', 48, 'nieuwe schoenen ! #fashion', 'bram@test1234.com', '2018-05-01 08:51:04'),
(75, 'files/48-1524562905.jpg', 48, 'fashion', 'bram@test1234.com', '2018-05-01 08:51:04'),
(79, 'files/50-1524648247.jpg', 50, 'kerst', 'test@1234.com', '2018-05-01 08:51:04'),
(82, 'files/48-1525097082.jpg', 48, 'test', 'test1234@bram.com', '2018-05-01 08:51:04'),
(83, 'files/48-1525097099.jpg', 1, 'dddd', 'test1234@bram.com', '2018-05-01 14:25:12'),
(85, 'files/48-1525183994.jpg', 48, 'this an image ', 'test1234@bram.com', '2018-05-01 14:13:15'),
(86, 'files/5-1525184571.jpg', 5, 'this is also an image', 'joris@joris.com', '2018-05-01 14:22:51'),
(87, 'files/48-1525247144.jpg', 48, 'test lel', 'test1234@bram.com', '2018-05-02 07:45:44'),
(88, 'files/53-1525259316.jpg', 53, 'fret', 'thomaslaeremans@hotmail.com', '2018-05-02 11:08:36'),
(89, 'files/5-1525290082.jpg', 5, 'ddedee', 'joris@joris.com', '2018-05-02 19:41:23');

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
(2, 'kathy@me.com', '$2y$10$WbumBVFINdETcgNC5iUEXukTfhhcaJB/tUhjmzgnlTcbBwg5P2euS', '', '', 'kathy', 'arana'),
(5, 'joris@joris.com', '$2y$10$1JX1WR4g8//CRWc.aqmxmemPTItPa/9.uj9bXRvKwHDLliCSQA6uu', 'avatars/5_avatar.jpg', 'koffie aan het drinken #developerslife', 'joris', 'joris'),
(45, 'bram@bram.com', '$2y$12$w6CgLj9Xye7jPfECSeFns.5AA5Gc49e6t5cCJhOUo0aHbtWyV9Edu', '', '', 'test1234', 'test1234'),
(48, 'test1234@bram.com', '$2y$12$Se8qMYbAd5HRF/SWdb93..HMUFDtFW5t4kgT65j6dAyFA84MnNMFq', 'avatars/48_avatar.jpg', 'olah', 'dede', 'dedede'),
(49, 'demo@test.com', '$2y$10$93t7yJ4auOJy835kObARI.dy3t.nkVUq0MS7FDRCYz0CYWkFUvZnm', 'avatars/49_avatar.jpg', 'ðŸ˜€', 'test1234', 'test1234'),
(50, 'test@1234.com', '$2y$10$1nYlYxao3zxitvJfuipuJO4ag1q4PfSgk5tJ16gcFUchUDJDpr1MW', '', '', 'test1234', 'test1234'),
(51, 'test2@kw.com', '$2y$10$A5lU4eSqsFEYRWJm4Pp1tuRN1Eg9WFerOU9L0BkzXCwgBGQFx4LV.', 'avatars/51_avatar.jpg', '', 'test1234', 'test1234'),
(53, 'thomaslaeremans@hotmail.com', '$2y$10$MIpYJfDRZFjETNx1VPHflOS81bVFBGSUmLI0iPqcnbN3ld3mTDK12', '', '', 'Thomas', 'Laeremans');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexen voor tabel `friendlist`
--
ALTER TABLE `friendlist`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeid`);

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
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
