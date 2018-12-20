<?php

class CompteForm extends Zend_Form
{

    public function __construct($options = null)
    {
        parent::__construct($options);

        $this->setName('Compte');



        $this->setAction('')
                ->setMethod('post');

        $id = new Zend_Form_Element_Hidden('id_compte');

//civilite		
        $civilite = $this->CreateElement('select', 'civilite');

        $civilite->addMultiOptions(array('Monsieur' => 'Monsieur', 'Madame' => 'Madame', 'Mademoiselle' => 'Mademoiselle'));

        //nom  
        $nom = $this->CreateElement('text', 'nom');

        $nom->setRequired(true);



// prenom
        $prenom = $this->CreateElement('text', 'prenom');




//date de naissance
        $jours[0] = '';
        for ($i = 1; $i <= 31; $i++) {
            $jours[$i] = $i;
        }
        $j = $this->CreateElement('text', 'j');



        $j->setAttrib('size', 2);
        //->addMultiOptions($jours)



        $mois[0] = '';
        for ($i = 1; $i <= 12; $i++) {
            $mois[$i] = $i;
        }
        $m = $this->CreateElement('text', 'm');



        $m->setAttrib('size', 2);
        //->addMultiOptions($mois)


        $an[0] = '';
        for ($i = date('Y'); $i >= 1900; $i--) {
            $an[$i] = $i;
        }
        $a = $this->CreateElement('text', 'a');



        $a->setAttrib('size', 2);
        //->addMultiOptions($an)
//societe  
        $societe = $this->CreateElement('text', 'societe');




//fonction
        $fonction = $this->CreateElement('text', 'fonction');


        $tel_domicile = $this->CreateElement('text', 'tel_domicile');



        $tel_portable = $this->CreateElement('text', 'tel_portable');

        $email_pro = $this->CreateElement('text', 'email_pro');

        $email_pro->addValidator('StringLength', false, array(5, 50))
                ->addValidator('EmailAddress');



        $email_perso = $this->CreateElement('text', 'email_perso');

        $email_perso->addValidator('StringLength', false, array(5, 50))
                ->addValidator('EmailAddress');





        $adresse = $this->CreateElement('text', 'adresse');


        $adresse->setAttrib('size', 35);


        $cp = $this->CreateElement('text', 'cp');




        $ville = $this->CreateElement('text', 'ville');


        $pays = $this->CreateElement('text', 'pays');




        $is_newsletter = $this->CreateElement('checkbox', 'is_newsletter');


        $is_newsletter->setValue(1);






        $submit = $this->CreateElement('submit', 'submit');




        $login = $this->CreateElement('text', 'login');




        $mdp = $this->createElement('password', 'password');

        $mdp->setAttrib('size', 25)
                ->addValidator('StringLength', false, array(3, 50));


        $this->addElements(array(
            $id,
            $civilite,
            $nom,
            $prenom,
            $j,
            $m,
            $a,
            $societe,
            $fonction,
            $tel_domicile,
            $tel_portable,
            $email_pro,
            $email_perso,
            $adresse,
            $cp,
            $ville,
            $pays,
            $is_newsletter,
            $login,
            $mdp,
            $submit
        ));
        foreach ($this->getElements() as $element) {
//$element->removeDecorator('DtDdWrapper');
            $element->removeDecorator('HtmlTag');
            $element->removeDecorator('Label');
        }
    }

}

?>