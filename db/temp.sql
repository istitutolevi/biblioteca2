SELECT Libri.*,Autori.*
FROM Libri
JOIN LibriAutori ON :id=LibriAutori.IdLibro
JOIN Autori ON Autori.Id=LibriAutori.IdAutori
WHERE Libri.id=:id
OR Libri.Titolo LIKE :titolo
AND Libri.ISBN LIKE :isbn
AND Libri.Codice LIKE :codice
AND Libri.IdCas = :idCasaEditrice
AND Libri.Anno BETWEEN :annoDa AND :annoA
AND Libri.CollocazioneLuogo LIKE :collocazioneLuogo
AND Libri.CollocazioneArmadio LIKE :collocazioneArmadio
AND Libri.CollocazioneScaffale LIKE :collocazioneScaffale
AND Libri.Stato = :stato
AND Libri.IdUtentePrestito = :idUtentePrestito
AND Libri.DataInizioPresito BETWEEN :dataInizioPrestitoDa AND :dataInizioPrestitoA
AND Libri.DataFinePrestitoPrevista BETWEEN :dataFinePrestitoPrevistaDa AND :dataFinePrestitoPrevistaA
AND Libri.IdGenere = :idGenere
