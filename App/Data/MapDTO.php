<?php

namespace App\Data;

class MapDTO {

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    
    
    private $cell;

    /**
     *
     * @var string
     */
    
    
    
    private $sap;
    /**
     *
     * @var string
     */
    private $name;
    /**
     * 
     * @var string
     */
    private $updateDate;   
    /**
     * 
     * @var string
     */
    private $path;
    public function getPath(): string {
        return $this->path;
    }

    public function setPath(string $path): MapDTO {
        $this->path = $path;
        return $this;
    }

        public function getId(): int {
        return $this->id;
    }

    public function getCell(): string {
        return $this->cell;
    }

    public function getSap(): string {
        return $this->sap;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getUpdateDate(): string {
        return $this->updateDate;
    }

    public function setId(int $id): MapDTO {
        $this->id = $id;
        return $this;
    }

    public function setCell(string $cell): MapDTO {
        $this->cell = $cell;
        return $this;
    }

    public function setSap(string $sap): MapDTO {
        $this->sap = $sap;
        return $this;
    }

    public function setName(string $name): MapDTO {
        $this->name = $name;
        return $this;
    }

    public function setUpdateDate(string $updateDate): MapDTO {
        $this->updateDate = $updateDate;
        return $this;
    }

   
    
    
    
}