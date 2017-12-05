<?php
namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contact\Form\ContactForm;

use Contact\Model\ContactTable;
use Contact\Model\Contact;

class ListController extends AbstractActionController
{

    //private $table;
    //public function __construct(ContactTable $table)
    //{
    //   $this->table = $table;
    //} 


    public function indexAction()
    {
       // Create Contact Us form
    $form = new ContactForm();
        
    // Check if user has submitted the form
    if($this->getRequest()->isPost()) 
    {
      // Fill in the form with POST data
      $data = $this->params()->fromPost();            
      $form->setData($data);
            
      // Validate form
      if($form->isValid()) {
                
        // Get filtered and validated data
        $data = $form->getData();
                
        // ... Do something with the validated data ...
        //$this->table->saveContact($data);
    
        // Redirect to "Thank You" page
        return $this->redirect()->toRoute('contact/thank');
      } 
       return $this->redirect()->toRoute('contact/error');          
    } 
        
    // Pass form variable to view
    return new ViewModel([
          'form' => $form
       ]);
    }

    public function thankAction()
    {
       $form = new ContactForm();
      return new ViewModel([
          'form' => $form
       ]);
    }

    public function errorAction()
    {
       $form = new ContactForm();
      return new ViewModel([
          'form' => $form
       ]);
    }
}
