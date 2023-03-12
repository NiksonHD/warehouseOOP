<?php


namespace App\Service\Email;

use App\Data\EmailDTO;
use App\Repository\Email\EmailRepositoryInterface;




class EmailService  implements EmailServiceInterface{

    /**
     * 
     * @var EmailRepositoryInterface
     */
    private $emailRepository;
    public function __construct(EmailRepositoryInterface $emailRepository) {
        $this->emailRepository = $emailRepository;
    }

    
    public function addEmail(EmailDTO $DTO) {
        if(!isset($_SESSION["id"])){
            $DTO->setRole('user');
        return $this->emailRepository->insertEmail($DTO);
        }
    }

    public function getAll() {
        return $this->emailRepository->findAll();
    }

    public function getOneById($id) {
        return $this->emailRepository->findOneById($id);
    }

    public function updateActiveStatusEmail(EmailDTO $DTO) {
        if(!$DTO->getActive()){
            $DTO->setActive(true);
            return $this->emailRepository->changeActiveStatusEmail($DTO);
        }else{
            $DTO->setActive("0");
//            var_dump($DTO);exit;
            return $this->emailRepository->changeActiveStatusEmail($DTO);
        }
        
    }

}
