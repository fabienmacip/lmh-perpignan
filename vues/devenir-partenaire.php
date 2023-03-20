<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Devenir partenaire';
ob_start();
?>
<div class="container">
    <div class="row">
      <div class="col-0 col-lg-1 col-xl-2">
          DEVENIR PARTENAIRE
          <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, hic consequuntur! Voluptatum mollitia odit enim iste inventore delectus maxime in voluptate quibusdam. Consequatur perspiciatis aliquid nihil et voluptate necessitatibus consequuntur illo quam deserunt quis est a veniam, nobis iste commodi quo harum recusandae reiciendis quaerat, vero aperiam? Autem, excepturi reiciendis!
          </p>
      
      </div>
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

        <!-- ######################## DEBUT FORM CANDIDATURE PARTENAIRE #################### -->
        
        <form method="post" action="index.php" id="form-create-devenir-partenaire" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Devenir partenaire</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <!-- <label for="nom">Nom de famille</label> -->
                    <input type="text" name="nom" class="form-control" maxlength="40" id="nom" placeholder="Saisissez le nom du partenaire">
                    <input type="mail" name="mail" class="form-control" maxlength="40" id="mail" placeholder="Mail">
                    <input type="text" name="telephone" class="form-control" maxlength="15" id="telephone" placeholder="Téléphone">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createDevenirPartenaire">
                    <input type="hidden" name="page" id="page" value="devenir-partenaire">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT PARTENAIRE ************************* -->
    </div>

    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');