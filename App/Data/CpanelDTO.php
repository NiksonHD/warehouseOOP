<?php

namespace App\Data;

class CpanelDTO {

    private const BON_MIN_LENGTH = 1;
    private const BON_MAX_LENGTH = 13;
    private const EAN_MAX_LENGTH = 13;
    private const EAN_MIN_LENGTH = 6;

    
    /**
     * 
     * @var string
     */
    private $id;

    
    /**
     * 
     * @var bool
     */
    private $activePics;
    public function getId(): string {
        return $this->id;
    }

   
    public function setId(string $id): ?CpanelDTO{
        $this->id = $id;
        return $this;
    }

    public function getActivePics(): ?bool {
        return $this->activePics;
    }

    public function setActivePics(bool $activePics): ?CpanelDTO {
        $this->activePics = $activePics;
        return $this;
    }


    
    


}
