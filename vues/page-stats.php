<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Statistiques';
ob_start();
?>
<div class="container">
  <div class="row">
    <h2>Statistiques</h2>
    <div>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet est sit voluptas assumenda error maiores nobis, explicabo, vero consectetur facere animi, nemo praesentium porro doloribus dolore. Dignissimos assumenda laborum sint obcaecati temporibus at beatae amet ea, fuga labore dolorum rem unde fugit recusandae sequi iusto harum, hic animi tempora nulla.
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');