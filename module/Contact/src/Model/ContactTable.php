<?php

namespace Contact\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class ContactTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function saveContact(Contact $contact)
    {
        $data = [
            'mail' => $contact->mail,
            'sujet' => $contact->sujet,
            'message' => $contact->message,
        ];

        $this->tableGateway->insert($data);
    }

}
