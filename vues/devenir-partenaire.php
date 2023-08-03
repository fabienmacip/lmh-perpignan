<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Devenir partenaire';

// Captcha
$nb1 = rand(1, 5);
$nb2 = rand(1, 5);
$somme = $nb1 + $nb2;

function replaceNumberAsString($thechar) {
  
  switch($thechar) {
    case "0":
      return "3";
      break;
    case "1":
      return "5";
      break;
    case "2":
      return "7";
      break;
    case "3":
      return "9";
      break;
    case "4":
      return "0";
      break;
    case "5":
      return "8";
      break;   
    case "6":
      return "4";
      break;
    case "7":
      return "6";
      break;    
    case "8":
      return "2";
      break;
    case "9":
      return "1";
      break;
    default:
      return "";
  }
}

function myMd5($chaine) {
  $chaine =(string)$chaine;
  $chaine2 = '';

  for($j = 0 ; $j < strlen($chaine) ; $j++) {
    $chaine2 .= replaceNumberAsString($chaine[$j]);
  }
  
  return $chaine2;
}

$captchaCrypted = myMd5($somme);

/* * * * * * * * FIN CAPTCHA * * * * * * */


ob_start();
?>
<div class="container">
    <div class="row">
    
    <?php // TOASTER
    if(isset($partenaireToCreate) && $partenaireToCreate != ''){
      if(strpos($partenaireToCreate, "ajout")) {
        $partenaireToCreate = "Votre candidature a bien &eacute;t&eacute prise en compte.<br>Nous vous recontacterons d&egrave;s que possible.";
      }
      else {
        $partenaireToCreate = "Erreur lors de l'ajout de vos données.<br>Vous pouvez nous contacter par mail ou téléphone pour vous inscrire.";
      }
    ?>
      <div class="toaster" id="toaster-devenir-partenaire">
        <div onclick="closeToaster('toaster-devenir-partenaire')"><span>X</span></div>
        <div><?= $partenaireToCreate ?></div>
      </div>
    <?php
    }
    ?>

    
    
      <div class="col-12 col-lg-6 col-xl-6">
      <?php if(!isset($_SESSION['partenaire'])) { ?>
          <!-- <a href="#form-create-devenir-partenaire" id="lien-form-devenir-partenaire-up" onclick="lienFormDevenirPartenaire()">DEVENIR PARTENAIRE</a> -->
      <?php } ?>
          <p>
            <h3>
                Pourquoi adhérer ?
            </h3>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis totam corporis laborum, similique quaerat fugit facere sapiente amet rerum nobis tenetur sit incidunt, sed natus quos reiciendis commodi eveniet vero!
          </p>
          <p>
            <h3>Mise à disposition de salle de réunion.</h3>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum fuga molestiae inventore distinctio excepturi ex molestias ratione accusamus, possimus veritatis.
          </p>
          <p>
            <h3>Mise à disposition de 2 bureaux</h3>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi aspernatur dolore harum facere omnis impedit non laboriosam accusamus ut dolorem!
          </p>
          <p>
            <h3>Référencement produit & entreprise.</h3>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium voluptatem quo laudantium, vel consequatur officiis cum natus fugit nisi non incidunt quas, aperiam, harum qui error ab! Quia, pariatur vitae?
          </p>
          <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic consequuntur! Voluptatum mollitia odit enim iste inventore delectus maxime in voluptate quibusdam. Consequatur perspiciatis aliquid nihil et voluptate necessitatibus consequuntur illo quam deserunt quis est a veniam, nobis iste commodi quo harum recusandae reiciendis quaerat, vero aperiam? Autem, excepturi reiciendis!
          </p>
      
          <?php if(!isset($_SESSION['partenaire'])) { ?>
          <!-- <a href="#form-create-devenir-partenaire" id="lien-form-devenir-partenaire-down" onclick="lienFormDevenirPartenaire()">DEVENIR PARTENAIRE</a> -->
      <?php } ?>

      </div>
      
      <?php if(!isset($_SESSION['partenaire'])) { ?>
        
      <div class="col-12 col-lg-6 col-xl-6">

          <!-- ######################## DEBUT FORM CANDIDATURE PARTENAIRE #################### -->
          
          <form method="post" action="index.php" id="form-create-devenir-partenaire" class="mt-3 rounded py-3 px-2 bg-info lcf-form">
              <h4>Etre r&eacute;f&eacute;renc&eacute;</h4>    
              <div class="row">
                  <!-- <div class="col-12 col-md-12"> -->
                  <div class="form-group mb-2">
                      <!-- <label for="nom">Nom du pays</label> -->
                      <!-- <label for="nom">Nom de famille</label> -->
                      <input type="text" name="fdp-nom-entreprise" class="form-control" maxlength="40" id="fdp-nom-entreprise" placeholder="Nom de l'entreprise"
                      oninput="checkFormFieldDevenirPartenaire('fdp-nom-entreprise')" onblur="checkFormFieldDevenirPartenaire('fdp-nom-entreprise')" tabindex="1">
                      <div class="error-fdp-nom devenir-partenaire-form-error">Minimum 2 caract&egrave;res pour le nom</div>

                      <input type="text" name="fdp-activite-entreprise" class="form-control" maxlength="60" id="fdp-activite-entreprise" placeholder="Activité de l'entreprise en quelques mots"
                      oninput="checkFormFieldDevenirPartenaire('fdp-activite-entreprise')" onblur="checkFormFieldDevenirPartenaire('fdp-activite-entreprise')" tabindex="2">
                      <div class="error-fdp-nom devenir-partenaire-form-error">Minimum 2 caract&egrave;res pour le nom</div>

                      <input type="text" name="fdp-nom" class="form-control" maxlength="40" id="fdp-nom" placeholder="Saisissez le nom du partenaire"
                      oninput="checkFormFieldDevenirPartenaire('fdp-nom')" onblur="checkFormFieldDevenirPartenaire('fdp-nom')" tabindex="3">
                      <div class="error-fdp-nom devenir-partenaire-form-error">Minimum 2 caract&egrave;res pour le nom</div>

                      <input type="mail" name="fdp-mail" class="form-control" maxlength="40" id="fdp-mail" placeholder="Mail" tabindex="4"
                      oninput="checkFormFieldDevenirPartenaire('fdp-mail')" onblur="checkFormFieldDevenirPartenaire('fdp-mail')">
                      <div class="error-fdp-mail devenir-partenaire-form-error">Adresse mail incorrecte</div>

                      <input type="text" name="fdp-tel" class="form-control" maxlength="15" id="fdp-tel" placeholder="Téléphone" tabindex="5"
                      oninput="checkFormFieldDevenirPartenaire('fdp-tel')" onblur="checkFormFieldDevenirPartenaire('fdp-tel')">
                      <div class="error-fdp-tel devenir-partenaire-form-error">10 chiffres svp</div>
                  </div>
                  <div class="form-group mb-2">
                    <div id="div-conditions-devenir-partenaire" class="flex flex-row">
                        <div class="mr-5">
                            <input type="checkbox" name="fdp-conditions" id="fdp-conditions" onclick="checkFormFieldDevenirPartenaire('fdp-conditions')" tabindex="6">
                        </div>  
                        <div>
                            J'ai lu et j'accepte les conditions g&eacute;n&eacute;rales d'utilisation des donn&eacute;es.<br>
                            Consultez notre <a style="color:red;" class="link" onclick="popMentionsLegales()" tabindex="7">mentions légales</a>
                            pour en savoir plus sur l'utilisation de vos donn&eacute;es ou pour exercer vos droits et notamment votre droit d'opposition.
                        </div>	
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <div>
                        <input type="hidden" id="fdp-vcaptcha" name="fdp-vcaptcha" value="<?= $captchaCrypted ?>">
                        <input class="input" type="text" style="width:12rem; margin-top:1rem; margin-bottom:0;" maxlength="3" id="fdp-captcha" name="fdp-captcha" tabindex="8" placeholder="Combien font <?= $nb1 ?> + <?= $nb2 ?> ?"
                        oninput="checkFormFieldDevenirPartenaire('fdp-captcha')" onblur="checkFormFieldDevenirPartenaire('fdp-captcha')"><br>
                        <small><i>(Vérification anti-robots)</i></small>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                  <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                      <input type="hidden" name="action" id="action" value="createDevenirPartenaire">
                      <input type="hidden" name="page" id="page" value="devenir-partenaire">
                      <button type="reset" class="btn lcf-button CTAButton" tabindex="9">Reset</button>
                      <button id="fdp-submit" type="submit" class="btn lcf-button CTAButton btn-inactive" tabindex="10" disabled>Envoyer</button>
                  </div>
                  <!-- <div class="col-0 col-md-2"></div> -->
              </div>
              </form>
          
          <!-- ******************** FIN FORM AJOUT PARTENAIRE ************************* -->

      </div>

        <?php } ?>


    </div>
</div>

<div class="hidden-popup-mentions-legales">
  <?php require_once('page-mentions-legales.php'); ?>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');