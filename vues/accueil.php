<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Accueil';

ob_start();
?>

<!-- SLIDER -->

<div id="slider-back">
  <div id="slider">
    <figure>
    <?php 
      $universsSlider = $universs;
      array_unshift($universsSlider,end($universsSlider));
      $cptSlider = 0;
      foreach ($universsSlider as $univers):
    ?>

        <div class="slider-divs absolute" style="left:calc((<?= $cptSlider ?> * (100% / 7)) + 10px);" onclick="showUnivers('<?= $univers->getId() ?>')">
          <span><?= $univers->getNom() ?></span>
        </div>

        <img src="img/univers/<?= $univers->getImage() ?>" alt="<?= $univers->getNom() ?>" alt="<?= $univers->getNom() ?>" onclick="showUnivers('<?= $univers->getId() ?>')">
        
    <?php 
      $cptSlider++;
      endforeach; 
    ?>
    </figure>
  </div>
</div>

<!-- FIN SLIDER -->


<div class="container m-0 mt-3 max-width-100vw">
  <div class="row max-width-100percent jcc" id="accueil-text-boxes">
    
    <div class="flex-1 accueil-text-boxes">
      <h2>Bienvenue sur notre site</h2>
      <p>
        La Référence, Agence Immobilière by Jérôme COUDRAY est heureuse de vous compter parmi les visiteurs de son site internet!
      </p>
      <p>
        Présent sur l'agglomération Nantaise et le littoral, pour l'achat, la vente et la mise en location de biens,
        nous avons comme objectif la satisfaction client.
      </p>      
      <p>
        Le professionnalisme tant commercial que juridique, l'écoute, le conseil et la rigueur seront autant d'atoûts pour concrétiser vos projets immobiliers.
      </p>
    </div>

    <div class="flex-1 accueil-text-boxes">
      <h2>Devenir partenaire</h2>
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
    </div>

  </div>
</div>














<?php 
      foreach ($universs as $univers):
/* $univers->getNom() */
 endforeach; ?>








<?php
$contenu = ob_get_clean();
require_once('layout.php');