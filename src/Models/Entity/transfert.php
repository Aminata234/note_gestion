# DEVLOG 1 — INITIALISATION DU PROJET NOTE GESTION

**Nom :** SY
**Prénom :** Aminata

---

## 1. Création du dossier du projet

La première étape a été de créer le dossier principal du projet nommé :

`note_gestion`

Ce dossier contient les différents éléments nécessaires au développement de l'application de gestion scolaire.

L'objectif du projet est de permettre la gestion :

* des années scolaires ;
* des élèves ;
* des inscriptions ;
* des classes ;
* des matières ;
* des périodes ;
* des évaluations et des notes ;
* des utilisateurs et de leurs rôles ;
* des établissements ;
* des responsables des élèves ;
* des transferts d'élèves.

Le projet est développé en **PHP orienté objet**, avec une base de données **PostgreSQL**.

---

## 2. Les tables choisies

Après l'analyse des besoins de l'application et de l'interface de gestion des élèves et inscriptions, les principales tables retenues sont :

### 2.1 `anneeScolaires`

Cette table permet de gérer les différentes années scolaires.

Elle contient notamment :

* `id`
* `nom`
* `date`
* `actif`

Exemple :

`2026-2027`

L'attribut `actif` permet d'indiquer l'année scolaire actuellement utilisée.

---

### 2.2 `eleves`

Cette table contient les informations principales des élèves.

Elle contient :

* `id`
* `nom`
* `prenom`
* `matricule`
* `date_naissance`
* `responsable_id`

Le matricule permet d'identifier de manière unique un élève.

---

### 2.3 `responsables`

Cette table permet d'enregistrer les personnes responsables des élèves.

Elle contient :

* `id`
* `nom`
* `prenom`
* `telephone`
* `email`

Un responsable peut être associé à un élève.

---

### 2.4 `classes`

Cette table permet de gérer les différentes classes de l'établissement.

Elle contient :

* `id`
* `nomClasse`

Exemples :

* CP A
* CM2 A
* CM2 B

---

### 2.5 `etablissements`

Cette table permet de gérer les établissements scolaires.

Elle peut contenir :

* `id`
* `nom`
* `adresse`
* `telephone`
* `email`

Elle permet notamment de gérer les établissements liés aux transferts des élèves.

---

### 2.6 `inscriptions`

Cette table représente l'inscription d'un élève dans une année scolaire et une classe.

Elle contient notamment :

* `id`
* `annee_id`
* `eleve_id`
* `classe_id`
* `etablissement_id`
* `statut`

Les statuts peuvent être :

* Inscrit
* Non affecté
* En attente

Cette table est importante car un même élève peut avoir plusieurs inscriptions au cours de sa scolarité.

---

### 2.7 `transferts`

Cette table permet de gérer les mouvements des élèves entre établissements.

Elle permet de distinguer :

* un transfert entrant ;
* un transfert sortant.

Elle peut contenir :

* `id`
* `eleve_id`
* `etablissement_source_id`
* `etablissement_destination_id`
* `type_transfert`
* `date_transfert`
* `motif`

---

### 2.8 `roles`

Cette table contient les différents rôles des utilisateurs de l'application.

Exemples :

* Direction d'établissement
* Professeur
* Surveillant

---

### 2.9 `utilisateurs`

Cette table permet de gérer les personnes pouvant se connecter à l'application.

Elle contient notamment :

* `id`
* `nom`
* `prenom`
* `telephone`
* `email`
* `password`
* `role_id`

Chaque utilisateur possède un rôle.

---

### 2.10 `matieres`

Cette table contient les matières enseignées.

Exemples :

* Mathématique
* Français
* Histoire-Géographie
* Science-physique

---

### 2.11 `matiere_classes`

Cette table permet de faire le lien entre les classes et les matières.

Elle permet de représenter une relation plusieurs-à-plusieurs :

Une classe peut avoir plusieurs matières et une matière peut être enseignée dans plusieurs classes.

---

### 2.12 `periodes`

Cette table permet de gérer les périodes scolaires.

Exemples :

* Trimestre 1
* Trimestre 2
* Trimestre 3

---

### 2.13 `evaluations`

Cette table permet d'enregistrer les notes obtenues par les élèves.

Elle contient notamment :

* `id`
* `inscription_id`
* `matiere_id`
* `periode_id`
* `devoir1`
* `devoir2`
* `composition`

Elle permet ensuite de calculer les moyennes des élèves.

---

# 3. Les entités choisies

Les principales entités identifiées dans le système sont :

* **Élève** : représente un apprenant inscrit dans l'établissement.
* **Responsable** : représente la personne responsable d'un élève.
* **Inscription** : représente l'inscription d'un élève pour une année et une classe.
* **Classe** : représente un groupe d'élèves.
* **Année scolaire** : représente une année académique.
* **Établissement** : représente une école.
* **Transfert** : représente le déplacement d'un élève d'un établissement vers un autre.
* **Utilisateur** : représente une personne utilisant l'application.
* **Rôle** : définit les droits ou fonctions d'un utilisateur.
* **Matière** : représente une discipline enseignée.
* **Période** : représente une période d'évaluation.
* **Évaluation** : représente les notes obtenues par un élève dans une matière et une période.

---

# 4. Les concepts orientés objet utilisés

Le projet est développé en **Programmation Orientée Objet (POO)**.

La POO permet d'organiser le programme autour d'objets représentant les éléments réels du système.

## 4.1 Classe

Une classe est un modèle permettant de créer des objets.

Par exemple, nous pouvons créer une classe `Eleve`.

Elle définit les informations et les comportements d'un élève.

```php
class Eleve
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $matricule;
}
```

La classe représente donc le modèle de l'entité Élève.

---

## 4.2 Objet

Un objet est une instance concrète d'une classe.

Par exemple :

```php
$eleve = new Eleve();
```

Ici, `$eleve` est un objet créé à partir de la classe `Eleve`.

On peut ensuite lui attribuer les informations d'un élève précis.

---

## 4.3 Attribut

Un attribut représente une donnée appartenant à un objet.

Dans la classe `Eleve`, par exemple :

```php
private string $nom;
private string $prenom;
private string $matricule;
```

`nom`, `prenom` et `matricule` sont des attributs.

Ils permettent de stocker les informations de l'élève.

---

## 4.4 Méthode

Une méthode est une fonction définie à l'intérieur d'une classe.

Elle représente une action ou un comportement de l'objet.

Exemple :

```php
public function getNom(): string
{
    return $this->nom;
}
```

La méthode `getNom()` permet de récupérer le nom de l'élève.

---

## 4.5 Constructeur

Le constructeur est une méthode spéciale appelée automatiquement lorsqu'un objet est créé.

En PHP, il s'écrit :

```php
public function __construct()
{
}
```

Il permet d'initialiser les attributs de l'objet.

Exemple :

```php
public function __construct(
    string $nom,
    string $prenom
) {
    $this->nom = $nom;
    $this->prenom = $prenom;
}
```

Lors de la création de l'objet :

```php
$eleve = new Eleve("Fall", "Awa");
```

le constructeur initialise automatiquement le nom et le prénom.

---

## 4.6 Encapsulation

L'encapsulation consiste à protéger les données internes d'un objet.

Pour cela, les attributs peuvent être déclarés `private`.

Exemple :

```php
private string $nom;
```

On ne modifie donc pas directement :

```php
$eleve->nom = "Fall";
```

On passe plutôt par des méthodes comme les getters et setters.

---

## 4.7 Getter

Un getter permet de récupérer la valeur d'un attribut privé.

Exemple :

```php
public function getNom(): string
{
    return $this->nom;
}
```

Il permet de lire la valeur de `$nom`.

---

## 4.8 Setter

Un setter permet de modifier la valeur d'un attribut privé.

Exemple :

```php
public function setNom(string $nom): void
{
    $this->nom = $nom;
}
```

Il permet de modifier le nom de l'élève tout en contrôlant la modification.

---

## 4.9 Héritage

L'héritage permet à une classe de récupérer les caractéristiques d'une autre classe.

Par exemple, une classe `Utilisateur` pourrait être une classe générale.

Des classes spécialisées pourraient ensuite hériter de celle-ci.

```php
class Professeur extends Utilisateur
{
}
```

`Professeur` récupère alors les caractéristiques de `Utilisateur` et peut avoir ses propres comportements.

---

## 4.10 Polymorphisme

Le polymorphisme permet à plusieurs classes de posséder une même méthode mais avec un comportement différent.

Par exemple, plusieurs types d'utilisateurs pourraient avoir une méthode :

```php
public function afficherMenu()
```

mais chaque type d'utilisateur pourrait afficher un menu différent selon son rôle.

---

## 4.11 Abstraction

L'abstraction consiste à représenter uniquement les éléments importants d'un objet sans exposer tous les détails de son fonctionnement.

Dans notre projet, l'utilisateur n'a pas besoin de connaître la manière dont les données sont enregistrées dans PostgreSQL pour utiliser l'application.

Par exemple, il demande simplement :

```php
$eleveRepository->findAll();
```

Le fonctionnement interne de la récupération des données est caché.

---

# 5. Résumé des concepts étudiés

| Concept           | Description courte                                                                         |
| ----------------- | ------------------------------------------------------------------------------------------ |
| **Classe**        | Modèle permettant de créer des objets                                                      |
| **Objet**         | Instance d'une classe                                                                      |
| **Attribut**      | Donnée appartenant à un objet                                                              |
| **Méthode**       | Action ou comportement d'un objet                                                          |
| **Constructeur**  | Initialise un objet lors de sa création                                                    |
| **Encapsulation** | Protège les données internes d'un objet                                                    |
| **Getter**        | Permet de lire un attribut privé                                                           |
| **Setter**        | Permet de modifier un attribut privé                                                       |
| **Héritage**      | Permet à une classe de récupérer les caractéristiques d'une autre                          |
| **Polymorphisme** | Permet à différentes classes d'utiliser une même méthode avec des comportements différents |
| **Abstraction**   | Cache les détails complexes et expose seulement l'essentiel                                |

---

## Conclusion

Cette première étape a permis de définir la structure générale du projet `note_gestion`, d'identifier les principales tables de la base de données ainsi que les entités du système.

Elle a également permis de commencer l'utilisation de la Programmation Orientée Objet avec les notions de **classe, objet, attribut, méthode, constructeur, encapsulation, getters, setters, héritage, polymorphisme et abstraction**.

Ces concepts serviront de base pour construire progressivement les **Models, Repositories, Services et Controllers** de l'application.
