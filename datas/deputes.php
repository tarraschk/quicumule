<?php
/*
 * genere deputes.json
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
define('DEPUTE_JSON', 'deputes_enmandat.json');
define('OUTPUT_JSON', 'deputes.json');

function listing_deputes_cumulard() {
    
    $deputes_array = json_decode(file_get_contents(DEPUTE_JSON), TRUE);
    $quicumules_array = array();
    
    
    foreach ($deputes_array['deputes'] as $key => $value) {
        $depute_objet = $value['depute'];

        if (intval($depute_objet['nb_mandats']) > 1) { //uniquement les députés ayant plus d'un mandat
            $depute = [
                'nom' => $depute_objet['nom_de_famille'],
                'prenom' => $depute_objet['prenom'],
                'fonction' => 'Député',
                'twitter' => '',
                'site_web' => $depute_objet['sites_web'],
                'departement_num' => $depute_objet['num_deptmt'],
                'autres_fonctions' => $depute_objet['autres_mandats']
            ];

            $quicumules_array[] = $depute;
        }
    }
    return $quicumules_array;
}

$listing_deputes = array();
$listing_deputes['_licence']    = 'This database is made available under the Open Database License: http://opendatacommons.org/licenses/odbl/1.0/. Any rights in individual contents of the database are licensed under the Database Contents License: http://opendatacommons.org/licenses/dbcl/1.0/';
$listing_deputes['_authors']    = 'Maxime ALAY-EDDINE & Jean-Alain Ré';
$listing_deputes['_sources']    = 'http://www.nosdeputes.fr/deputes/enmandat/json and public lists from @samuellaurent';
$listing_deputes['_update']     = '2013-02-23';
$listing_deputes['values']     = listing_deputes_cumulard();
file_put_contents(OUTPUT_JSON, json_encode($listing_deputes));

?>