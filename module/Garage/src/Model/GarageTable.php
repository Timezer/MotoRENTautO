<?php

namespace Garage\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class GarageTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

        public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getGarage($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Impossible de trouver la ligne avec l\'identifiant %d',
                $id
            ));
        }

        return $row;
    }

    public function saveGarage(Garage $garage)
    {
        $data = [
            'marque' => $garage->marque,
            'modele' => $garage->modele,
            'boite_de_vitesse' => $garage->boite_de_vitesse,
            'carburant' => $garage->carburant,
            'couleur' => $garage->couleur,
            'kilometre' => $garage->kilometre,
            'anciennete' => $garage->anciennete,
            'prix' => $garage->prix,
        ];

        $id = (int) $garage->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getGarage($id)) {
            throw new RuntimeException(sprintf(
                'Impossible de mettre à jour le garage avec l\'identificateur %d qui n\'existe pas',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteGarage($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}