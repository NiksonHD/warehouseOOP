<?php



namespace App\Repository\Cpanel;

use App\Data\CpanelDTO;

interface CpanelRepositoryInterface {

    public function findAll();

    public function update(CpanelDTO $DTO);
    
    public function findOneById($id);
    
    public function findAllIp();
    
    public function findIpById($id);
    
    public function updateIpSettings($id, $pic, $edit);
    
}
