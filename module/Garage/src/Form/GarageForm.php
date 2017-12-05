<?php

namespace Garage\Form;

use Zend\Form\Form;

class GarageForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('garage');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'marque',
            'type' => 'text',
            'options' => [
                'label' => 'Marque',
            ],
        ]);
        $this->add([
            'name' => 'modele',
            'type' => 'text',
            'options' => [
                'label' => 'Modèle',
            ],
        ]);
        $this->add([
            'name' => 'boite_de_vitesse',
            'type' => 'text',
            'options' => [
                'label' => 'Boite de vitesse',
            ],
        ]);
        $this->add([
            'name' => 'carburant',
            'type' => 'text',
            'options' => [
                'label' => 'Carburant',
            ],
        ]);
        $this->add([
            'name' => 'couleur',
            'type' => 'text',
            'options' => [
                'label' => 'Couleur',
            ],
        ]);
        $this->add([
            'name' => 'kilometre',
            'type' => 'number',
            'options' => [
                'label' => 'Kilomètres',
            ],
        ]);
        $this->add([
            'name' => 'anciennete',
            'type' => 'text',
            'options' => [
                'label' => 'Ancienneté',
            ],
        ]);
        $this->add([
            'name' => 'prix',
            'type' => 'number',
            'options' => [
                'label' => 'Prix',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}