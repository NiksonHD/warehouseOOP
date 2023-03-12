<?php

namespace App\Data;

class TileDTO {

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var CellsDTO[]
     */
    
    
    private $cells;

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
     * string
     */
    private $ean;
    
    
    /**
     * string
     */
    private $quantity;
    
    /**
     * string
     */
    private $updateDate;
    
    /**
     * string
     */
    private $cellFromInput;
    /**
     * 
     * @var string
     */
    private $loads;
    /**
     * 
     * @var string
     */
    private $picPath;
    /**
     * 
     * @var bool
     */
    private $showPic;
    public function getShowPic(): bool {
        return $this->showPic;
    }

    public function setShowPic(bool $showPic): TileDTO {
        $this->showPic = $showPic;
        return $this;
    }

        public function getPicPath(): string {
        return $this->picPath;
    }

    public function setPicPath(string $picPath): TileDTO{
        $this->picPath = $picPath;
        return $this;
    }

        public function getLoads(): ? string {
        return $this->loads;
    }

    public function setLoads(string $loads):? TileDTO {
        $this->loads = $loads;
        return $this;
    }

        public function getCellFromInput() {
        return $this->cellFromInput;
    }

    public function setCellFromInput($cellFromInput) {
        $this->cellFromInput = $cellFromInput;
        
    }

    

    public function getId() {
        return $this->id;
    }

    public function getCells(): array {
        return $this->cells;
    }
     public function getUpdateDate(): string {
        return $this->updateDate;
    }
     public function getQuantity(): string {
        return $this->quantity;
    }

    public function setCells(array $cells) {
        $this->cells = $cells;
    }

    public function getSap(): string {
        return $this->sap;
    }
    public function getEan(): string {
        return $this->ean;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setSap(string $sap): TileDTO{
        $this->sap = $sap;
        return $this;
    }
    public function setId(string $id): TileDTO {
        $this->sap = $sap;
        return $this;
    }
    public function setName(string $name): TileDTO {
        $this->name = $name;
        return $this;
    }

    
    public function setEan($ean): TileDTO {
        $this->ean = $ean;
        return $this;
    }

    public function setQuantity($quantity): TileDTO {
        $this->quantity = $quantity;
        return $this;
    }

    public function setUpdateDate($updateDate): TileDTO {
        $this->updateDate = $updateDate;
        return $this;
    }



}
