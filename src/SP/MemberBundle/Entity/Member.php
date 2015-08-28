<?php

namespace SP\MemberBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="member")
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
     * @ORM\Column(name="mbr_firstname", type="string", length=64)
     */
    private $mbrFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_lastname", type="string", length=64)
     */
    private $mbrLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_mail", type="string", length=128,nullable=true)
     */
    private $mbrMail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mbr_birthdate", type="date")
     */
    private $mbrBirthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_website", type="string", length=128,nullable=true)
     */
    private $mbrWebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_mobile", type="string", length=16,nullable=true)
     */
    private $mbrMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_job_type", type="string", length=64,nullable=true)
     */
    private $mbrJobType;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_job_title", type="string", length=64,nullable=true)
     */
    private $mbrJobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_state", type="string", length=24,options={"unsigned":true, "default":"Active"})
     */
    private $mbrState = 'Active';

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="mbr_dcre", type="date")
     */
    private $mbrDcre;

    /**
     * @var string
     *
     * @ORM\Column(name="mbr_ucre", type="string", length=20, options={"unsigned":true, "default":"Developper"})
     */
    private $mbrUcre = 'Developper';

       /**
     * @var \DateTime
     *
     * @ORM\Column(name="mbr_dupd", type="date")
     */
    private $mbrDupd;

        /**
     * @var string
     *
     * @ORM\Column(name="mbr_uupd", type="string", length=20,options={"unsigned":true, "default":"Developper"})
     */
    private $mbrUupd = 'Developper';

    /**
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="members")
     * @ORM\JoinTable(name="members_companies")
     **/
    private $companies;

    public function __construct()
    {
        // Par défaut, la date de creation et de modification est la date d'aujourd'hui
        $this->mbrDcre = new \Datetime();
        $this->mbrDupd = new \Datetime();
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
    public function setMbrFirstname($mbrFirstname)
    {
        $this->mbrFirstname = $mbrFirstname;

        return $this;
    }

    /**
     * Get usrFirstname
     *
     * @return string
     */
    public function getMbrFirstname()
    {
        return $this->mbrFirstname;
    }

    /**
     * Set mbrLastname
     *
     * @param string $mbrLastname
     * @return member
     */
    public function setMbrLastname($mbrLastname)
    {
        $this->mbrLastname = $mbrLastname;

        return $this;
    }

    /**
     * Get mbrLastname
     *
     * @return string
     */
    public function getMbrLastname()
    {
        return $this->mbrLastname;
    }

    /**
     * Set mbrMail
     *
     * @param string $mbrMail
     * @return member
     */
    public function setMbrMail($mbrMail)
    {
        $this->mbrMail = $mbrMail;

        return $this;
    }

    /**
     * Get mbrMail
     *
     * @return string
     */
    public function getMbrMail()
    {
        return $this->mbrMail;
    }

    /**
     * Set mbrBirthdate
     *
     * @param \DateTime $mbrBirthdate
     * @return member
     */
    public function setMbrBirthdate($mbrBirthdate)
    {
        $this->mbrBirthdate = $mbrBirthdate;

        return $this;
    }

    /**
     * Get mbrBirthdate
     *
     * @return \DateTime
     */
    public function getMbrBirthdate()
    {
        return $this->mbrBirthdate;
    }

    /**
     * Set mbrWebsite
     *
     * @param string $mbrWebsite
     * @return member
     */
    public function setMbrWebsite($mbrWebsite)
    {
        $this->mbrWebsite = $mbrWebsite;

        return $this;
    }

    /**
     * Get mbrWebsite
     *
     * @return string
     */
    public function getMbrWebsite()
    {
        return $this->mbrWebsite;
    }

    /**
     * Set mbrMobile
     *
     * @param string $mbrMobile
     * @return member
     */
    public function setMbrMobile($mbrMobile)
    {
        $this->mbrMobile = $mbrMobile;

        return $this;
    }

    /**
     * Get mbrMobile
     *
     * @return string
     */
    public function getMbrMobile()
    {
        return $this->mbrMobile;
    }

    /**
     * Set mbrJobType
     *
     * @param string $mbrJobType
     * @return member
     */
    public function setMbrJobType($mbrJobType)
    {
        $this->mbrJobType = $mbrJobType;

        return $this;
    }

    /**
     * Get mbrJobType
     *
     * @return string
     */
    public function getMbrJobType()
    {
        return $this->mbrJobType;
    }

    /**
     * Set mbrJobTitle
     *
     * @param string $mbrJobTitle
     * @return member
     */
    public function setMbrJobTitle($mbrJobTitle)
    {
        $this->mbrJobTitle = $mbrJobTitle;

        return $this;
    }

    /**
     * Get mbrJobTitle
     *
     * @return string
     */
    public function getMbrJobTitle()
    {
        return $this->mbrJobTitle;
    }

    /**
     * Set mbrState
     *
     * @param string $mbrState
     * @return member
     */
    public function setMbrState($mbrState)
    {
        $this->mbrState = $mbrState;

        return $this;
    }

    /**
     * Get mbrState
     *
     * @return string
     */
    public function getMbrState()
    {
        return $this->mbrState;
    }

    /**
     * Set mbrDcre
     *
     * @param \DateTime $mbrDcre
     * @return Member
     */
    public function setMbrDcre($mbrDcre)
    {
        $this->mbrDcre = $mbrDcre;

        return $this;
    }

    /**
     * Get mbrDcre
     *
     * @return \DateTime
     */
    public function getMbrDcre()
    {
        return $this->mbrDcre;
    }

    /**
     * Set mbrUcre
     *
     * @param string $mbrUcre
     * @return Member
     */
    public function setMbrUcre($mbrUcre)
    {
        $this->mbrUcre = $mbrUcre;

        return $this;
    }

    /**
     * Get mbrUcre
     *
     * @return string
     */
    public function getMbrUcre()
    {
        return $this->mbrUcre;
    }

    /**
     * Set mbrDupd
     *
     * @param \DateTime $mbrDupd
     * @return Member
     */
    public function setMbrDupd($mbrDupd)
    {
        $this->mbrDupd = $mbrDupd;

        return $this;
    }

    /**
     * Get mbrDupd
     *
     * @return \DateTime
     */
    public function getMbrDupd()
    {
        return $this->mbrDupd;
    }

    /**
     * Set mbrUupd
     *
     * @param string $mbrUupd
     * @return Member
     */
    public function setMbrUupd($mbrUupd)
    {
        $this->mbrUupd = $mbrUupd;

        return $this;
    }

    /**
     * Get mbrUupd
     *
     * @return string
     */
    public function getMbrUupd()
    {
        return $this->mbrUupd;
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
