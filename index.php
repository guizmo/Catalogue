<html>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php header('Content-Type: text/html; charset=UTF-8'); ?>
  <title>Catalogue</title>
  <link href="bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
 </head>
 <body >
 <script type='text/javascript'>
/* <![CDATA[ */ 

 
// On attend que la page soit chargée 
jQuery(document).ready(function()
{
   // On cache la zone de texte
  
   // toggle() lorsque le lien avec l'ID #toggler est cliqué
   jQuery('#cacher').click(function()
  {    
      jQuery('#zone').slideToggle()(400);
      
      return false;
   });

});

function cache()
    {
    if(document.getElementById("cacher").innerHTML === "Agrandir le tableau"){
                    document.getElementById("cacher").innerHTML = "Réduire le tableau";
                    document.getElementById("span").className= "'glyphicon glyphicon-menu-up'";
                    
            }else{
                    document.getElementById("cacher").innerHTML = "Agrandir le tableau";         
                    document.getElementById("span").className= "'glyphicon glyphicon-menu-down'";;
            }
    }

</script>  
<?php
// LES FONCTIONS 
//AU DEMARAGE
//try pour voir si on a pas une erreur au démarage
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=catalogue', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
//LES DONNES COMBOBOX ET AUTRES 
$tab_type = ['Aucun Filtre','Formation','Accompagnement','Information','Service'];
$tab_famille = $bdd->query('SELECT libelle FROM famille');
$tab_cible = $bdd->query('SELECT libelle FROM cible');
$tab_lieu = $bdd->query('SELECT libelle FROM lieu');
//pour quand le type de formation sera rajouter.
$tab_form = ['Formation Diplomante','Certificat consulaire de spécialisation','AutoDiagnostic','Formation Proffesionnelle continue'];

 //MODULE DE RECHERCHE PAS TOUCHER  ?> 

     <div class="container-fluid" >
         <div class="col-md-12">


<div class="row">
    <div class="col-lg-4">
<img src="images/test.jpg">  
    </div></div>
<div class="row">    
    <div class="col-md-offset-4 col-md-4">
<legend>Produits et Services propos&eacute; par la CCI</legend>
</div></div>
             <div class="container"  id="zone" >
<form class="form-horizontal" method="post" >
<fieldset>
<!-- Module de recherche -->
<div class="row">
<div class="form-group">
  <label class="col-md-4 control-label" for="libelle">Votre recherche</label>  
  <div class="col-md-4">
      <input  id="libelle" name="libelle" type="text" placeholder="Tapez ici..." value="<?php if(empty($_POST['libelle'])){}else{echo $_POST['libelle'];} ?>"class="form-control input-md">
  </div>
 <?php // <div class="col-md-3">   <?php if(!empty($_POST)){echo "Votre recherche retourne : ".$reponse1." resultats";} </div>  ?>
</div>
</div>
<div class="row">
<div class="form-group ">
    <label class="col-md-1 control-label" for="type"><l2>Type de Produit</l2></label>
   <div class="col-md-5" >
         <select id="type" name="type" class="form-control">
<?php
   foreach($tab_type as $value)
   {
   if($value == $_POST['type']){
   echo '<option value="'.$value.'" selected>'.$value.'</option>';
   }
   else{
   echo '<option value="'.$value.'">'.$value.'</option>';   
   }
   }
?> 
             </select>
      </div>
  <label class="col-md-1 control-label" for="famille" ><l1>Th&eacute;matique</l1></label>
  <div class="col-md-5">
    <select id="famille" name="famille" class="form-control" >
     <?php
    if($_POST['famille'] == 'Aucun Filtre'){  echo '<option value="Aucun Filtre" selected>Aucun Filtre</option>'; }
    else{   echo '<option value="Aucun Filtre">Aucun Filtre</option>'; }  
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
     <?php //EN TETE                  ?>
     
<?php 
////////////////////////////////////////////////////////////////////////////////BLOC ENTETE TABLEAU///////////////////////////////////////////////////////////////////////////////
  ?>
<div class="container">
<div class="col-md-offset-7 col-md-3"> 
<button onclick="cache();"id="cacher" class="btn btn-success btn-block" >Agrandir le tableau</button>
</div>    
</div>
<div class="container-fluid-table" id="tableau" > 
      
 <table class="table-bordered ">        
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
////////////////////////////////////////////////////////////////////////////////TABLEAU AU DEMARAGE///////////////////////////////////////////////////////////////////////////////          
 if (empty($_POST)){
$reponse = $bdd->query('SELECT * FROM produit Where Actif = "Oui"');        
 ?>  
   <tbody>         <?php
// On affiche chaque entrée une à une   
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
                <td width="10%"><?php echo "<a href='mailto:".$donnees['contact']."?subject= Demande d'information :".$donnees['libelle']." ".$donnees['code']."'>".$donnees['contact'].'</a><br><a href="'.$donnees['lien'].'">Télécharger la Fiche</a>'; ?></td>
                
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
//on a mis libelle juste pour que ca soit plus simple pour la requete
$champs =[$libelle,$famille,$cible,$lieu,$type];
$champstitre =['libelle','famille',"cible","lieu","type"];
////LES é NE MARCHE PPAASSS//////////////////////////////////////////////////////////////////////////////////////////////////
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
         //si le lieux choisit est une cci dans une ville (CCI koné ou autre) on rajoute dans la requete les produits concérné par "toutes les cci" 
     if($champs[$i] === 'CCI Koné' or $champs[$i] == 'CCI Koumac' or $champs[$i] == 'CCI Bourail'or $champs[$i] == 'CCI Nouméa'or $champs[$i] == 'CCI Poindimié')
     {$ajout=$ajout.' AND ( '.$champstitre[$i].' LIKE "%'.$champs[$i].'%" OR '.$champstitre[$i].' LIKE "%Toutes Les Cci%" )';}    
      
      else{
     $ajout =$ajout.' AND '.$champstitre[$i].' LIKE "%'.$champs[$i].'%"'; }}
             
}    
}  
$sql = $sql.$ajout.' AND Actif ="Oui" AND code NOT LIKE "%FINTRA%"';
//echo $sql;

//RECHERCHE SEUL
$reponse = $bdd->query($sql);
if($reponse->rowCount() == 1){echo "<h3>".$reponse->rowCount()." resultat</h3>"; }
else{if($reponse->rowCount() == 0){echo "<h3>Aucun resultat"; }else{
echo "<h3>".$reponse->rowCount()." resultats</h3>";}}

//Boucle pour savoir faire la recherche avec quoi  



//test 
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
     </tbody> </table> </div>  <?php
}

?>   
 </body>
</html>