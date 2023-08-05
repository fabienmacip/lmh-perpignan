
                <?php

                    $_SESSION['partenaireActuel'] = isset($_SESSION['partenaireActuel']) ? $_SESSION['partenaireActuel'] : $_SESSION['partenaire'];

                    // On affecte un tableau (array) par bureau pour avoir un tableau de réservations par bureau
                    $buros = [];
                    $nbBuros = intval($nbBureaux[0]["total"]);
                    for($i = 0; $i < $nbBuros; $i++){
                        $buros[$i] = array_filter($calendars, function($c) use ($i) {
                            return $c->getIdBureau() == (intval($i)+1);
                        });
                    }

                    // DEBUT liste DES CARDS
                    $index = 0;
                    foreach($bureaux as $bureau):
                ?>
                        <div id="bureau-<?= $bureau->getId() ?>" class="bureau-card">
                            <div class="bureau-entete">
                                <div class="bureau-title">
                                    <h2><?= $bureau->getTitre() ?></h2>
                                    <p><?= $bureau->getDescription() ?></p>
                                </div>    
                                <div class="bureau-img1">
                                    <img src="<?= $bureau->getImg() ?>" onclick="displayBigImg('<?= $bureau->getImg() ?>','bureau-img1-<?= $bureau->getId() ?>')" id="bureau-img1-<?= $bureau->getId() ?>">
                                </div>
                            </div>    
                            <div class="bureau-corps" id="bureau-corps-<?= $bureau->getId() ?>">
                                <?php
                                    $calendrierDuBureau = $buros[$index];
                                    require(dirname(__FILE__,2).'/vues/bureauCalendar-admin.php'); 
                                ?>
                            </div>
                            <div class="bureau-footer tr">
                                <img 
                                    class="logo-bureau-footer box" 
                                    src="img/logo/logo-la-reference-350x311-transparent.png"
                                    alt="La maison de l'habitat (by La Centrale de Financement) - Perpignan"
                                >
                            </div>
                        </div>

                <?php   
                    $index++;
                    endforeach; 
                    // FIN liste des CARDS      
                ?>
