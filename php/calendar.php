<?php
/**
*   Ce programme affiche un calendrier.
*
*   Version 1.0 LR 20.12.17 initiale.
*
*
**/
const JOUR_ANGLAIS = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
const LISTE_MOIS = array(1 => "Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

$idArticle="1";
// $datesNonDisponible = getDatesNonDisponibles($idArticle);
$moisAffiche = FILTER_INPUT(INPUT_POST,'moisHidden');
$anneeAffiche = FILTER_INPUT(INPUT_POST,'anneeHidden');
$btnMoisAvant = FILTER_INPUT(INPUT_POST,'moisAvant');
$btnMoisApres = FILTER_INPUT(INPUT_POST,'moisApres');

$globalJourActuel = date("d", time());
$globalMoisActuel = date("n", time());
$globalAnneeActuel = date("Y", time());

// Si le mois ou l'année a pas été recuperé depuis les champs hidden, leur donne la valeur du mois et de l'année actuelle.
if (!$moisAffiche || !$anneeAffiche)
{
    $moisAffiche = $globalMoisActuel;
    $anneeAffiche = $globalAnneeActuel;
}
else
{
    // Si le boutton moi précédent a été coché, recule de 1 moi.
    if ($btnMoisAvant)
    {
        $moisAffiche = $moisAffiche - 1;
        // Si le moi actuel est a 0, le remet a 12 et descend d'une année.
        if ($moisAffiche == 0)
        {
            $moisAffiche = 12;
            $anneeAffiche = $anneeAffiche - 1;
        }
    }
    if ($btnMoisApres)
    {
        $moisAffiche = $moisAffiche + 1;
        if ($moisAffiche == 13)
        {
            $moisAffiche = 1;
            $anneeAffiche = $anneeAffiche + 1;
        }
    }
}

// //TODO get real data
// function getDatesStage() {
//     $dispo1 = array('jour'=>'23','mois'=>'03','annee'=>'2019');
//     $dispo2 = array('jour'=>'11','mois'=>'03','annee'=>'2019');
//     $dispo3 = array('jour'=>'4','mois'=>'03','annee'=>'2019');
//     $datesStage = array($dispo1, $dispo2,$dispo3);
//
//     return $datesStage ;
// }
//
// function isDateStage($jour, $mois, $annee, $datesStage){
//     foreach ($datesStage as $value)
//     {
//         if ($jour == $value["jour"] && $mois == $value["mois"] && $annee == $value["annee"])
//         {
//             return true;
//         }
//     }
// }

function generateCalendar($moisAffiche, $anneeAffiche, $jourAnglais){

    $jourCalendrier = 1;
    $nbDeJour = cal_days_in_month(CAL_GREGORIAN,$moisAffiche,$anneeAffiche);
    $jourCommencementMois = date("l", strtotime($anneeAffiche."-".$moisAffiche."-".$jourCalendrier));
    $numeroCaseCommencementMois = array_search($jourCommencementMois,$jourAnglais);
    $jourActuel = date("d", time());
    $moisActuel = date("n", time());
    $anneeActuel = date("Y", time());
    $classeJour = "PasVide";


    for ($ligne=0; $ligne < 6 ; $ligne++)
    {
        echo "<tr>";
        for ($colonne=0; $colonne < 7 ; $colonne++)
        {
            if( ($ligne == 0 && $colonne < $numeroCaseCommencementMois)|| $jourCalendrier > $nbDeJour)
            {
                echo "<td class=\"Vide\"></td>";
            }
            else
            {

                // if(isDateStage($jourCalendrier,$moisAffiche,$anneeAffiche,$datesStage))
                // {
                //     $classeJour = "<td class=\"jourStage\" onclick=\"showInscription($jourCalendrier,$moisAffiche,$anneeAffiche)\">$jourCalendrier</td>";
                //
                // }

                // else
                // {
                    $classeJour = "  <td class=\"pasVide\">$jourCalendrier</td>";
                // }

                echo $classeJour;
                $jourCalendrier++;
            }
        }
        echo "</tr>";
    }
}

?>
    <div class="conteneur">
        <!-- <div class="titre"> -->
            <!-- <h1>Réserver une date</h1> -->
            <!-- <hr> -->
            <table>
                <tr>
                    <form action="#" method="post">
                        <input type="hidden"  name="moisHidden" value="<?php echo $moisAffiche; ?>">
                        <input type="hidden" name="anneeHidden" value="<?php echo $anneeAffiche; ?>">
                        <td class="pasBordure"><input type="submit" name="moisAvant" value="<"></td>
                        <td class="pasBordure" colspan="5"><h2><?php echo LISTE_MOIS[$moisAffiche] . " " . $anneeAffiche; ?></h2></td>
                        <td class="pasBordure"><input type="submit" name="moisApres" value=">"></td>
                    </form>
                </tr>
                    <tr>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                        <th>Dimanche</th>
                    </tr>
                    <tr>
                        <?php
                            generateCalendar($moisAffiche,$anneeAffiche, JOUR_ANGLAIS);
                        ?>
                    </tr>
                </table>
            <!-- </div> -->
            <!-- <div class="aa" id="inscription">
                <table>
                    <tr>
                        <td>2</td>
                        <td id="dateStageChoisi">mercredi 27 mars 2019 </td>
                        <td> <a href="#modal1"><button data-type="ajouter" data-date="mercredi 27 mars 2019" data-idstage="16" data-target="#modal1" data-toggle="modal" type="button" class="btn btn-info">Choisir</button></a> </td>
                    </tr>
                </table>
            </div> -->
        </div>
