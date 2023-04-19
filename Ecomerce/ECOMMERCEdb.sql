-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 18, 2023 alle 23:18
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `emailC` varchar(20) NOT NULL,
  `Id_prodottoC` varchar(20) NOT NULL,
  `qtaC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`emailC`, `Id_prodottoC`, `qtaC`) VALUES
('a', '1', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE `magazzino` (
  `Cod_M` varchar(20) NOT NULL,
  `cittaM` varchar(50) DEFAULT NULL,
  `capM` varchar(5) DEFAULT NULL,
  `indirizzoM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Id_ordine` varchar(20) NOT NULL,
  `data_ora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tracking_num` varchar(50) DEFAULT NULL,
  `indirizzo_sped` varchar(50) DEFAULT NULL,
  `citta_SP` varchar(50) DEFAULT NULL,
  `cap_SP` varchar(5) DEFAULT NULL,
  `emailO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordinedel`
--

CREATE TABLE `ordinedel` (
  `Id_ordineO` varchar(20) NOT NULL,
  `Id_prodottoO` varchar(20) NOT NULL,
  `qta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `presentein`
--

CREATE TABLE `presentein` (
  `Id_prodottoP` varchar(20) NOT NULL,
  `Cod_MP` varchar(20) NOT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `Id_prodotto` varchar(20) NOT NULL,
  `prezzo_U` float DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  `disponibili` int(11) DEFAULT NULL,
  `nome_f` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`Id_prodotto`, `prezzo_U`, `categoria`, `descrizione`, `disponibili`, `nome_f`) VALUES
('1', 2.5, 'alimentare', 'cipolla di tropea igp', 10, 'lacipolla.svg'),
('2', 60, 'scarpe', 'nike air force one', 10, 'airForceOne.svg');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(100) NOT NULL,
  `cognome` varchar(40) DEFAULT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `partita_iva` varchar(50) DEFAULT NULL,
  `password_utente` varchar(30) NOT NULL,
  `citta` varchar(50) DEFAULT NULL,
  `cf` varchar(16) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `ind_fatturazione` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `cognome`, `nome`, `tel`, `partita_iva`, `password_utente`, `citta`, `cf`, `cap`, `ind_fatturazione`) VALUES
('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`emailC`,`Id_prodottoC`),
  ADD KEY `Id_prodottoC` (`Id_prodottoC`);

--
-- Indici per le tabelle `magazzino`
--
ALTER TABLE `magazzino`
  ADD PRIMARY KEY (`Cod_M`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Id_ordine`),
  ADD KEY `emailO` (`emailO`);

--
-- Indici per le tabelle `ordinedel`
--
ALTER TABLE `ordinedel`
  ADD PRIMARY KEY (`Id_ordineO`,`Id_prodottoO`),
  ADD KEY `Id_prodottoO` (`Id_prodottoO`);

--
-- Indici per le tabelle `presentein`
--
ALTER TABLE `presentein`
  ADD PRIMARY KEY (`Id_prodottoP`,`Cod_MP`),
  ADD KEY `Cod_MP` (`Cod_MP`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`Id_prodotto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`emailC`) REFERENCES `utenti` (`email`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`Id_prodottoC`) REFERENCES `prodotti` (`Id_prodotto`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`emailO`) REFERENCES `utenti` (`email`);

--
-- Limiti per la tabella `ordinedel`
--
ALTER TABLE `ordinedel`
  ADD CONSTRAINT `ordinedel_ibfk_1` FOREIGN KEY (`Id_ordineO`) REFERENCES `ordine` (`Id_ordine`),
  ADD CONSTRAINT `ordinedel_ibfk_2` FOREIGN KEY (`Id_prodottoO`) REFERENCES `prodotti` (`Id_prodotto`);

--
-- Limiti per la tabella `presentein`
--
ALTER TABLE `presentein`
  ADD CONSTRAINT `presentein_ibfk_1` FOREIGN KEY (`Id_prodottoP`) REFERENCES `prodotti` (`Id_prodotto`),
  ADD CONSTRAINT `presentein_ibfk_2` FOREIGN KEY (`Cod_MP`) REFERENCES `magazzino` (`Cod_M`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
