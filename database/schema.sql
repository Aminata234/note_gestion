-- Ordre correct pour les FK



DROP TABLE IF EXISTS evaluations CASCADE;
DROP TABLE IF EXISTS transferts CASCADE;
DROP TABLE IF EXISTS inscriptions CASCADE;
DROP TABLE IF EXISTS matiere_classes CASCADE;
DROP TABLE IF EXISTS matieres CASCADE;
DROP TABLE IF EXISTS periodes CASCADE;
DROP TABLE IF EXISTS eleves CASCADE;
DROP TABLE IF EXISTS classes CASCADE;
DROP TABLE IF EXISTS utilisateurs CASCADE;
DROP TABLE IF EXISTS roles CASCADE;
DROP TABLE IF EXISTS anneeScolaires CASCADE;
DROP TABLE IF EXISTS responsables CASCADE;
DROP TABLE IF EXISTS statut_inscriptions CASCADE;
DROP TABLE IF EXISTS statut_transferts CASCADE;

CREATE TABLE roles(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (nom <> '')
);

CREATE TABLE responsables(
    id SERIAL PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL CHECK (prenom <> ''),
    nom VARCHAR(50) NOT NULL CHECK (nom <> ''),
    numero VARCHAR(50) NOT NULL CHECK (length(numero) >= 9),
    adresse VARCHAR(50) NOT NULL CHECK (adresse <> '')
);

CREATE TABLE statuts(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (nom <> '')
);

CREATE TABLE utilisateurs(
    id SERIAL PRIMARY KEY,
    nomComplet VARCHAR(50) NOT NULL CHECK (nomComplet <> ''),
    login VARCHAR(50) UNIQUE NOT NULL CHECK (length(login) >= 4),
    password VARCHAR(50) NOT NULL CHECK (length(password) >= 6),
    role_id INT REFERENCES roles(id) ON DELETE SET NULL
);

CREATE TABLE anneeScolaires(
    id SERIAL PRIMARY KEY,
    annee VARCHAR(50) NOT NULL UNIQUE CHECK (annee <> '')
);

CREATE TABLE etablissements(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (nom <> '')
);

CREATE TABLE classes(
    id SERIAL PRIMARY KEY,
    id_etablissement INT REFERENCES etablissements(id) ON DELETE CASCADE NOT NULL,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (nom <> '')
);

CREATE TABLE eleves(
    id SERIAL PRIMARY KEY,
    nomComplet VARCHAR(50) NOT NULL CHECK (nomComplet <> ''),
    matricule VARCHAR(50) NOT NULL UNIQUE CHECK (matricule <> ''),
    id_responsable INT REFERENCES responsables(id) ON DELETE SET NULL
);

CREATE TABLE inscriptions(
    id SERIAL PRIMARY KEY,
    id_eleve INT REFERENCES eleves(id) ON DELETE CASCADE NOT NULL,
    id_annee INT REFERENCES anneeScolaires(id) ON DELETE CASCADE NOT NULL,
    id_classe INT REFERENCES classes(id) ON DELETE CASCADE NOT NULL,
    id_utilisateur INT REFERENCES utilisateurs(id) ON DELETE SET NULL,
    UNIQUE(id_eleve, id_annee)
);

CREATE TABLE transfert(
    id SERIAL PRIMARY KEY,
    id_inscription INT REFERENCES inscriptions(id) ON DELETE CASCADE NOT NULL,
    id_etablissement_sortant INT REFERENCES etablissements(id) NOT NULL,
    id_etablissement_entrant INT REFERENCES etablissements(id) NOT NULL CHECK (id_etablissement_sortant <> id_etablissement_entrant),
    statut VARCHAR(30) CHECK (statut IN ('EN ATTENTE', 'INSCRIT', 'NON AFFECTE')) DEFAULT 'EN ATTENTE'
);


SELECT e.nomComplet, c.nom as classe, et.nom as etablissement, t.statut
FROM transfert t
JOIN inscriptions i ON t.id_inscription = i.id
JOIN eleves e ON i.id_eleve = e.id
JOIN classes c ON i.id_classe = c.id
JOIN etablissements et ON c.id_etablissement = et.id;


-- 1. AJOUTE LA COLONNE QUI MANQUE POUR TA VUE
ALTER TABLE eleves ADD COLUMN IF NOT EXISTS date_naissance DATE;

-- 2. NETTOIE
TRUNCATE responsables, eleves, inscriptions CASCADE;

-- 3. RESPONSABLES (exactement ta vue)
INSERT INTO responsables (id, prenom, nom, numero, adresse) VALUES
(1, 'Marième', 'Fall', '+221 77 420 18 04', 'Dakar'),
(2, 'Khadidiatou', 'Sy', '+221 70 456 78 90', 'Dakar'),
(3, 'Ibrahima', 'Tidiane', '+221 77 999 88 77', 'Thies'),
(4, 'Babacar', 'Diop', '+221 77 333 22 11', 'Mbour'),
(5, 'Saliou', 'Ndiaye', '+221 78 444 33 22', 'Dakar')
ON CONFLICT (id) DO NOTHING;

-- 4. ELEVES (exactement ta vue JS)
INSERT INTO eleves (id, nomComplet, matricule, date_naissance, id_responsable) VALUES
(1, 'Awa Fall', 'JE-26001', '2014-05-18', 1),
(2, 'Mariama Ba', 'JE-26007', '2014-05-30', 2),
(3, 'Cheikh Tidiane', 'JE-26008', '2018-02-15', 3),
(4, 'Mouhamed Diop', 'JE-26011', '2019-03-10', 4),
(5, 'Aïssatou Ndiaye', 'JE-26012', '2019-07-22', 5)
ON CONFLICT (id) DO NOTHING;

-- 5. INSCRIPTIONS 2026-2027
-- 1=CI A, 2=CP A, 3=CM2 A
INSERT INTO inscriptions (id_eleve, id_annee, id_classe, id_utilisateur) VALUES
(1, 2, 3, 1),
(2, 2, 3, 1),
(3, 2, 2, 1),
(4, 2, 1, 1),
(5, 2, 1, 1)
ON CONFLICT (id_eleve, id_annee) DO NOTHING;

-- 6. REQUETE POUR TON Repository -> elle donne tout ce que ta vue a besoin
SELECT 
  e.nomComplet,
  e.matricule,
  e.date_naissance,
  c.nom as classe_nom,
  SUBSTRING(c.nom FROM '[A-Z]+') as niveau,
  et.nom as etablissement,
  r.prenom as resp_prenom,
  r.nom as resp_nom,
  r.numero as resp_numero,
  -- Statut calculé comme dans ta vue
  CASE 
    WHEN e.id IN (4,5) AND e.id = 4 THEN 'Non affecté'
    WHEN e.id = 5 THEN 'En attente'
    ELSE 'Inscrit'
  END as statut
FROM eleves e
JOIN inscriptions i ON i.id_eleve = e.id
JOIN classes c ON c.id = i.id_classe
JOIN etablissements et ON et.id = c.id_etablissement
JOIN responsables r ON r.id = e.id_responsable
WHERE i.id_annee = 2;

SELECT * FROM eleves;