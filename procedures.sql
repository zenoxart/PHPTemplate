SHOW DATABASES;
use immobilien;
SHOW TABLES;

DELIMITER //
CREATE PROCEDURE InsertZuorndnungVonRaum(IN bezeichnung VARCHAR(50))
BEGIN
IF( (SELECT count(*) FROM raumzuordnung WHERE rzo_beschreibung LIKE bezeichnung) < 1)
THEN 
INSERT INTO raumzuordnung (rzo_beschreibung) VALUES (bezeichnung);
SELECT MAX(rzo_id) FROM raumzuordnung;
END IF;
END //
DELIMITER ;

DELIMITER //
CREATE procedure GetZordnungVonRaeumen()
BEGIN
SELECT rzo_id, rzo_beschreibung FROM raumzuordnung;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetImmos()
BEGIN
 SELECT 
 imm_id as  "ObjektNr",
 imt_bezeichnung as "Objektart",
 pre_preis as "Preis",
 concat_ws("",sta_plz," ",sta_stadt,", ",sta_strasse,' ',sta_hausnummer) as "Anschrift",
 sta_land as "Land"
FROM immobilie
NATURAL JOIN preis
NATURAL JOIN immobielentyp
NATURAL JOIN standort;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetDetailKopf(IN im_id INT)
BEGIN
SELECT imm_id as "obj_id",
gru_wohnflaeche as "qm",
kty_typ as "Kauf/Miete",
pre_preis as "Preis",
gru_gartenflaeche as "Garten",
gru_gesamtflaeche as "Gesammtf",
gru_nutzflaeche as "Grund"
FROM immobilie
NATURAL JOIN grund
NATURAL JOIN kaufstyp
NATURAL JOIN preis
WHERE imm_id = im_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetRaumanzahl(in im_id INT)
BEGIN
SELECT count(*) as "Raumanzahl" FROM raum 
WHERE imm_id = im_id
group by imm_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetHeizung(in im_id INT)
BEGIN
SELECT hww_typ as "Typ" FROM immobilie_heizungWarmwasser NATURAL JOIN heizungWarmwasser WHERE imm_id = im_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetFeatures(in im_id INT)
BEGIN
SELECT imf_faeturename From immobilie_immobielienfeatures NATURAL JOIN immobielienfeatures WHERE imm_id = im_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetKuechengeraete(in im_id INT)
BEGIN
SELECT kug_name as "Gerät" From raum_kuechengeraete NATURAL JOIN kuechengeraete NATURAL JOIN raum  WHERE imm_id = im_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetBadgeraete(in im_id INT)
BEGIN
SELECT bad_geraete FROM raum_bad NATURAL JOIN bad NATURAL JOIN raum WHERE imm_id = im_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetRestbezeichnungen(in im_id INT)
BEGIN
SELECT rzo_beschreibung FROM raum
NATURAL JOIN raumzuordnung
WHERE rzo_beschreibung NOT LIKE "Küche" AND rzo_beschreibung NOT LIKE "Badezimmer" AND imm_id = im_id ;
END //
DELIMITER ;


