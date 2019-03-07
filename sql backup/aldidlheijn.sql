-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 mrt 2019 om 16:44
-- Serverversie: 10.1.28-MariaDB
-- PHP-versie: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aldidlheijn`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` varchar(1) NOT NULL,
  `categorie_naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie_naam`) VALUES
('A', 'Groenten, fruit'),
('B', 'Vlees, kip, vis'),
('C', 'Zuivel, eieren'),
('D', 'Bakkerij'),
('E', 'Verse kant-en-klaar maaltijden, salades'),
('F', 'Frisdranken, koffie, thee, sappen'),
('G', 'Ontbijtgranen, broodbeleg, tussendoor'),
('H', 'Wijn'),
('I', 'Bier, sterke drank, apertieven'),
('J', 'Pasta, rijst, internationale keuken'),
('K', 'Soepen, conserven, sauzen, smaakmakers'),
('L', 'Snoep, koek, chips'),
('M', 'Diepvries'),
('N', 'Drogisterij, baby'),
('O', 'Bewuste voeding'),
('P', 'Huishouden, huisdieren'),
('Q', 'Koken, tafelen, non-food');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `gebruiker_id` int(11) NOT NULL,
  `gebruiker_email` varchar(255) NOT NULL,
  `gebruiker_wachtwoord` varchar(255) NOT NULL,
  `gebruiker_admin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`gebruiker_id`, `gebruiker_email`, `gebruiker_wachtwoord`, `gebruiker_admin_status`) VALUES
(1, 'test@test.com', '$2y$10$mvUR0JA4hieBSpksXT/RO.2uSVOmNxUXZ2D05WWv9dG.OhhEEJQAy', 1),
(2, 'milan@email.com', '$2y$10$5AFA340gYCzXcz57Sm2g7uwUfCaDGJ7bJz2TUrf1lwkjI/sLsoP.6', 0),
(3, 'hallo123@hallo.com', '$2y$10$ss4Brk8D3.IDS9n6ZO.DouG/CJ0P4THEUB7wTDLuGpV6R5UPh38Mi', 0),
(4, 'email@email.com', '$2y$10$tYBl0DMiqdCDlDgVT05Ym.sWfy7mg7CG7gf2DE5LJzxw0ZsImtUfm', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `product_naam` varchar(255) NOT NULL,
  `product_nr` int(11) NOT NULL,
  `categorie_id` varchar(1) NOT NULL,
  `product_afbeelding` varchar(255) NOT NULL,
  `product_prijs` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`product_naam`, `product_nr`, `categorie_id`, `product_afbeelding`, `product_prijs`) VALUES
('ei', 1, 'C', 'https://www.partyscene.nl/ckfinder/userfiles/images/egg%20as.jpg', 1.89),
('kipfilet', 2, 'B', 'https://slagerijpatrick.nl/wp-content/uploads/2015/09/kipfilet2.jpg', 4.98),
('donuts', 3, 'D', 'https://www.supermarktaanbiedingen.com/public/images/discount/2016/01/504321.jpg', 2.55),
('kaas', 4, 'C', 'http://www.kaashuistromp.nl/wp-content/uploads/HOKA-503.Bioreijck-belegen-Kaas-50-.jpg', 3.32),
('extra virgin water', 5, 'F', 'https://images-na.ssl-images-amazon.com/images/I/71i3M3nXkaL._SL1500_.jpg', 1.12),
('Banaan', 6, 'A', 'https://cdn.ekoplaza.nl/ekoplaza/producten/large/2166940000000.jpg', 2.23);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`gebruiker_id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`product_nr`),
  ADD KEY `categorie_id` (`categorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
