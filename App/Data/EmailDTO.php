<?php

namespace App\Data;

class EmailDTO {

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
     * @var string
     */
    private $address;
    /**
     * 
     * @var string
     */
    private $role;
    /**
     * 
     * @var bool
     */
    private $active;
    public function getId(): ?string {
        return $this->id;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function getActive(): bool {
        return $this->active;
    }

    public function setId(string $id): EmailDTO{
        $this->id = $id;
        return $this;
    }

    public function setAddress(string $address): EmailDTO{
        $this->address = $address;
        return $this;
    }

    public function setRole(string $role): EmailDTO{
        $this->role = $role;
        return $this;
    }

    public function setActive(bool $active){
        $this->active = $active;
        return $this;
    }



}
