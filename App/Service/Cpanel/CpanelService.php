<?php


namespace App\Service\Cpanel;

use App\Data\CpanelDTO;
use App\Repository\Cpanel\CpanelRepositoryInterface;

class CpanelService implements CpanelServiceInterface {
    
    /**
     * 
     * @var CpanelRepositoryInterface
     */
    
    private  $cpanelRepository;
    public function __construct(CpanelRepositoryInterface $cpanelRepository) {
        $this->cpanelRepository = $cpanelRepository;
    }

    
    public function activatePics(CpanelDTO $DTO) {
         if(!$DTO->getActivePics()){
            $DTO->setActivePics(true);
            return $this->cpanelRepository->update($DTO);
        }else{
            $DTO->setActivePics("0");
            return $this->cpanelRepository->update($DTO);
        }
    }

    public function getPanel() {
        return $this->cpanelRepository->findAll();
    }

    public function getOneById($id) {
        return $this->cpanelRepository->findOneById($id);
    }

    public function getAllIp() {
        return $this->cpanelRepository->findAllIp();
    }

    public function getOneIpById($id) {
        return $this->cpanelRepository->findIpById($id);
    }

    public function changeIpSettings($id, $pic, $edit) {
        return $this->cpanelRepository->updateIpSettings($id, $pic, $edit);
    }

}
