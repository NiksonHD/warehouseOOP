<?php

namespace App\Http\Fiscal;

use App\Data\FiscalDTO;
use App\Http\HttpHandlerAbstract;
use App\Service\Articles\ArticleServiceInterface;
use App\Service\Fiscal\FiscalServiceInterface;
use App\Service\Person\PersonServiceInterface;
use App\Service\UserServiceInterface;

class BonHttpHandler extends HttpHandlerAbstract {

    private const ROLE = 'admin';

    public function edit(FiscalServiceInterface $fiscalService, PersonServiceInterface $personService, array $formData = []) {
        $_SESSION['personId'] = null;
        if (isset($formData['bon_number'])) {
            $this->handleEditProcess($fiscalService, $personService, $formData);
        } else {
            $persons = $personService->getAll();
            $bons = $this->dataBinder->bind($formData, FiscalDTO::class);
            $this->render("fiscals/edit_bon", ['persons' => $persons, 'bons' => $bons], ['error' => null]);
        }
    }

    public function handleEditProcess(FiscalServiceInterface $fiscalService, PersonServiceInterface $personService, $formData) {
        $persons = $personService->getAll();

        try {
            $persons = $personService->getAll();
            $bons = $this->dataBinder->bind($formData, FiscalDTO::class);
            $personId = $formData['person_id'];
            $_SESSION['personId'] = $personId;
            $result = $fiscalService->edit($bons);

            $this->render('fiscals/edit_bon', ['persons' => $persons, 'bons' => $bons], ['error' => null]);
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
            if ($date == '') {
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

    public function showMenuPage(UserServiceInterface $userService) {
        
        $user = ($userService->currentUser()) ? $userService->currentUser()->getRole(): '' ;
        
        if ( $user === self::ROLE) {
                    $this->render('fiscals/menu_page');

        }else{
            $this->redirect('insert_bon.php');
        }
    }

}
