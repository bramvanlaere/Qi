-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 08 mei 2018 om 14:04
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
-- Tabelstructuur voor tabel `colorpost`
--

CREATE TABLE `colorpost` (
  `postid` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `colorpost`
--

INSERT INTO `colorpost` (`postid`, `color`) VALUES
(87, '#EFCDB4'),
(87, '#0F1620'),
(87, '#619411'),
(87, '#91543F'),
(87, '#FF4871'),
(85, '#DFEAFC'),
(85, '#A7B500'),
(85, '#EFD9C1'),
(85, '#FC0903'),
(85, '#7C7726'),
(90, '#E2C2AD'),
(90, '#946B55'),
(90, '#C8CAF0'),
(90, '#6C2DAF'),
(90, '#842346'),
(91, '#EAF4EB'),
(91, '#000000'),
(91, '#DABE12'),
(91, '#5B0000'),
(91, '#FE0900'),
(74, '#DCB163'),
(74, '#6C7F9F'),
(74, '#AE6D2D'),
(74, '#AEBECE'),
(74, '#60491D'),
(71, '#000000'),
(71, '#E4E4E4'),
(71, '#767676'),
(82, '#956439'),
(82, '#E29346'),
(82, '#4273AB'),
(82, '#402713'),
(82, '#100E19'),
(70, '#880201'),
(70, '#E4EBFE'),
(70, '#FD8900'),
(70, '#680041'),
(70, '#01215E');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `commentuserid` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentpostid` int(11) NOT NULL,
  `commenttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`commentid`, `commentuserid`, `comment`, `commentpostid`, `commenttime`, `email`) VALUES
(1, 48, 'lel', 70, '2018-05-03 18:15:52', ''),
(2, 48, 'lel', 87, '2018-05-06 07:47:04', 'test1234@bram.com'),
(3, 48, 'test', 70, '2018-05-06 07:47:28', 'test1234@bram.com'),
(4, 48, 'also test', 71, '2018-05-06 07:47:36', 'test1234@bram.com'),
(5, 48, 'yeah?', 70, '2018-05-06 07:49:15', 'test1234@bram.com'),
(6, 48, 'I fixed it boy', 71, '2018-05-06 07:49:31', 'test1234@bram.com'),
(7, 48, 'I am such a badass motherfucker', 85, '2018-05-06 07:49:57', 'test1234@bram.com'),
(8, 48, 'lol', 87, '2018-05-06 10:06:17', 'test1234@bram.com'),
(9, 48, 'I honestly love this picture so much', 90, '2018-05-06 14:11:50', 'test1234@bram.com'),
(10, 5, 'yeah me to me man ! you are the best student #not', 90, '2018-05-07 08:35:49', 'joris@joris.com'),
(11, 54, 'where is this ? ', 90, '2018-05-07 08:48:46', 'lel@whut.com'),
(12, 48, 'thanks guys', 90, '2018-05-07 09:34:52', 'test1234@bram.com'),
(13, 48, 'love this post !', 91, '2018-05-07 09:48:29', 'test1234@bram.com'),
(14, 0, 'test', 0, '2018-05-08 07:04:34', '<br />\n<b>Notice</b>:  Undefined index: username in <b>/Applications/XAMPP/xamppfiles/htdocs/Qi-master-css/postDetail.php</b> on line <b>111</b><br />\n'),
(15, 48, 'test', 0, '2018-05-08 07:05:38', 'test1234@bram.com');

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
(4, 5, 48),
(6, 53, 48),
(7, 51, 5),
(8, 48, 3),
(12, 48, 45),
(13, 48, 49),
(45, 5, 53),
(46, 54, 48),
(47, 48, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inappropriate`
--

CREATE TABLE `inappropriate` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inappropriate`
--

INSERT INTO `inappropriate` (`id`, `postid`, `userid`) VALUES
(40, 85, 48);

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
(80, 89, 48, 5),
(81, 89, 5, 5),
(87, 87, 48, 48),
(88, 71, 48, 48),
(93, 70, 48, 5),
(94, 74, 48, 48),
(96, 91, 5, 5),
(97, 90, 5, 48),
(98, 90, 54, 48),
(99, 91, 48, 5);

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
(87, 'files/48-1525247144.jpg', 48, 'test lel', 'test1234@bram.com', '2018-05-02 07:45:44'),
(88, 'files/53-1525259316.jpg', 53, 'fret', 'thomaslaeremans@hotmail.com', '2018-05-02 11:08:36'),
(90, 'files/48-1525615718.jpg', 48, 'marina bay you know !', 'test1234@bram.com', '2018-05-06 14:08:40'),
(91, 'files/5-1525682126.jpg', 5, 'because I haven\'t posted in a while, ', 'joris@joris.com', '2018-05-07 08:35:27');

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
(48, 'test1234@bram.com', '$2y$10$1JX1WR4g8//CRWc.aqmxmemPTItPa/9.uj9bXRvKwHDLliCSQA6uu', 'avatars/48_avatar.jpg', 'Roses are red, my name is not dave, this makes no sense, Microwave', 'dede', 'dedede'),
(49, 'demo@test.com', '$2y$10$93t7yJ4auOJy835kObARI.dy3t.nkVUq0MS7FDRCYz0CYWkFUvZnm', 'avatars/49_avatar.jpg', 'ðŸ˜€', 'test1234', 'test1234'),
(50, 'test@1234.com', '$2y$10$1nYlYxao3zxitvJfuipuJO4ag1q4PfSgk5tJ16gcFUchUDJDpr1MW', '', '', 'test1234', 'test1234'),
(51, 'test2@kw.com', '$2y$10$A5lU4eSqsFEYRWJm4Pp1tuRN1Eg9WFerOU9L0BkzXCwgBGQFx4LV.', 'avatars/51_avatar.jpg', '', 'test1234', 'test1234'),
(53, 'thomaslaeremans@hotmail.com', '$2y$10$MIpYJfDRZFjETNx1VPHflOS81bVFBGSUmLI0iPqcnbN3ld3mTDK12', '', '', 'Thomas', 'Laeremans'),
(54, 'lel@whut.com', '$2y$10$LjvlfZbKFaJLU.Pu7lOKZuWH4Yp9tBhwLz.GMa2C2M4RwnVEnGp3O', 'avatars/54_avatar.jpg', 'this makes no sense', 'bram', 'van laere');

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
-- Indexen voor tabel `inappropriate`
--
ALTER TABLE `inappropriate`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT voor een tabel `inappropriate`
--
ALTER TABLE `inappropriate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
