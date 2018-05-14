<?php
namespace ItemExtend\Entity;

use Omeka\Entity\Item;
use Omeka\Entity\AbstractEntity;

/**
 * @Entity
 */
class ItemExtend extends AbstractEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;


    /**
     * @OneToOne(targetEntity="Omeka\Entity\Item")
     * @JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $item;


    /**
     * @Column(type="string", length=200)
     */
    protected $text;

    
    // function definitions follow

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

}