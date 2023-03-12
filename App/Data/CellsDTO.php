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
class CellsDTO {
    
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $cell;
    /**
     *
     * @var string
     */
    private $updateDate;

    
    public function getId(): string {
        return $this->id;
    }

    public function getCell(): string {
        return $this->cell;
    }

    public function getUpdateDate(): string {
        return $this->updateDate;
    }

    public function setId(string $id): CellsDTO {
        $this->id = $id;
        return $this;
    }

    public function setCell(string $cell): CellsDTO {
        $this->cell = $cell;
                return $this;

    }

    public function setUpdateDate(string $updateDate): CellsDTO {
        $this->updateDate = $updateDate;
                return $this;

    }


    
}
