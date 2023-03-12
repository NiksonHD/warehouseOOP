<?php


namespace App\Repository\Email;

use App\Data\DatabaseAbstract;
use App\Data\EmailDTO;
use Database\DatabaseInterface;


class EmailRepository extends DatabaseAbstract implements EmailRepositoryInterface {
    
    /**
     * 
     * @var DatabaseInterface
     */
    protected $db;
    public function __construct(DatabaseInterface $db) {
        $this->db = $db;
    }

        public function insertEmail(EmailDTO $DTO) {
        
            $this->db->query(" INSERT INTO email (address, role, active)
               VALUES ( ?,?,? )
            ")->execute([
                $DTO->getAddress(),
                $DTO->getRole(),
                true]);
        
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM email WHERE role='user'
                            ")->execute()->fetch(EmailDTO::class);
    }

    public function findOneById($id) {
        return $this->db->query(" SELECT * FROM email WHERE id=?
                            ")->execute([$id])->fetchOne(EmailDTO::class);
        
    }

    public function changeActiveStatusEmail(EmailDTO $DTO) {
        $active = 1;
        if($DTO->getActive() === false){
            $active = 0;
        }
        return $this->db->query("UPDATE email SET active=? WHERE id=?
                        ")->execute([$active, $DTO->getId()]);
    }

}
