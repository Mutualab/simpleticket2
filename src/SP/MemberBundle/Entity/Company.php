<?php

namespace SP\MemberBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="SP\MemberBundle\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(name="cpy_name", type="string", length=128)
     */
    private $cpyName;

    /**
     * @var string
     *
     * @ORM\Column(name="cpy_legal_form", type="string", length=24)
     */
    private $cpyLegalForm;

     /**
     * @var integer
     *
     * @ORM\Column(name="cpy_siren", type="integer", length=9)
     */
    private $cpySiren;

    /**
     * @var integer
     *
     * @ORM\Column(name="cpy_siret", type="integer", length=14)
     */
    private $cpySiret;

    /**
     * @var string
     *
     * @ORM\Column(name="cpy_tva_number", type="string", length=13)
     */
    private $cpyTvaNumber;

     /**
     * @var string
     *
     * @ORM\Column(name="cpy_website", type="string", length=128,nullable=true)
     */
    private $cpyWebsite;

     /**
     * @var string
     *
     * @ORM\Column(name="cpy_state", type="string", length=24,options={"unsigned":true, "default":"Active"})
     */
     private $cpyState = 'Active';

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="cpy_dcre", type="date")
     */
    private $cpyDcre;

    /**
     * @var string
     *
     * @ORM\Column(name="cpy_ucre", type="string", length=20, options={"unsigned":true, "default":"Developper"})
     */
    private $cpyUcre = 'Developper';

       /**
     * @var \DateTime
     *
     * @ORM\Column(name="cpy_dupd", type="date")
     */
    private $cpyDupd;

        /**
     * @var string
     *
     * @ORM\Column(name="cpy_uupd", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $cpyUupd = 'developper';


     /**
     * @ORM\ManyToMany(targetEntity="Member", mappedBy="companies")
     **/
    private $members;

    public function __construct(){
        // Par défaut, la date de creation et de modification est la date d'aujourd'hui
        $this->cpyDcre = new \Datetime();
        $this->cpyDupd = new \Datetime();
        $this->members = new ArrayCollection();
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
     * Set cpyName
     *
     * @param string $cpyName
     * @return Company
     */
    public function setCpyName($cpyName)
    {
        $this->cpyName = $cpyName;

        return $this;
    }

    /**
     * Get cpyName
     *
     * @return string
     */
    public function getCpyName()
    {
        return $this->cpyName;
    }

    /**
     * Set cpyLegalForm
     *
     * @param string $cpyLegalForm
     * @return Company
     */
    public function setCpyLegalForm($cpyLegalForm)
    {
        $this->cpyLegalForm = $cpyLegalForm;

        return $this;
    }

    /**
     * Get cpyLegalForm
     *
     * @return string
     */
    public function getCpyLegalForm()
    {
        return $this->cpyLegalForm;
    }

    /**
     * Set cpySiren
     *
     * @param integer $cpySiren
     * @return Company
     */
    public function setCpySiren($cpySiren)
    {
        $this->cpySiren = $cpySiren;

        return $this;
    }

    /**
     * Get cpySiren
     *
     * @return integer
     */
    public function getCpySiren()
    {
        return $this->cpySiren;
    }

    /**
     * Set cpySiret
     *
     * @param integer $cpySiret
     * @return Company
     */
    public function setCpySiret($cpySiret)
    {
        $this->cpySiret = $cpySiret;

        return $this;
    }

    /**
     * Get cpySiret
     *
     * @return integer
     */
    public function getCpySiret()
    {
        return $this->cpySiret;
    }

    /**
     * Set cpyTvaNumber
     *
     * @param integer $cpyTvaNumber
     * @return Company
     */
    public function setCpyTvaNumber($cpyTvaNumber)
    {
        $this->cpyTvaNumber = $cpyTvaNumber;

        return $this;
    }

    /**
     * Get cpyTvaNumber
     *
     * @return integer
     */
    public function getCpyTvaNumber()
    {
        return $this->cpyTvaNumber;
    }

    /**
     * Set cpyWebsite
     *
     * @param string $cpyWebsite
     * @return Company
     */
    public function setCpyWebsite($cpyWebsite)
    {
        $this->cpyWebsite = $cpyWebsite;

        return $this;
    }

    /**
     * Get cpyWebsite
     *
     * @return string
     */
    public function getCpyWebsite()
    {
        return $this->cpyWebsite;
    }

    /**
    * Set cpyState
    *
    * @param string $cpyState
    * @return Company
    */
    public function setCpyState($cpyState)
    {
        $this->cpyState = $cpyState;

        return $this;
    }

    /**
     * Get cpyState
     *
     * @return string
     */
    public function getCpyState()
    {
        return $this->cpyState;
    }

    /**
    * Set cpyDcre
    *
    * @param date $cpyDcre
    * @return Company
    */
    public function setCpyDcre($cpyDcre)
    {
        $this->cpyDcre = $cpyDcre;

        return $this;
    }

    /**
     * Get cpyDcre
     *
     * @return date
     */
    public function getCpyDcre()
    {
        return $this->cpyDcre;
    }

     /**
    * Set cpyUcre
    *
    * @param string $cpyUcre
    * @return Company
    */
    public function setCpyUcre($cpyUcre)
    {
        $this->cpyUcre = $cpyUcre;

        return $this;
    }

    /**
     * Get cpyUcre
     *
     * @return string
     */
    public function getCpyUcre()
    {
        return $this->cpyUcre;
    }

      /**
    * Set cpyDupd
    *
    * @param date $cpyDupd
    * @return Company
    */
    public function setCpyDupd($cpyDupd)
    {
        $this->cpyDupd = $cpyDupd;

        return $this;
    }

    /**
     * Get cpyDupd
     *
     * @return date
     */
    public function getCpyDupd()
    {
        return $this->cpyDupd;
    }

     /**
    * Set cpyUupd
    *
    * @param string $cpyUupd
    * @return Company
    */
    public function setCpyUupd($cpyUupd)
    {
        $this->cpyUupd = $cpyUupd;

        return $this;
    }

    /**
     * Get cpyUupd
     *
     * @return string
     */
    public function getCpyUupd()
    {
        return $this->cpyUupd;
    }

     public function addMember(Member $member)
    {
     //insere comme dans un tableau
        $this->members[] = $member;
    }

    public function setMembers($members)
    {
        $this->members = new ArrayCollection();

        foreach ($members as $member) {
            $this->addMember($member);
        }
    }

    public function getMembers()
    {
        return $this->members;
    }

}
