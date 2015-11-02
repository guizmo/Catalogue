<html>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  <title>Catalogue</title>
  <meta name="description" content="">
  
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script type='text/javascript' src='jquery.js'></script>
 </head>
 <body >
<?php
//co a la BDD
$bdd = new PDO('mysql:host=localhost;dbname=catalogue', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  //LES DONNES pour alimenter les COMBOBOX 
$tab_type = ['Aucun Filtre','Formation','Accompagnement','Information','Service'];
$tab_famille = $bdd->query('SELECT libelle FROM famille');
$tab_cible = $bdd->query('SELECT libelle FROM cible');
$tab_lieu = $bdd->query('SELECT libelle FROM lieu');
//pour quand le type de formation sera rajouter dans les champes de tri.
$tab_form = ['Formation Diplomante','Certificat consulaire de spécialisation','AutoDiagnostic','Formation Proffesionnelle continue'];
?> 
<div class="container-fluid" id="fond" >
<div class="container-fluid" id="formulaire"  >
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-4">
            <img src="bootstrap/images/logo.jpg">  
        </div>
    </div>
    <div class="row">    
        <div class="col-md-offset-4 col-md-4">
            <legend>Produits et Services propos&eacute; par la CCI</legend>
        </div>
    </div>
   <!-- l'id zone c'est pour pouvoir l'identifer pour la fonction jquery  -->
<div class="container-fluid"  id="zone" >
    <!-- Début du formulaire -->
<form class="form-horizontal" method="post" >
<fieldset>
<!-- Module de recherche -->
    <div class="row">
        <div class="form-group">
            <!-- pour que la valeur reste dans le cahmp si la personne la taper puis a valider-->
            <?php $libelle=''; if(empty($_POST['libelle'])){}else{$libelle = $_POST['libelle'];} ?>
            <label class="col-md-4 control-label" for="libelle"><l5>Votre recherche</l5></label>  
            <div class="col-md-4">
            <input  id="libelle" name="libelle" type="text" placeholder="Tapez ici..." value="<?php echo $libelle;?>"class="form-control input-md">
            </div>
        </div>
    </div>
    <div class="row">
    
        <div class="form-group ">
<!-- Tri par type -->
    <label class="col-md-1 control-label" for="type"><l2>Type de Produit</l2></label>
   <div class="col-md-5" >
         <select id="type" name="type" class="form-control">
<?php
   foreach($tab_type as $value)
   {
   if($value == $_POST['type']){
   echo '<option style="color:#9acfea" value="'.$value.'" selected>'.$value.'</option>';
   }
   else{
   echo '<option value="'.$value.'">'.$value.'</option>';   
   }
   }
?> 
             </select>
      </div>
    <!-- tri par "famille" -->
  <label class="col-md-1 control-label" for="famille" ><l1>Th&eacute;matique</l1></label>
  <div class="col-md-5">
    <select id="famille" name="famille" class="form-control" >
     <?php
    if($_POST['famille'] == 'Aucun Filtre'){  echo '<option value="Aucun Filtre" selected>Aucun Filtre</option>'; }
    else{ echo '<option value="Aucun Filtre">Aucun Filtre</option>'; }  
    while($donnees = $tab_famille->fetch()){    
         if($donnees['libelle'] == $_POST['famille']){
     echo '<option value="'.$donnees["libelle"].'" selected>'.$donnees["libelle"].'</option>';
         }else {
     echo '<option value="'.$donnees["libelle"].'">'.$donnees["libelle"].'</option>';     
         }         }   ?>
     </select>
  </div>
</div>
</div>
<div class="row">
<!-- Select Basic -->
<div class="form-group">
    <!-- Trie selon les cibles -->
    <label class="col-md-1 control-label" for="cible"><l3>Public concern&eacute;</l3></label>
  <div class="col-md-5">
    <select id="cible" name="cible" class="form-control">
  <?php    if($_POST['cible'] == 'Aucun Filtre'){  echo '<option value="Aucun Filtre" selected>Aucun Filtre</option>'; }
    else{   echo '<option value="Aucun Filtre">Aucun Filtre</option>'; }  
     while($donnees = $tab_cible->fetch()){    
         if($donnees['libelle'] == $_POST['cible']){
     echo '<option value="'.$donnees["libelle"].'" selected>'.$donnees["libelle"].'</option>';
         }else {
     echo '<option value="'.$donnees["libelle"].'">'.$donnees["libelle"].'</option>';     
         }         }   ?>
    </select>
  </div>
            <!-- Trieu par lieu -->
    <label class="col-md-1 control-label" for="lieu"><l4>Lieu</l4></label>
  <div class="col-md-5">
    <select id="lieu" name="lieu" class="form-control">
      <?php    if($_POST['lieu'] == 'Aucun Filtre'){  echo '<option value="Aucun Filtre" selected>Aucun Filtre</option>'; }
    else{   echo '<option value="Aucun Filtre">Aucun Filtre</option>'; }  
     while($donnees = $tab_lieu->fetch()){    
         if($donnees['libelle'] == $_POST['lieu']){
     echo '<option value="'.$donnees["libelle"].'" selected>'.$donnees["libelle"].'</option>';
         }else {
     echo '<option value="'.$donnees["libelle"].'">'.$donnees["libelle"].'</option>';     
         }         }   ?>
    </select>
  </div>
</div>
</div>
    <div class="col-lg-offset-4 col-lg-4">
    <button id="submit" name="submit" class="btn btn-info btn-block" >Valider</button>
    </div>

  </fieldset> 
  </form> 
    <div class="col-lg-offset-5 col-lg-2">
    <form methode="post" action="index.php">
    <button id="reset" class="btn btn-danger btn-block" >Vider les champs</button>
    </form>
    </div>
             
</div>
             
            
</div>
     </div>     
<?php 
////////////////////////////////////////////////////////////////////////////////BLOC ENTETE TABLEAU///////////////////////////////////////////////////////////////////////////////
  ?>
<div class="container">
<div class="col-md-2"> 
<?php if (empty($_POST)){ ?> <button onclick="cache();"id="cacher" class="btn btn-success btn-block" >Agrandir le tableau</button> <?php }
else{?> <button onclick="cache();"id="cacher" class="btn btn-success btn-block" >Afficher le Formulaire</button> <?php }; ?>

</div>    
</div>
<!-- Zone d'entete du tableau-->
<div class="container-fluid-table" id="tableau" > 
      
 <table class="table-bordered " id="table">        
    <thead> 
      <tr>
                <th width ="5%">Libelle</th>
            <?php if(!empty($_POST) && $_POST['famille'] != "Aucun Filtre"){}else{echo '<th width ="10">Famille</th>'; } ?>  
            <?php if(!empty($_POST) && $_POST['type'] != "Aucun Filtre"){}else{ echo'<th width ="10%">Type</th>'; } ?>
                <th width ="10%">Objectif</th>
                <th width ="5%">Pre-Requis</th>
                <th width ="10%">Lieu</th>
                <th width ="10%">Format</th>
                <th width ="10%">Prix de Vente</th>
                <th width ="10%">Contact/Lien</th>
                
                
      </tr>
    </thead>       
     <?php 
////////TABLEAU QUAND ON ARRIVE DESSUS////         
 if (empty($_POST)){
$reponse = $bdd->query('SELECT * FROM produit Where Actif = "Oui"');        
// %27 = apostrophe
$demande=' Demande d%27information : '
 ?>  
   <tbody>         <?php
// On affiche chaque entrée une à une et on modifie certaine chose au passage pour l'affichage  
while($donnees = $reponse->fetch())
{  ?>  
      
      <tr>    
                <td width="10%"><?php echo $donnees['libelle']; ?></td>
            <?php if(!empty($_POST) && $_POST['famille'] != "Aucun Filtre"){}else{ echo'<h1><td width="5%">'; echo $donnees['famille']."</td></h1>"; } ?>
            <?php if(!empty($_POST) && $_POST['type'] != "Aucun Filtre"){}else{ echo'<td width="5%">'; echo $donnees['type']."</td>"; } ?>
                <td width="10%"><?php echo $donnees['objectif']; ?></td>
                <td width="5%"><?php echo $donnees['pre-requis']; ?></td>
                <td width="10%"><?php echo $donnees['lieu']; ?>
                <td width="10%"><?php echo $donnees['format']; ?></td>
                <td width="10%"><?php if($donnees['pv session ttc'] == 0){echo "Gratuit";}else{echo $donnees['pv session ttc'].'F';} ?></td>
                <td width="10%"><?php echo "<a href='mailto:".$donnees['contact']."?subject=".$demande.$donnees['libelle']." ".$donnees['code']."'>".$donnees['contact'].'</a><br><a href="'.$donnees['lien'].'">Télécharger la Fiche</a>'; ?></td>
                
      </tr>
<?php }    
                 

$reponse->closeCursor();
                  ?>
      
   </tbody> <?php
}else { 
////////////////////////////////////////////////////////////////////////////////TABLEAU QUAND RECHERCHE///////////////////////////////////////////////////////////////////////////////
    
$libelle = $_POST['libelle'];    
$famille = $_POST['famille'];
$cible = $_POST['cible'];
$lieu = $_POST['lieu'];
$type = $_POST['type'];
$champs =[$libelle,$famille,$cible,$lieu,$type];
$champstitre =['libelle','famille',"cible","lieu","type"];
$lieux =['CCI Bourail','CCI Koné','CCI Koumac','CCI Nouméa','CCI Poindimié'];
// on crée la requête SQL en fonction des champs remplit
$sql= 'SELECT * FROM produit WHERE ';
$ajout = '';
for($i=0;$i<5;$i++){ 
if($champs[$i] == 'Aucun Filtre'){}else{
   if($champstitre[$i] == 'libelle'){  
      $ajout =$ajout."(libelle LIKE '%".$libelle."%' OR famille LIKE '%".$champs[$i]."%' OR objectif LIKE '%".$champs[$i]."%')"; 
      if($champstitre[$i] == 'libelle' and $libelle == ""){ 
      $ajout = $champstitre[$i]." LIKE '%".$champs[$i]."%'";    
      }
      
     }else{
         //si le lieux choisit est une cci lié a une ville (CCI koné ou autre) on rajoute dans la requete les produits concerné par "toutes les cci"  également
     if($champs[$i] === 'CCI Koné' or $champs[$i] == 'CCI Koumac' or $champs[$i] == 'CCI Bourail'or $champs[$i] == 'CCI Nouméa'or $champs[$i] == 'CCI Poindimié')
     {$ajout=$ajout.' AND ( '.$champstitre[$i].' LIKE "%'.$champs[$i].'%" OR '.$champstitre[$i].' LIKE "%Toutes Les Cci%" )';}    
      
      else{
     $ajout =$ajout.' AND '.$champstitre[$i].' LIKE "%'.$champs[$i].'%"'; }}
             
}    
}  
$sql = $sql.$ajout.' AND Actif ="Oui" AND code NOT LIKE "%FINTRA%"';
//echo $sql;

//affichage du nombre de resultat retourné par la requete envoyé a la bdd 
$reponse = $bdd->query($sql);
if($reponse->rowCount() == 1){echo "<h3>".$reponse->rowCount()." resultat</h3>"; }
else{if($reponse->rowCount() == 0){echo "<h3>Aucun resultat"; }else{
echo "<h3>".$reponse->rowCount()." resultats</h3>";}}

?>
     <tbody>
             
             <?php
             
while($donnees = $reponse->fetch())
{   ?>
       
              <tr>
                <td width="10%"><?php echo $donnees['libelle']; ?></td>
                <?php if(!empty($_POST) && $_POST['famille'] != "Aucun Filtre"){}else{ echo'<td width="10%">'; echo $donnees['famille']."</td>"; } ?>
                <?php if(!empty($_POST) && $_POST['type'] != "Aucun Filtre"){}else{ echo'<td width="10%">'; echo $donnees['type']."</td>"; } ?>
                <td width="10%"><?php echo $donnees['objectif']; ?></td>
                <td width="10%"><?php echo $donnees['pre-requis']; ?></td>
                <?php echo'<td width="10%">'.$donnees['lieu']."</td>"; ?>
                <td width="10%"><?php echo $donnees['format']; ?></td>
                <td width="10%"><?php if($donnees['pv session ttc'] == 0){echo "Gratuit";}else{echo $donnees['pv session ttc'].'F';} ?></td>
                <td width="10%"><?php echo "<a href='mailto:".$donnees['contact']."?subject= Demande d'information :".$donnees['libelle']." ".$donnees['code']."'>".$donnees['contact'].'</a><br><a href="'.$donnees['lien'].'">Télécharger la Fiche</a>'; ?></td>
              </tr>
<?php   }  ?>
     </tbody> </table> </div>  </div><?php
}


   if (empty($_POST)){ ?><script type='text/javascript'>
// On attend que la page soit chargée 
jQuery(document).ready(function()
{
   // toggle() lorsque le lien avec l'ID #toggler est cliqué
   jQuery('#cacher').click(function()
  {    
      jQuery('#zone').slideToggle()(400);
      
      return false;
   });

});
//fonction pour changer le nom sur le bouton qui planque le formulaire
function cache()
    {
    if(document.getElementById("cacher").innerHTML === "Agrandir le tableau"){
                    document.getElementById("cacher").innerHTML = "Afficher le Formulaire";
                    
            }else{
                    document.getElementById("cacher").innerHTML = "Agrandir le tableau";
            }
    };

</script>  <?php   }else{ ?>
  <script> 
jQuery(document).ready(function()
{   jQuery('#cacher').click(function()
  {    
      jQuery('#zone').slideToggle()(400);
      
      return false;
   });   
   $('#zone').slideToggle()(400);
   
  });
  function cache()
    {
    if(document.getElementById("cacher").innerHTML === "Agrandir le tableau"){
                    document.getElementById("cacher").innerHTML = "Afficher le Formulaire";
                    
            }else{
                    document.getElementById("cacher").innerHTML = "Agrandir le tableau";
            }
    };
    </script>
    <?php  
  }
 ?> 

 </body>
</html>