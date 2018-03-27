-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 27 mrt 2018 om 11:08
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
  `besch` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `filelocation`, `besch`) VALUES
(11, 'files/bram@vanlaere.org-1522069554.jpg', 'Los angeles california bitches'),
(12, 'files/bram@vanlaere.org-1522069654.jpg', 'GEEF MIJ MAAAR BIER '),
(13, 'files/bram@vanlaere.org-1522069809.jpg', 'New york baby'),
(14, 'files/bram@vanlaere.org-1522069857.jpg', 'nog iis new york'),
(15, 'files/bram@bram.co-1522141383.jpg', 'squad');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'thomaslaeremans@hotmail.com', '$2y$10$aR9jx3slNlqDWKTsMT342uFuBWAgKnrntE1omtplEi9yoNeIMLaSe', 'Thomas', 'Laeremans'),
(2, 'kathy@me.com', '$2y$10$WbumBVFINdETcgNC5iUEXukTfhhcaJB/tUhjmzgnlTcbBwg5P2euS', 'kathy', 'arana'),
(4, 'test@test.com', '$2y$10$/1VWlr5C1RmllUvWJS0yie96JZv4969siBIxsoxUzqmfX0DK8SstW', 'test', 'test'),
(5, 'bram@vanlaere.com', '$2y$10$5MCu3XzqPkzu2uDZ5t7znOf1WjckmsSGLZOEtXSDYbWgXLdrYHjKG', 'bram', 'bram'),
(6, 'bram@test.com', '$2y$12$02YGOkak9E38CAXMpwe0jO/O1TjyZQUdO9GnPWFkIL1DYwFsKGwXm', 'bram', 'bram'),
(7, 'vanlaere@bram.com', '$2y$12$rFEJ3v128vZ1QiI.X/T87OrORG9gIh1EeY9D0zz1tyLSl2By0R02y', 'bram', 'van laere'),
(8, 'joris@joris.com', '$2y$10$1JX1WR4g8//CRWc.aqmxmemPTItPa/9.uj9bXRvKwHDLliCSQA6uu', 'joris', 'joris'),
(9, 'bram@lel.oe', '$2y$10$mEdKnokeoS8zEFIaBGuhkeRd3g7NNk/9.HbqmyCGyLInDjiPvZv2u', 'bram', 'bram'),
(10, 'bram@vanlaere.org', '$2y$10$o9qNiiqx3EYFSJy31qScb.KmU62kOon7s2dif8r.LkyVeZLUoscbO', 'bram', 'van laere'),
(11, 'abrahamvanlaere@lol.com', '$2y$10$nLdWnBaSiKdf3D3PMLpL5ezwUyrrOVgLDC2EQdxvi.B4645g2KjIa', 'bram', 'van laere'),
(12, 'bram@bram.co', '$2y$10$e2pdaJNM4E79ukLBt54yt.E.MWaL4flmD.t2vd/5pH3JlzN05cUk6', 'bram', 'van laere');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
