
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	
	<title> resultat de recherche </title>


  
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('../images/demo/backgrounds/karim.JPG');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div class="fl_left"> 
        <!-- ################################################################################################ -->
        <ul class="nospace">
          <li><i class="fas fa-phone"></i> 01 82 28 07 65</li>
          <li><i class="far fa-envelope"></i> kalya@domain.com</li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
      <div class="fl_right"> 
        <!-- ################################################################################################ -->
        <ul class="nospace">
          <li><a href="index.html"><i class="fas fa-home"></i></a></li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
      <!-- ################################################################################################ -->
    </div>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      
        <a href="../index.html"><img src="../images/demo/Kalya_blanc.PNG" style="max-width: 10%; height: auto;"></a>
      
      <!-- ################################################################################################ -->
        <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li class="active"><a href="../index.html">Accueil</a></li>
          <li><a  href="search_bar.php">Recherche</a>
            
          </li>
          <li><a href="#">Kalya stats</a>
            <ul>
              <li><a href="https://alexandreds.shinyapps.io/kalya/?_ga=2.121700683.1907946828.1616710194-309697954.1614335739">Rshiny</a></li>
              <li><a  href="vizu.html">Dash</a>
                
              </li>
              
            </ul>
          </li>
          <li><a href="Contact.html">Contact</a></li>
          
          
        </ul>
    </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>








<?php
 
 include 'connexion_db.php';
 
?>
        <form method="POST" action="search.php">



<!------ Include the above in your HEAD tag ---------->

<div class="container" style="padding-left: 330px">
	<div class="row" style="margin-left: 100px; margin-right: -850px;">
        <div class="col-md-6" style="width: 800px">
    		<h2 style="margin-left: 300px;">Votre recherche</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="search" name="recherche"  class="form-control input-lg" placeholder="Tapez votre recherche…" value="" />
                    <input type="submit" name="recherchebouton" value="Rechercher" />

                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>
            


<?php
$dbh=getBD();

echo "<table border = 3> 
	<tr>
		<td> Sports </td>
		<td> Objectifs </td>
		<td> Traitement non médicamenteux </td>
		
	</tr>";

$recherche = strtolower($_POST['recherche']);

$tryptics = array();
$links=array();


foreach($dbh->query("SELECT distinct * from tkayla, articles where tkayla.pmid = articles.pmid and tkayla.npi != '[]'and tkayla.out != '[]' and tkayla.sport like '%$recherche%'" ) as $row) {

		/*echo"<tr><td>".$row['sport']."</td><td>".$row['out']."</td><td>"."</td><td>".$row['npi']."</td>";*/
		
		$sports = explode (',', $row["sport"]);
		$outs = explode ('#', $row["out"]);
		$npis = explode (';', $row["npi"]);

		foreach ($sports as $key => $value) {
			
			$res = explode("/'", $value);
			foreach ($res as $key => $value3) {
				$val = str_replace("[", "", $value3);
				$val = str_replace("]", "", $val);
				$val = strtolower(str_replace("'", "", $val));





				if ($val == $recherche) {
					foreach ($outs as $key => $value2) {
						foreach ($npis as $key => $value1) {
							
							echo "<tr>
								<td> ".$recherche." </td>
								
								<td> ".$value2." </td>
								<td> ".$value1." </td>
							</tr>";
							

							/*echo "<tr>
								<td> ".$recherche." </td>
								<td> ".$val." </td>
								<td> ".$value2." </td>
								<td> ".$value1." </td>
							</tr>";
							*/
						}
					}
				}
			}
		}
		
	}
	echo "</table>";
?>
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>

</body>
</html>