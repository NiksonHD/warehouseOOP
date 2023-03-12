<?php

namespace App\Repository\Cpanel;

use App\Data\CpanelDTO;
use App\Data\DatabaseAbstract;


class CpanelRepository extends DatabaseAbstract implements CpanelRepositoryInterface {
    
    
    
    public function findAll() {
        return $this->db->query("SELECT id,active_pics as activePics FROM cpanel WHERE 1 ")
                ->execute()
                ->fetch(CpanelDTO::class);

        
    }

    public function update(\App\Data\CpanelDTO $DTO) {
         $active = 1;
        if($DTO->getActivePics() === false){
            $active = 0;
        }
        return $this->db->query("UPDATE cpanel SET active_pics=? WHERE id=?
                        ")->execute([$active, $DTO->getId()]);
    }

    public function findOneById($id) {
        
        return $this->db->query("SELECT id, active_pics as activePics FROM cpanel WHERE id=? 
            ")->execute([$id])
                ->fetchOne(CpanelDTO::class);
        
        
    }

    public function findAllIp() {
        return $this->db->query('SELECT id, ip, pic, edit
                                 FROM access
                               ')->execute()
                                ->fetch(\App\Data\IpDTO::class);
    }

    public function findIpById($id) {
        return $this->db->query('SELECT id, ip, pic, edit
                                 FROM access
                                 WHERE id = ?
                               ')->execute([$id])
                                ->fetchOne(\App\Data\IpDTO::class);
    }

    public function updateIpSettings($id, $pic, $edit) {
        return $this->db->query("UPDATE access 
                                 SET pic=?, edit=? 
                                 WHERE id=?
                        ")->execute([$pic, $edit, $id]);
    }

}
