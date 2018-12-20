<?php

class TitrePresentationTb extends Zend_Db_Table
{

    protected $_name = 'egw_bp_titre_presentation';
    protected $titre_default = array(
        'titre_1' => 'SITUATION PERSONNELLE DU CREATEUR',
        'titre_1_1' => 'Fiche signalétique',
        'titre_1_2' => 'Environnement financier',
        'titre_2' => 'SITUATION PROFESSIONNELLE',
        'titre_2_1' => 'Expérience professionnelle et formation',
        'titre_2_2' => 'Historique du projet, motivations et objectifs poursuivis',
        'titre_2_3' => 'Atouts et faiblesses',
        'titre_2_4' => 'L\'entourage du porteur de projet',
        'titre_2_4_1' => 'Le soutiens',
        'titre_2_4_2' => 'Connaissance du secteur d\'activité ou du métier',
        'titre_2_4_3' => 'Accompagnement',
    );

    function get_value($id_bp)
    {

        $data = $this->fetchRow(
                $this->select()
                        ->where('id_bp = ?', $id_bp)
        );
        $newData =  new stdClass();
        foreach ($data as $key => $value) {
            $newData->$key = utf8_encode($value);
        }
       
       // print_r($newData); die();
        return $newData;
    }

    function initialiser_titre($id_bp)
    {
        $this->titre_default['id_bp'] = $id_bp;
        $this->insert($this->titre_default);
    }

}

?>