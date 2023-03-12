<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with  * 
 */

namespace App\Data;

/**
 * Description of CellsDTO
 *
 * @author nikson
 */
class IpDTO {
    
    /**
     * @var int
     */
    private $id;
    /**
     * 
     * @var string
     */
    private $ip;
    
    private $createDate;
    /**
     * 
     * @var bool
     */
    private $pic;
    
    /**
     * 
     * @var bool
     */
    private $edit;
    public function getPic(): bool {
        return $this->pic;
    }

    public function getEdit(): bool {
        return $this->edit;
    }

    public function setPic(bool $pic): IpDTO {
        $this->pic = $pic;
        return $this;
    }

    public function setEdit(bool $edit): IpDTO {
        $this->edit = $edit;
        return $this;
    }

        public function getId(): int {
        return $this->id;
    }

    public function getIp(): string {
        return $this->ip;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIp(string $ip): void {
        $this->ip = $ip;
    }

    public function setCreateDate($createDate): void {
        $this->createDate = $createDate;
    }


    
    
    
}