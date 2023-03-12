<?php

namespace App\Data;

class ListDTO {

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var TileDTO[]
     */
    private $tiles;

    /**
     *
     * @var string
     */
    private $listString;

    /**
     * string
     */
    private $updateDate;

    /**
     * @var array
     */
    private $errors;
    /**
     * 
     * @var string
     */
    private $comment;
    /**
     * 
     * @var bool
     */
    private $mail;
    public function getMail(): bool {
        return $this->mail;
    }

    public function setMail(bool $mail): ListDTO {
        $this->mail = $mail;
        return $this;
    }

    
    public function getComment(): string {
        return $this->comment;
    }

    public function setComment(? string $comment): ListDTO {
        $this->comment = $comment;
        return $this;
    }

        public function getErrors(): array {
        return $this->errors;
    }

    public function setErrors($errors): ListDTO {
        $this->errors = $errors;
        return $this;
    }

    public function getId():? int {
        return $this->id;
    }

    public function getTiles(): array {
        return $this->tiles;
    }

    public function getListString(): string {
        return $this->listString;
    }

    public function getUpdateDate() {
        return $this->updateDate;
    }

    public function setId(int $id): ListDTO {
        $this->id = $id;
        return $this;
    }

    public function setTiles(array $tiles): ListDTO {
        $this->tiles = $tiles;
        return $this;
    }

    public function setListString(string $listString): ListDTO {
        $this->listString = $listString;
        return $this;
    }

    public function setUpdateDate($updateDate): ListDTO {
        $this->updateDate = $updateDate;
        return $this;
    }

}
