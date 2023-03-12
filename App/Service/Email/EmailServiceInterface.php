<?php

namespace App\Service\Email;

use App\Data\CpanelDTO;
use App\Data\EmailDTO;

interface EmailServiceInterface {
    
public function addEmail(EmailDTO $DTO);

public function getAll();

public function getOneById($id);

public function updateActiveStatusEmail(EmailDTO $DTO);
}
