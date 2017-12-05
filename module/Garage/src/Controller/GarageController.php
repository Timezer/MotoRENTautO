<?php

namespace Garage\Controller;

use Garage\Model\GarageTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Garage\Form\GarageForm;
use Garage\Model\Garage;

class GarageController extends AbstractActionController
{
    private $table;

    public function __construct(GarageTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'garages' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new GarageForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $garage = new Garage();
        $form->setInputFilter($garage->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $garage->exchangeArray($form->getData());
        $this->table->saveGarage($garage);
        return $this->redirect()->toRoute('garage');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('garage', ['action' => 'add']);
        }

        // Retrieve the garage with the specified id. Doing so raises
        // an exception if the garage is not found, which should result
        // in redirecting to the landing page.
        try {
            $garage = $this->table->getGarage($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('garage', ['action' => 'index']);
        }

        $form = new GarageForm();
        $form->bind($garage);
        $form->get('submit')->setAttribute('value', 'Editer');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($garage->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveGarage($garage);

        // Redirect to garage list
        return $this->redirect()->toRoute('garage', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('garage');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->table->deleteGarage($id);
            }

            // Redirect to list of garages
            return $this->redirect()->toRoute('garage');
        }

        return [
            'id'    => $id,
            'garage' => $this->table->getGarage($id),
        ];
    }

    public function researchAction()
    {
        return new ViewModel([
            'garages' => $this->table->fetchAll(),
        ]);
    }
}