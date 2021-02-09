<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of StuffSearch
 *
 * @author GM
 */
class StuffSearch {
    
    const OWNER = [
        '0' => 'Les 2',
        '1' => 'Marjo',
        '2' => 'Guillaume'
    ];
    
    /**
     * 
     * @var integer|null
     */
    private $proprio;
    
    /**
     * 
     * @var string|null
     */
    private $txt;
    
    /**
     * 
     * @var ArrayCollection
     */
    private $options;
    
    public function __construct() {
        $this->options = new ArrayCollection();
    }
    
    public function getProprio(): ?int
    {
        return $this->proprio;
    }

    public function setProprio(int $proprio): self
    {
        $this->proprio = $proprio;

        return $this;
    }
    
    public function getTxt(): ?string
    {
        return $this->txt;
    }

    public function setTxt(string $txt): self
    {
        $this->txt = $txt;

        return $this;
    }
    
    function getOptions(): ArrayCollection {
        return $this->options;
    }

    function setOptions(ArrayCollection $options): void {
        $this->options = $options;
    }


}
