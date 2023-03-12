<?php

namespace App\Http\Cpanel;

use App\Data\CpanelDTO;
use App\Data\EmailDTO;
use App\Http\HttpHandlerAbstract;
use App\Service\Cpanel\CpanelServiceInterface;
use App\Service\Email\EmailServiceInterface;
use App\Service\UserServiceInterface;
use Exception;

class CpanelHttpHandler extends HttpHandlerAbstract {

    public function enableDisablePics(CpanelServiceInterface $CpanelService, $formData) {
        $cPanelProperties = $CpanelService->getPanel();
        if (isset($formData['change'])) {
            $this->handleEnableDisableProcess($CpanelService, $formData);
        } else {
            $this->render("cpanel/cpanel", ['properties' => $cPanelProperties], ['error' => null]);
        }
    }

    public function handleEditProcess(EmailServiceInterface $emailService, $formData) {

        try {
            $email = $this->dataBinder->bind($formData, EmailDTO::class);
            $result = $emailService->addEmail($email);

            $this->redirect('../warehouse_app/find_location.php');
        } catch (Exception $ex) {
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
            $this->render("emails/activate_email", ['emails' => $emails], ['error' => null]);
        }
    }

    public function handleActivateProcess(EmailServiceInterface $emailService, $formData) {


        try {
            $emailRaw = $this->dataBinder->bind($formData, EmailDTO::class);
            $email = $emailService->getOneById($emailRaw->getId());
            $emailService->updateActiveStatusEmail($email);

            $this->redirect('activate_email.php');
        } catch (Exception $ex) {
            $this->render('fiscals/edit_bon', ['persons' => $persons, 'bons' => null], ['error' => $ex->getMessage()]);
        }
    }

    public function handleEnableDisableProcess(CpanelServiceInterface $CpanelService, $formData) {
        try {
            $cPanelInputed = $this->dataBinder->bind($formData, CpanelDTO::class);
            $cPanel = $CpanelService->getOneById($cPanelInputed->getId());
            $result = $CpanelService->ActivatePics($cPanel);
            $cPanelProperties = $CpanelService->getPanel();

            $this->render("cpanel/cpanel", ['properties' => $cPanelProperties], ['error' => null]);

//            $this->redirect('../warehouse_app/find_location.php');
        } catch (Exception $ex) {
            $this->render('fiscals/edit_bon', ['persons' => $persons, 'bons' => null], ['error' => $ex->getMessage()]);
        }
    }

    public function editAccessIp(CpanelServiceInterface $CpanelService) {
        $ips = $CpanelService->getAllIp();

        $this->render('cpanel/ip', ['ips'=>  $ips], null);
    }

    public function editIpSettings(CpanelServiceInterface $cPanelService, UserServiceInterface $userService, $getData, $formData) {
        if ($userService->isLogged()) {
            $currentUser = $userService->currentUser();
            if ($currentUser->getRole() !== "admin") {
                $this->redirect('index.php');
            }
        } else {
            $this->redirect('index.php');
        }
        if (isset($getData['ip'])) {
            $ip = $cPanelService->getOneIpById($getData['ip']);
            $this->render('cpanel/edit_ip', [$ip], null);
        }
        if (isset($formData['settings'])) {
            isset($formData['pic']) ? $pic = 1 : $pic = 0;
            isset($formData['edit']) ? $edit = 1 : $edit = 0;
            $cPanelService->changeIpSettings($getData['ip'], $pic, $edit);
            $this->redirect('control-panel.php');
        }
    }

}
