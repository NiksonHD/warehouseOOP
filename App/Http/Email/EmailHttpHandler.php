<?php

namespace App\Http\Email;

use App\Data\FiscalDTO;
use App\Http\HttpHandlerAbstract;
use App\Service\Articles\ArticleServiceInterface;
use App\Service\Email\EmailServiceInterface;
use App\Service\Fiscal\FiscalServiceInterface;
use App\Service\Person\PersonServiceInterface;

class EmailHttpHandler extends HttpHandlerAbstract {
    
    
    
    

    public function edit(EmailServiceInterface $emailService, $formData) {
            $_SESSION['personId'] = null;
        if (isset($formData['address'])) {
            $this->handleEditProcess($emailService, $formData);
        } else {
//            $bons = $this->dataBinder->bind($formData, FiscalDTO::class);
            $this->render("emails/edit_email", null, ['error' => null]);
        }
    }

    public function handleEditProcess(EmailServiceInterface $emailService , $formData) {
            
        try {
            $email = $this->dataBinder->bind($formData, \App\Data\EmailDTO::class);
            $result = $emailService->addEmail($email);

            $this->redirect('../warehouse_app/find_location.php');
        } catch (\Exception $ex) {
            $this->render('fiscals/edit_bon', ['persons' => $persons, 'bons' => null], ['error' => $ex->getMessage()]);
        }
    }

    public function activate(EmailServiceInterface $emailService, $formData) {
        $emails = $emailService->getAll();
        
        
            $_SESSION['personId'] = null;
        if (isset($formData['activate'])) {
            $this->handleActivateProcess($emailService, $formData);
        } else {
//            $bons = $this->dataBinder->bind($formData, FiscalDTO::class);
            $this->render("emails/activate_email", ['emails' =>$emails], ['error' => null]);
        }
    }
     public function handleActivateProcess(EmailServiceInterface $emailService , $formData) {
            
            
        try {
            $emailRaw = $this->dataBinder->bind($formData, \App\Data\EmailDTO::class);
            $email = $emailService->getOneById($emailRaw->getId());
            $emailService->updateActiveStatusEmail($email);

            $this->redirect('activate_email.php');
        } catch (\Exception $ex) {
            $this->render('fiscals/edit_bon', ['persons' => $persons, 'bons' => null], ['error' => $ex->getMessage()]);
        }
    }
    public function export(ArticleServiceInterface $articleService, $formData) {
        if (isset($formData['export'])) {
            $date = $formData['date'];
            $articleService->getAll($date);
        } else {
            $this->render('articles/export', null, ['error' => null]);
        }
    }

    public function showBons(FiscalServiceInterface $fiscalService, PersonServiceInterface $personService, $formData) {
        $persons = $personService->getAll();

        if (isset($formData['show'])) {
            $date = $formData['date'];
            if($date == ''){
                $date = date("Y-m-d");
            } 
            $id = $formData['person'];
            $_SESSION['personId'] = $id;
            $bons = $fiscalService->getAllbyPerson($id, $date);

            $this->render('fiscals/show_bon', ['persons' => $persons, 'bons' => $bons], ['error' => null]);
        } else {
            $this->render('fiscals/show_bon', ['persons' => $persons], ['error' => null]);
        }
    }
    public function showMenuPage() {
        $this->render('fiscals/menu_page');
    }

}
