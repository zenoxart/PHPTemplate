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

use filmverwaltung;

show tables;


DROP PROCEDURE MovieSearch;


-- searchfunction for movies
DELIMITER //
CREATE PROCEDURE MovieSearch(IN company VARCHAR(50))
BEGIN
IF (length(company) < 3) THEN
    SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Suchparamenter muss mindestents 3 Zeichen besitzen';
END IF;

IF (company is not null && company != "") THEN 
	
    SELECT 
		mov_title as "Titel", 
		mov_release as "Erscheinungs-Datum", 
		com_bezeichnung as "Produktionsfirma" 
    FROM 
		movie 
	NATURAL JOIN 
		company 
    WHERE 
		com_bezeichnung LIKE concat_ws("",company,"%");
    
	
	ELSE
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Bitte Wert zur Suche eingeben';
END IF;

END //
DELIMITER ;

CALL MovieSearch("");



DROP PROCEDURE SearchActor;


-- length 91 because varchar 45 + varchar 45 + 1 space varchar
DELIMITER //
CREATE PROCEDURE SearchActor(IN suchparam VARCHAR(91))
BEGIN
	IF (length(suchparam) >= 3) THEN 
		SELECT 
		mov_title as "Titel",
		mov_release as "Erscheinungs-Datum",
		com_bezeichnung as "Produktionsfirma",
		concat_ws(" ", act_fname, act_lname) as "Person",
		sta_iso as "Herkunft"
		FROM 
			movie_has_actor 
		NATURAL JOIN movie 
		NATURAL JOIN company 
		NATURAL JOIN actor 
		NATURAL JOIN state 
		WHERE concat_WS(" ",act_fname,act_lname) LIKE concat_ws(suchparam,"%","%");
    ELSE
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Suchparamenter muss mindestents 3 Zeichen besitzen';
    END IF;
END //
DELIMITER ;


CALL SearchActor("");

SHOW TABLES;

SELECT 
	mov_title as "Title", 
    mov_release as "Veröffentlichung", 
    com_bezeichnung as "Firma" 
FROM movie 
NATURAL JOIN company
WHERE mov_release between "1980-03-02" AND "2000-05-02";

DROP PROCEDURE MovieInDate;

DELIMITER //
CREATE PROCEDURE MovieInDate(IN dfrom DATE, IN dto DATE)
BEGIN
	
    IF(dto IS NULL OR dto LIKE '' OR nullif(dto,'') IS NULL) THEN
		SELECT 
		mov_title as "Title", 
		mov_release as "Veröffentlichung", 
		com_bezeichnung as "Firma" 
	FROM movie 
	NATURAL JOIN company
	WHERE mov_release 
		between dfrom AND current_date();
                
    ELSE
		SELECT 
			mov_title as "Title", 
			mov_release as "Veröffentlichung", 
			com_bezeichnung as "Firma" 
		FROM movie 
		NATURAL JOIN company
		WHERE mov_release 
			between dfrom AND dto;
		
    END IF;
	

END //
DELIMITER ;

CALL MovieInDate("1980-03-02","");


