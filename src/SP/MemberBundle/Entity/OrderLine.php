<?php

namespace SP\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderLine
 *
 * @ORM\Table(name="orderline")
 * @ORM\Entity(repositoryClass="SP\MemberBundle\Repository\OrderLineRepository")
 */
class OrderLine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //on autorise le champs 'member' a etre null mais 'company' devrat etre renseigne
    /**
    * @ORM\ManyToOne(targetEntity="SP\MemberBundle\Entity\Member")
    * @ORM\JoinColumn(nullable=true)
    */
    private $member;

    //on autorise le champs 'company' a etre null mais 'member' devrat etre renseigne
    /**
    * @ORM\ManyToOne(targetEntity="SP\MemberBundle\Entity\Company")
    * @ORM\JoinColumn(nullable=true)
    */
    private $company;

    //on n'autorise pas le champs 'product' a etre null, une commande contient au moins un produit
    /**
    * @ORM\ManyToOne(targetEntity="SP\MemberBundle\Entity\Product")
    * @ORM\JoinColumn(nullable=false)
    */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="odl_initial_qty", type="integer")
     */
    private $odlInitialQty;

    /**
     * @var decimal
     *
     * @ORM\Column(name="odl_pending_qty", type="decimal",scale=2)
     */
    private $odlPendingQty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="odl_start_date", type="date")
     */
    private $odlStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="odl_end_date", type="date")
     */
    private $odlEndDate;

    /**
     * @var string
     *
     * @ORM\Column(name="odl_state", type="string", length=24,options={"unsigned":true, "default":"Active"})
     */
    private $odlState='Active';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="odl_dcre", type="datetime")
     */
    private $odlDcre;

    /**
     * @var string
     *
     * @ORM\Column(name="odl_ucre", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $odlUcre='Developper';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="odl_dupd", type="datetime")
     */
    private $odlDupd;

    /**
     * @var string
     *
     * @ORM\Column(name="odl_uupd", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $odlUupd='Developper';

    public function __construct(){
        // Par défaut, la date de creation et de modification est la date du jour
        $this->odlDcre = new \Datetime();
        $this->odlDupd = new \Datetime();
        $this->odlStartDate = new \Datetime();
        $this->odlEndDate = new \Datetime();
   }
    
    public function calculateOdlPendingQty()
    {
         $this->setOdlPendingQty(
            $this->getProduct()->getPdtUnitQty()
            *
            $this->getOdlInitialQty()
        );
        
        return $this;
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
     * Set odlInitialQty
     *
     * @param integer $odlInitialQty
     * @return OrderLine
     */
    public function setOdlInitialQty($odlInitialQty)
    {
        $this->odlInitialQty = $odlInitialQty;

        return $this;
    }

    /**
     * Get odlInitialQty
     *
     * @return integer
     */
    public function getOdlInitialQty()
    {
        return $this->odlInitialQty;
    }

    /**
     * Set odlPendingQty
     *
     * @param float $odlPendingQty
     * @return OrderLine
     */
    public function setOdlPendingQty($odlPendingQty)
    {
        $this->odlPendingQty = $odlPendingQty;

        return $this;
    }

    /**
     * Get odlPendingQty
     *
     * @return float
     */
    public function getOdlPendingQty()
    {
        return $this->odlPendingQty;
    }

    /**
     * Set odlStartDate
     *
     * @param \DateTime $odlStartDate
     * @return OrderLine
     */
    public function setOdlStartDate($odlStartDate)
    {
        $this->odlStartDate = $odlStartDate;

        return $this;
    }

    /**
     * Get odlStartDate
     *
     * @return \DateTime
     */
    public function getOdlStartDate()
    {
        return $this->odlStartDate;
    }

    /**
     * Set odlEndDate
     *
     * @param \DateTime $odlEndDate
     * @return OrderLine
     */
    public function setOdlEndDate($odlEndDate)
    {
        $this->odlEndDate = $odlEndDate;

        return $this;
    }

    /**
     * Get odlEndDate
     *
     * @return \DateTime
     */
    public function getOdlEndDate()
    {
        return $this->odlEndDate;
    }

    /**
     * Set odlState
     *
     * @param string $odlState
     * @return OrderLine
     */
    public function setOdlState($odlState)
    {
        $this->odlState = $odlState;

        return $this;
    }

    /**
     * Get odlState
     *
     * @return string
     */
    public function getOdlState()
    {
        return $this->odlState;
    }

    /**
     * Set odlDcre
     *
     * @param \DateTime $odlDcre
     * @return OrderLine
     */
    public function setOdlDcre($odlDcre)
    {
        $this->odlDcre = $odlDcre;

        return $this;
    }

    /**
     * Get odlDcre
     *
     * @return \DateTime
     */
    public function getOdlDcre()
    {
        return $this->odlDcre;
    }

    /**
     * Set odlUcre
     *
     * @param string $odlUcre
     * @return OrderLine
     */
    public function setOdlUcre($odlUcre)
    {
        $this->odlUcre = $odlUcre;

        return $this;
    }

    /**
     * Get odlUcre
     *
     * @return string
     */
    public function getOdlUcre()
    {
        return $this->odlUcre;
    }

    /**
     * Set odlDupd
     *
     * @param \DateTime $odlDupd
     * @return OrderLine
     */
    public function setOdlDupd($odlDupd)
    {
        $this->odlDupd = $odlDupd;

        return $this;
    }

    /**
     * Get odlDupd
     *
     * @return \DateTime
     */
    public function getOdlDupd()
    {
        return $this->odlDupd;
    }

    /**
     * Set odlUupd
     *
     * @param string $odlUupd
     * @return OrderLine
     */
    public function setOdlUupd($odlUupd)
    {
        $this->odlUupd = $odlUupd;

        return $this;
    }

    /**
     * Get odlUupd
     *
     * @return string
     */
    public function getOdlUupd()
    {
        return $this->odlUupd;
    }

    /**
     * Set member
     *
     * @param \SP\MemberBundle\Entity\Member $member
     * @return OrderLine
     */
    public function setMember(Member $member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \SP\MemberBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set company
     *
     * @param \SP\MemberBundle\Entity\Company $company
     * @return OrderLine
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \SP\MemberBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set product
     *
     * @param \SP\MemberBundle\Entity\Product $product
     * @return OrderLine
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \SP\MemberBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
