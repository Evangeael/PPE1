<?php

class categorie {
	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct() {
		$config = parse_ini_file("config.ini");
		
		try {
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	// Récupérer toutes les catégories
	public function getAll() {
		$sql = "SELECT * FROM categorie";
		
		$req = $this->pdo->prepare($sql);
		$req->execute();
		
		return $req->fetchAll();
	}
	
	// Récupérer la liste des produits de la catégorie passée en paramètre
	public function getProduits($categorie) {
		$sql = "SELECT produit.* FROM produit INNER JOIN categorie ON produit.idCategorie = categorie.idCategorie WHERE categorie.idCategorie = :idCategorie";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idCategorie', $categorie, PDO::PARAM_INT);
		$req->execute();
		return $req->fetchAll();
	}

	// Récupérer le nom de la catégorie passé en paramètre
	public function getNomCategorie($categorie) {
		$sql = "SELECT nomCategorie FROM categorie WHERE categorie.idCategorie = :idCategorie";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idCategorie', $categorie, PDO::PARAM_INT);
		$req->execute();
		$resu = $req->fetch(PDO::FETCH_NUM);
		return $resu[0];

	}
}