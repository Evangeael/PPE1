<?php

class vue {
	
	private function entete($lesCategories) {
		echo "
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset='UTF-8'>
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

					<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
					<link rel=\"stylesheet\" href=\"css/style.css\">

					<title>BOUTIQ</title>
				</head>
				<body>
				<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
					<a class=\"navbar-brand\" href=\"#\">BOUTIQ</a>
					<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
						<span class=\"navbar-toggler-icon\"></span>
					</button>
				
					<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
						<ul class=\"navbar-nav mr-auto\">
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=accueil\">
									Accueil
								</a>
							</li>
							
							<li class=\"nav-item dropdown\">
								<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
									Catégories
								</a>
								<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
			";
			
			foreach($lesCategories as $uneCategorie) {
				echo "<a class=\"dropdown-item\" href=\"index.php?action=categorie&id=".$uneCategorie["idCategorie"]."\">".$uneCategorie["nomCategorie"]."</a>";
			}			

			echo "
								</div>
							</li>
			";

			if(isset($_SESSION["connexion"])) {
				echo "
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=deconnexion\">Déconnexion</a>
							</li>
				";
			}
			else {
				echo "
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=connexion\">Connexion</a>
							</li>
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=inscription\">Inscription</a>
							</li>
				";
			}
			
		echo "
							
						</ul>
						<ul class=\"my-2 my-lg-0 navbar-nav\">
							<li class=\"nav-item\" style=\"margin-left:20px;\">
								<a class=\"nav-link active\" href=\"index.php?action=panier\">
									Panier 
			";

		if(isset($_SESSION["panier"])) {
			echo "(".count($_SESSION["panier"]).")";
		}
		else {
			echo "(0)";
		}

		echo "
								</a>
							</li>
						</form>
					</div>
				</nav>
				<div id=\"content\">
		";
	}
	
	private function fin() {
		echo "
					</div>
					<script src=\"js/jquery-3.5.1.min.js\"></script>
					<script src=\"js/bootstrap.min.js\"></script>
				</body>
			</html>
		";
	}

	public function accueil($lesCategories) {
		$this->entete($lesCategories);

		echo "
			<h1>Bienvenue dans BOUTIQ !</h1>
		";

		$this->fin();
	}

	public function connexion($lesCategories,$erreur) {
		$this->entete($lesCategories);

		echo "
			<form method='POST' action='index.php?action=connexion'>
				<h1>Se connecter :</h1>
				<br/>
				<div class=\"form-group\">
					<label for=\"email\">Adresse email</label>
					<input type=\"email\" name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse\">Mot de passe</label>
					<input type=\"password\" name=\"motdepasse\" class=\"form-control\" id=\"motdepasse\" placeholder=\"●●●●●●\" required>
				</div>
				<br/>
				<a href=\"index.php?action=inscription\">Vous n'êtes pas encore client ? Inscrivez-vous !</a>
				<br/>
				<br/>
				<br/>
				<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Connexion</button>
			</form>
		";

		if($erreur)
		{
			echo"<p style=\"color : red\"> Identifiants ou mot de passe incorrect </p>";
		}

		$this->fin();
	}

	public function inscription($lesCategories,$erreur,$message) {
		$this->entete($lesCategories);

		echo "
			<form method='POST' action='index.php?action=inscription'>
				<h1>S'inscrire :</h1>
				<br/>
				<div class=\"form-group\">
					<label for=\"nom\">Votre nom</label>
					<input type=\"text\" name=\"nom\" class=\"form-control\" id=\"nom\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"prenom\">Votre prénom</label>
					<input type=\"text\" name=\"prenom\" class=\"form-control\" id=\"prenom\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"email\">Adresse email</label>
					<input type=\"email\" name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse\">Mot de passe</label>
					<input type=\"password\" name=\"motdepasse\" class=\"form-control\" id=\"motdepasse\" placeholder=\"●●●●●●\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse2\">Confirmer le mot de passe</label>
					<input type=\"password\" name=\"motdepasse2\" class=\"form-control\" id=\"motdepasse2\" placeholder=\"●●●●●●\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"adresse\">Votre adresse</label>
					<input type=\"text\" name=\"adresse\" class=\"form-control\" id=\"adresse\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"cp\">Votre code postal</label>
					<input type=\"text\" name=\"cp\" class=\"form-control\" id=\"cp\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"ville\">Votre ville</label>
					<input type=\"text\" name=\"ville\" class=\"form-control\" id=\"ville\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"tel\">Votre numéro de téléphone (facultatif)</label>
					<input type=\"tel\" name=\"tel\" class=\"form-control\" id=\"tel\">
				</div>
				<br/>
				<a href=\"index.php?action=connexion\">Vous êtes déjà client ? Connectez-vous !</a>
				<br/>
				<br/>
				<br/>
				<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Inscription</button>
			</form>
		";
		if($erreur)
		{
			echo ("<p style=\"color : red\">".$message."</p>");
		}

		$this->fin();
	}

	public function produit($lesCategories, $infoArticle, $message) {
		$this->entete($lesCategories);
		$stock = $infoArticle[3];
		echo "<div class=\"container\">";
		echo "<div class=\"row row-cols-2\">";
			echo"<div class=\"col\">";
					echo "<div class=row>
						<h1>".$infoArticle[1]."</h1>
					</div>";

				echo "<div class=\"row\">";
					echo "<img src=\"./images/".$infoArticle[4]."\" class=\"img-fluid\" alt=\"Image de ".$infoArticle[1]."\" style=\"width:50%\">";
				echo"</div>";
			echo"</div>";

			echo "<div class=\"col\">";
			echo "<div class=\"row\">
					<h2>".$infoArticle[2]."euros</h2>
					</div>";
					

				echo"<div class=\"row\">";
					if($stock>0)
					{
						echo	"<form method='POST' action=''>
								<select class='custom-select' name='quantite'>";

						for($i = 1; $i <= 10; $i++ )
						{
							echo "<option value=\"".$i."\">".$i."</option>";
						}

						echo	"</select>			
								<button type=\"submit\" name='ajoutPanier' class=\"btn btn-primary\" value='ok'> Ajouter au panier</button>
							</form>";
					}

					else
					{
						echo "<h2> PRODUIT HORS STOCK </h2>";
					}

					

					
					echo "</div>";
					echo"<div class=\"row\">".$message."</div>";	 
				echo "</div>";
				
			echo "</div>";
		echo "</div>";
		

		

		$this->fin();
	}

	public function panier($lesCategories, $lesArticles, $message) {
		$this->entete($lesCategories);
		if(isset($_SESSION["panier"]))
		{
		echo "
			<h1>Panier :</h1>
			<form method='POST' action='index.php?action=commander'>
				<table class=\"table\">
				<thead class=\"thead-dark\">
					<tr>
						<th style=\"width: 40%\">Désignation des articles</th>
						
						<th>Prix unitaire</th>
						<th>Quantité</th>
						<th>TOTAL</th>
						<th>Supprimer</th>
					</tr>
				</thead>
		";
		
			foreach($lesArticles as $unArticle)
			{
				$quantite = 0;
				foreach($_SESSION["panier"] as $truc)
				{
					if($truc==$unArticle[0])
					{
						$quantite++;
					}
				}
					echo "<tr>
					<th>".$unArticle[1]."</th>
					<td>".$unArticle[2]."</td>
					<td>".$quantite."</td>
					<td>".number_format($quantite*$unArticle[2],2)."
					<td>
					
					<button type=\"submit\" name=\"supprimer\" value=".$unArticle[0]." class=\"btn btn-primary\"> Supprimer </button>
					
					</td>
			
					</tr>
				
				";

				
		
			}
		

		// Créer un ligne du tableau pour chaque article du panier. Mettre un bouton supprimer dans la dernière colonne pour supprimer l'article du panier
		// ... A compléter ...

		echo "
				</table>
				
				<button type='submit' class=\"btn btn-primary\" name='valider'>Valider le panier</button>
			</form>
		";
		}
		else{
			echo "<h2> Panier vide</h2>";
		}

		$this->fin();
	}

	public function categorie($lesCategories, $lesArticles, $nomCategorie) {
		$this->entete($lesCategories);

		echo "
			<h1>".$nomCategorie."</h1>
			</br>
			<div class=\"container\">
			<div class=\"row row-cols-4\">";
			

			/*<div class=\"container\">
				<div class=\"row row-cols-3\">
				<div class=\"col px-lg-5 border bg-light\"><label style=\"font-weight:bold\">Image</label></div>
				<div class=\"col px-lg-5 border bg-light\"><label style=\"font-weight:bold\">Nom</label></div>
				<div class=\"col px-lg-5 border bg-light\"><label style=\"font-weight:bold\">Prix</label></div>*/
				
		
			foreach($lesArticles as $article)
			{
				
				echo"<div class=\"container\">";
				echo "<div class=\"col-\">";
				echo "<div class=\"row \"><img src=\"./images/".$article[4]."\" class=\"img-thumbnail\" alt=\"Image de ".$article[1]."\" style=\"width:100%\"></div>";
				echo "<div class=\"row \" ><a href=./index.php?action=produit&id=".$article[0].">".$article[1]."</a></button></div>";
				echo "<div class=\"row \">".$article[2]."€</div>";
				echo"</div>";
				echo "</div>";
			}
	
			

		echo "
				</div>
			</div>
		";

		$this->fin();
	}

	public function commandeValidee($lesCategories) {
		$this->entete($lesCategories);

		echo "
			<h1>Commande effectuée !</h1>
			<p>
				Votre commande a été validée avec succès !
			</p>
		";

		$this->fin();
	}

	public function erreur404($lesCategories) {
		http_response_code(404);

		$this->entete($lesCategories);

		echo "
			<h1>Erreur 404 : page introuvable !</h1>
			<br/>
			<p>
				Cette page n'existe pas ou a été supprimée !
			</p>
		";

		$this->fin();
	}
}