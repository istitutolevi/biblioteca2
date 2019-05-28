-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 28, 2019 alle 09:51
-- Versione del server: 10.1.35-MariaDB
-- Versione PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autori`
--

CREATE TABLE `autori` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `Cognome` varchar(45) DEFAULT NULL,
  `DataNascita` datetime DEFAULT NULL,
  `DataMorte` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `caseeditrici`
--

CREATE TABLE `caseeditrici` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `LuogoSede` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `generi`
--

CREATE TABLE `generi` (
  `Id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `Id` int(11) NOT NULL,
  `Titolo` varchar(200) NOT NULL,
  `ISBN` varchar(21) DEFAULT NULL,
  `Codice` int(3) DEFAULT NULL,
  `IdCasaEditrice` int(11) DEFAULT NULL,
  `AnnoPubblicazione` int(11) DEFAULT NULL,
  `CollocazioneLuogo` tinyint(1) DEFAULT NULL,
  `CollocazioneArmadio` int(3) DEFAULT NULL,
  `CollocazioneScaffale` int(3) DEFAULT NULL,
  `Stato` varchar(1) NOT NULL,
  `IdUtentePrestito` int(11) DEFAULT NULL,
  `DataInizioPrestito` datetime DEFAULT NULL,
  `DataFinePrestitoPrevista` datetime DEFAULT NULL,
  `IdGenere` varchar(30) DEFAULT NULL,
  `IdAutore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `libriutenti`
--

CREATE TABLE `libriutenti` (
  `IdUtente` int(11) DEFAULT NULL,
  `IdLibro` int(11) DEFAULT NULL,
  `DataInizioPrestito` datetime DEFAULT NULL,
  `DataFinePrestito` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `libriutentiview`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `libriutentiview` (
`IdUtente` int(11)
,`IdLibro` int(11)
,`DataInizioPrestito` datetime
,`DataFinePrestito` datetime
);

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(80) NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Cognome` varchar(45) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `DataDiNascita` datetime DEFAULT NULL,
  `Documento` varchar(10) DEFAULT NULL,
  `NumeroDocumento` varchar(45) DEFAULT NULL,
  `CodiceFiscale` varchar(15) DEFAULT NULL,
  `Indirizzo` varchar(45) DEFAULT NULL,
  `Localita` varchar(45) DEFAULT NULL,
  `Provincia` varchar(2) DEFAULT NULL,
  `CAP` varchar(5) DEFAULT NULL,
  `LivelloUtente` int(1) NOT NULL,
  `Disabilitato` bit(1) DEFAULT NULL,
  `MotivoDisabilitato` varchar(45) DEFAULT NULL,
  `Note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura per vista `libriutentiview`
--
DROP TABLE IF EXISTS `libriutentiview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `libriutentiview`  AS  select `libri`.`IdUtentePrestito` AS `IdUtente`,`libri`.`Id` AS `IdLibro`,`libri`.`DataInizioPrestito` AS `DataInizioPrestito`,`libri`.`DataFinePrestitoPrevista` AS `DataFinePrestito` from `libri` where (`libri`.`Stato` = 'N') ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `caseeditrici`
--
ALTER TABLE `caseeditrici`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `generi`
--
ALTER TABLE `generi`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_UtentePrestito` (`IdUtentePrestito`),
  ADD KEY `FK_Genere` (`IdGenere`),
  ADD KEY `FK_CasaEditrice` (`IdCasaEditrice`),
  ADD KEY `FK_Autore` (`IdAutore`);

--
-- Indici per le tabelle `libriutenti`
--
ALTER TABLE `libriutenti`
  ADD KEY `FK_LibroUtente` (`IdLibro`),
  ADD KEY `FK_Utente` (`IdUtente`);

--
-- Indici per le tabelle `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`),
  ADD KEY `FK_TokenUtenti` (`user_id`);

--
-- Indici per le tabelle `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indici per le tabelle `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `FK_UtentiOauth` (`user_id`);

--
-- Indici per le tabelle `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indici per le tabelle `oauth_scopes`
--
ALTER TABLE `oauth_scopes`
  ADD PRIMARY KEY (`scope`);

--
-- Indici per le tabelle `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `autori`
--
ALTER TABLE `autori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `caseeditrici`
--
ALTER TABLE `caseeditrici`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `libri`
--
ALTER TABLE `libri`
  ADD CONSTRAINT `FK_Autore` FOREIGN KEY (`IdAutore`) REFERENCES `autori` (`Id`),
  ADD CONSTRAINT `FK_CasaEditrice` FOREIGN KEY (`IdCasaEditrice`) REFERENCES `caseeditrici` (`Id`),
  ADD CONSTRAINT `FK_Genere` FOREIGN KEY (`IdGenere`) REFERENCES `generi` (`Id`),
  ADD CONSTRAINT `FK_UtentePrestito` FOREIGN KEY (`IdUtentePrestito`) REFERENCES `utenti` (`Id`);

--
-- Limiti per la tabella `libriutenti`
--
ALTER TABLE `libriutenti`
  ADD CONSTRAINT `FK_LibroUtente` FOREIGN KEY (`IdLibro`) REFERENCES `libri` (`Id`),
  ADD CONSTRAINT `FK_Utente` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`Id`);

--
-- Limiti per la tabella `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD CONSTRAINT `FK_TokenUtenti` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`Id`);

--
-- Limiti per la tabella `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD CONSTRAINT `FK_UtentiOauth` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
