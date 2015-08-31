<?php

namespace SP\MemberBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

        /**
     * @var string
     *
     * @ORM\Column(name="usr_firstname", type="string", length=64)
     */
    private $usrFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_lastname", type="string", length=64)
     */
    private $usrLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_mail", type="string", length=128,nullable=true)
     */
    private $usrMail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_birthdate", type="date")
     */
    private $usrBirthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_website", type="string", length=128,nullable=true)
     */
    private $usrWebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_mobile", type="string", length=16,nullable=true)
     */
    private $usrMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_job_type", type="string", length=64,nullable=true)
     */
    private $usrJobType;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_job_title", type="string", length=64,nullable=true)
     */
    private $usrJobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_state", type="string", length=24,nullable=true,options={"unsigned":true, "default":"Active"})
     */
    private $usrState = 'Active';

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_dcre", type="date")
     */
    private $usrDcre;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_ucre", type="string", length=20, options={"unsigned":true, "default":"Developper"})
     */
    private $usrUcre = 'Developper';

       /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_dupd", type="date")
     */
    private $usrDupd;

        /**
     * @var string
     *
     * @ORM\Column(name="usr_uupd", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $usrUupd = 'developper';

    /**
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="members")
     * @ORM\JoinTable(name="members_companies")
     **/
    private $companies;

    public function __construct()
    {
        // Par défaut, la date de creation et de modification est la date d'aujourd'hui
        $this->usrDcre = new \Datetime();
        $this->usrDupd = new \Datetime();
        $this->companies = new ArrayCollection();
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
     * Set usrFirstname
     *
     * @param string $usrFirstname
     * @return user
     */
    public function setUsrFirstname($usrFirstname)
    {
        $this->usrFirstname = $usrFirstname;

        return $this;
    }

    /**
     * Get usrFirstname
     *
     * @return string
     */
    public function getUsrFirstname()
    {
        return $this->usrFirstname;
    }

    /**
     * Set usrLastname
     *
     * @param string $usrLastname
     * @return user
     */
    public function setUsrLastname($usrLastname)
    {
        $this->usrLastname = $usrLastname;

        return $this;
    }

    /**
     * Get usrLastname
     *
     * @return string
     */
    public function getUsrLastname()
    {
        return $this->usrLastname;
    }

    /**
     * Set usrMail
     *
     * @param string $usrMail
     * @return user
     */
    public function setUsrMail($usrMail)
    {
        $this->usrMail = $usrMail;

        return $this;
    }

    /**
     * Get usrMail
     *
     * @return string
     */
    public function getUsrMail()
    {
        return $this->usrMail;
    }

    /**
     * Set usrBirthdate
     *
     * @param \DateTime $usrBirthdate
     * @return user
     */
    public function setUsrBirthdate($usrBirthdate)
    {
        $this->usrBirthdate = $usrBirthdate;

        return $this;
    }

    /**
     * Get usrBirthdate
     *
     * @return \DateTime
     */
    public function getUsrBirthdate()
    {
        return $this->usrBirthdate;
    }

    /**
     * Set usrWebsite
     *
     * @param string $usrWebsite
     * @return user
     */
    public function setUsrWebsite($usrWebsite)
    {
        $this->usrWebsite = $usrWebsite;

        return $this;
    }

    /**
     * Get usrWebsite
     *
     * @return string
     */
    public function getUsrWebsite()
    {
        return $this->usrWebsite;
    }

    /**
     * Set usrMobile
     *
     * @param string $usrMobile
     * @return user
     */
    public function setUsrMobile($usrMobile)
    {
        $this->usrMobile = $usrMobile;

        return $this;
    }

    /**
     * Get usrMobile
     *
     * @return string
     */
    public function getUsrMobile()
    {
        return $this->usrMobile;
    }

    /**
     * Set usrJobType
     *
     * @param string $usrJobType
     * @return user
     */
    public function setUsrJobType($usrJobType)
    {
        $this->usrJobType = $usrJobType;

        return $this;
    }

    /**
     * Get usrJobType
     *
     * @return string
     */
    public function getUsrJobType()
    {
        return $this->usrJobType;
    }

    /**
     * Set usrJobTitle
     *
     * @param string $usrJobTitle
     * @return user
     */
    public function setUsrJobTitle($usrJobTitle)
    {
        $this->usrJobTitle = $usrJobTitle;

        return $this;
    }

    /**
     * Get usrJobTitle
     *
     * @return string
     */
    public function getUsrJobTitle()
    {
        return $this->usrJobTitle;
    }

    /**
     * Set usrState
     *
     * @param string $usrState
     * @return user
     */
    public function setUsrState($usrState)
    {
        $this->usrState = $usrState;

        return $this;
    }

    /**
     * Get usrState
     *
     * @return string
     */
    public function getUsrState()
    {
        return $this->usrState;
    }

    /**
     * Set usrDcre
     *
     * @param \DateTime $usrDcre
     * @return User
     */
    public function setUsrDcre($usrDcre)
    {
        $this->usrDcre = $usrDcre;

        return $this;
    }

    /**
     * Get usrDcre
     *
     * @return \DateTime
     */
    public function getUsrDcre()
    {
        return $this->usrDcre;
    }

    /**
     * Set usrUcre
     *
     * @param string $usrUcre
     * @return User
     */
    public function setUsrUcre($usrUcre)
    {
        $this->usrUcre = $usrUcre;

        return $this;
    }

    /**
     * Get usrUcre
     *
     * @return string
     */
    public function getUsrUcre()
    {
        return $this->usrUcre;
    }

    /**
     * Set usrDupd
     *
     * @param \DateTime $usrDupd
     * @return User
     */
    public function setUsrDupd($usrDupd)
    {
        $this->usrDupd = $usrDupd;

        return $this;
    }

    /**
     * Get usrDupd
     *
     * @return \DateTime
     */
    public function getUsrDupd()
    {
        return $this->usrDupd;
    }

    /**
     * Set usrUupd
     *
     * @param string $usrUupd
     * @return User
     */
    public function setUsrUupd($usrUupd)
    {
        $this->usrUupd = $usrUupd;

        return $this;
    }

    /**
     * Get usrUupd
     *
     * @return string
     */
    public function getUsrUupd()
    {
        return $this->usrUupd;
    }

    public function getCompanies()
    {
        return $this->companies;
    }

    public function addCompany(Company $company)
    {
     //insere comme dans un tableau
        $this->companies[] = $company;
    }

    public function setCompanies($companies)
    {
        $this->companies = new ArrayCollection();

        foreach ($companies as $company) {
            $this->addComapny($company);
        }
    }
}
