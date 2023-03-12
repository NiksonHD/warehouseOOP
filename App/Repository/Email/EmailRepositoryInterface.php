<?php

namespace App\Repository\Email;

use App\Data\EmailDTO;

interface EmailRepositoryInterface {
    
public function insertEmail(EmailDTO $DTO);
    
public function findAll();
    
public function findOneById($id);

public function changeActiveStatusEmail(EmailDTO $DTO);
}
