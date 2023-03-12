<?php

namespace App\Service\Cpanel;

use App\Data\CpanelDTO;

interface CpanelServiceInterface {
    
    public function getPanel();
    
    public function activatePics(CpanelDTO $DTO);
    
    public function getOneById($id);
    
    public function getAllIp();
    
    public function getOneIpById($id);
    
    public function changeIpSettings($id, $pic, $edit);
    
    
}
