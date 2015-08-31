<?php

namespace SP\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="SP\MemberBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_type", type="string", length=24)
     */
    private $pdtType;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_name", type="string", length=128)
     */
    private $pdtName;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_desc", type="string", length=255)
     */
    private $pdtDesc;

    /**
     * @var integer
     *
     * @ORM\Column(name="pdt_unit_qty", type="integer")
     */
    private $pdtUnitQty;

    /**
     * @var float
     *
     * @ORM\Column(name="pdt_price", type="decimal",scale=2)
     */
    private $pdtPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_currency", type="string", length=3,options={"unsigned":true, "default":"Eur"})
     */
    private $pdtCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_state", type="string", length=24,options={"unsigned":true, "default":"Active"})
     */
    private $pdtState = 'Active';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pdt_dcre", type="datetime")
     */
    private $pdtDcre;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_ucre", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $pdtUcre  = 'Developper';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pdt_dupd", type="datetime")
     */
    private $pdtDupd;

    /**
     * @var string
     *
     * @ORM\Column(name="pdt_uupd", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $pdtUupd  = 'Developper';

    public function __construct(){

        // Par défaut, la date de creation et de modification est la date d'aujourd'hui
        $this->pdtDcre = new \Datetime();
        $this->pdtDupd = new \Datetime();
   }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pdtType
     *
     * @param string $pdtType
     * @return Product
     */
    public function setPdtType($pdtType)
    {
        $this->pdtType = $pdtType;

        return $this;
    }

    /**
     * Get pdtType
     *
     * @return string 
     */
    public function getPdtType()
    {
        return $this->pdtType;
    }

    /**
     * Set pdtName
     *
     * @param string $pdtName
     * @return Product
     */
    public function setPdtName($pdtName)
    {
        $this->pdtName = $pdtName;

        return $this;
    }

    /**
     * Get pdtName
     *
     * @return string 
     */
    public function getPdtName()
    {
        return $this->pdtName;
    }

    /**
     * Set pdtDesc
     *
     * @param string $pdtDesc
     * @return Product
     */
    public function setPdtDesc($pdtDesc)
    {
        $this->pdtDesc = $pdtDesc;

        return $this;
    }

    /**
     * Get pdtDesc
     *
     * @return string 
     */
    public function getPdtDesc()
    {
        return $this->pdtDesc;
    }

    /**
     * Set pdtUnitQty
     *
     * @param integer $pdtUnitQty
     * @return Product
     */
    public function setPdtUnitQty($pdtUnitQty)
    {
        $this->pdtUnitQty = $pdtUnitQty;

        return $this;
    }

    /**
     * Get pdtUnitQty
     *
     * @return integer 
     */
    public function getPdtUnitQty()
    {
        return $this->pdtUnitQty;
    }

    /**
     * Set pdtPrice
     *
     * @param float $pdtPrice
     * @return Product
     */
    public function setPdtPrice($pdtPrice)
    {
        $this->pdtPrice = $pdtPrice;

        return $this;
    }

    /**
     * Get pdtPrice
     *
     * @return float 
     */
    public function getPdtPrice()
    {
        return $this->pdtPrice;
    }

    /**
     * Set pdtCurrency
     *
     * @param string $pdtCurrency
     * @return Product
     */
    public function setPdtCurrency($pdtCurrency)
    {
        $this->pdtCurrency = $pdtCurrency;

        return $this;
    }

    /**
     * Get pdtCurrency
     *
     * @return string 
     */
    public function getPdtCurrency()
    {
        return $this->pdtCurrency;
    }

    /**
     * Set pdtState
     *
     * @param string $pdtState
     * @return Product
     */
    public function setPdtState($pdtState)
    {
        $this->pdtState = $pdtState;

        return $this;
    }

    /**
     * Get pdtState
     *
     * @return string 
     */
    public function getPdtState()
    {
        return $this->pdtState;
    }

    /**
     * Set pdtDcre
     *
     * @param \DateTime $pdtDcre
     * @return Product
     */
    public function setPdtDcre($pdtDcre)
    {
        $this->pdtDcre = $pdtDcre;

        return $this;
    }

    /**
     * Get pdtDcre
     *
     * @return \DateTime 
     */
    public function getPdtDcre()
    {
        return $this->pdtDcre;
    }

    /**
     * Set pdtUcre
     *
     * @param string $pdtUcre
     * @return Product
     */
    public function setPdtUcre($pdtUcre)
    {
        $this->pdtUcre = $pdtUcre;

        return $this;
    }

    /**
     * Get pdtUcre
     *
     * @return string 
     */
    public function getPdtUcre()
    {
        return $this->pdtUcre;
    }

    /**
     * Set pdtDupd
     *
     * @param \DateTime $pdtDupd
     * @return Product
     */
    public function setPdtDupd($pdtDupd)
    {
        $this->pdtDupd = $pdtDupd;

        return $this;
    }

    /**
     * Get pdtDupd
     *
     * @return \DateTime 
     */
    public function getPdtDupd()
    {
        return $this->pdtDupd;
    }

    /**
     * Set pdtUupd
     *
     * @param string $pdtUupd
     * @return Product
     */
    public function setPdtUupd($pdtUupd)
    {
        $this->pdtUupd = $pdtUupd;

        return $this;
    }

    /**
     * Get pdtUupd
     *
     * @return string 
     */
    public function getPdtUupd()
    {
        return $this->pdtUupd;
    }
}
