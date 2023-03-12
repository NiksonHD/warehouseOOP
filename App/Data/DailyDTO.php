<?php

namespace App\Data;

class DailyDTO {

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var int
     */
    
    
    private $articleId;

    /**
     * string
     */
    private $createDate;
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


    public function getId(): int {
        return $this->id;
    }

    public function getArticleId(): int {
        return $this->articleId;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function setId(int $id): DailyDTO {
        $this->id = $id;
        return $this;
    }

    public function setArticleId(int $articleId): DailyDTO {
        $this->articleId = $articleId;
                return $this;

    }

    public function setCreateDate($createDate): DailyDTO {
        $this->createDate = $createDate;
                return $this;

    }

    public function getSap(): string {
        return $this->sap;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setSap(string $sap): DailyDTO {
        $this->sap = $sap;
        return $this;
    }

    public function setName(string $name): DailyDTO {
        $this->name = $name;
        return $this;
    }




}
