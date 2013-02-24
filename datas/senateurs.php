<?php
/*
 * genere senateurs.json
 * 
 * 
 * Format :
 * [{
 *  nom: '',
 *  prenom : '',
 *  twitter : '',
 *  facebook : '',
 *  departement_num : ,
 *  fonction : { DEPUTE|SENATEUR|MINISTRE|... }
 *  autres_mandats : {MAIRE|CONSEILLER|...}
 * }]
 * 
 * 
 */
define('SENATEURS_JSON', 'senateurs_enmandat.json');
define('OUTPUT_JSON', 'senateurs.json');

function listing_senateurs_cumulard() {
    
    $deputes_array = json_decode(file_get_contents(SENATEURS_JSON), TRUE);
    $quicumules_array = array();
    
    
    foreach ($deputes_array['senateurs'] as $key => $value) {
        $senateur_objet = $value['senateur'];
        
            
        if (intval($senateur_objet['nb_mandats']) > 1) { //uniquement les députés ayant plus d'un mandat
            $autres_fonctions = array();
            foreach($senateur_objet['autres_mandats'] as $key => $value){
                $values = explode('/', $value['mandat']);
                $mandat = $values[1] . ', ' . trim($values[0]);  
                $autres_fonctions[] = array('mandat' => $mandat);
            }
            $senateur = [
                'nom' => $senateur_objet['nom_de_famille'],
                'prenom' => $senateur_objet['prenom'],
                'fonction' => 'Sénateur',
                'twitter' => '',
                'site_web' => $senateur_objet['sites_web'],
                'departement_num' => $senateur_objet['num_deptmt'],
                'autres_fonctions' => $autres_fonctions
            ];

            $quicumules_array[] = $senateur;
        }
    }
    return $quicumules_array;
}

$listing_deputes = array();
$listing_deputes['_licence']    = 'This database is made available under the Open Database License: http://opendatacommons.org/licenses/odbl/1.0/. Any rights in individual contents of the database are licensed under the Database Contents License: http://opendatacommons.org/licenses/dbcl/1.0/';
$listing_deputes['_authors']    = 'Maxime ALAY-EDDINE & Jean-Alain Ré';
$listing_deputes['_sources']    = 'http://www.nosdeputes.fr/deputes/enmandat/json and public lists from @samuellaurent';
$listing_deputes['_update']     = '2013-02-23';
$listing_deputes['values']     = listing_senateurs_cumulard();
file_put_contents(OUTPUT_JSON, json_encode($listing_deputes));

?>