<?php
namespace Wizbii\ApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * @MongoDB\Document
 * @HasLifecycleCallbacks
 * @Assert\Callback({"Wizbii\ApiBundle\Validator\Validator", "validateEc"})
 * @Assert\Callback({"Wizbii\ApiBundle\Validator\Validator", "validateEa"})
 * @Assert\Callback({"Wizbii\ApiBundle\Validator\Validator", "validateSn"})
 * @Assert\Callback({"Wizbii\ApiBundle\Validator\Validator", "validateAn"})
 * @Assert\Callback({"Wizbii\ApiBundle\Validator\Validator", "validateWui"})
 */
class ApiEntry
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="int")
     * @Assert\NotNull(message = "version is not valid")
     * @Assert\EqualTo(value = 1)
     */
    protected $v;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotNull(message = "Hit type is not valid")
     * @Assert\Choice(choices = {"pageview", "screenview","event"}, message = "Hit type is not valid")
     */
    protected $t;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\Url()
     */
    protected $dl;

    /**
    * @MongoDB\Field(type="string")
    * @Assert\Url()
    */
    protected $dr;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotNull(message = "wct is not valid")
     * @Assert\Choice(choices = {"profile", "recruiter","visitor","wizbii_employee"}, message = "Wizbii Creator Type is not valid")
     */
    protected $wct;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank(message = "wui is not valid")
     * @Assert\NotNull(message = "wui is not valid")
     */
    protected $wui;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank(message = "wuui is not valid")
     * @Assert\NotNull(message = "wuui is not valid")
     */
    protected $wuui;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $ec;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $ea;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $el;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $ev;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotNull()
     * @Assert\Regex("/^UA-(\S{4})-(\S{1})/")
     */
    protected $tid;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotNull()
     * @Assert\Choice(choices = {"web", "apps","backend"}, message = "Data source is not valid")
     */
    protected $ds;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $cn;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $cs;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $cm;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $ck;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $cc;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $sn;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $an;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $av;

    /**
     * @MongoDB\Field(type="int")
     * @Assert\LessThanOrEqual(3600)
     */
    protected $qt;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $addtime;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set v
     *
     * @param int $v
     * @return $this
     */
    public function setV($v)
    {
        $this->v = $v;
        return $this;
    }

    /**
     * Get v
     *
     * @return int $v
     */
    public function getV()
    {
        return $this->v;
    }

    /**
     * Set t
     *
     * @param string $t
     * @return $this
     */
    public function setT($t)
    {
        $this->t = $t;
        return $this;
    }

    /**
     * Get t
     *
     * @return string $t
     */
    public function getT()
    {
        return $this->t;
    }

    /**
     * Set dl
     *
     * @param string $dl
     * @return $this
     */
    public function setDl($dl)
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * Get dl
     *
     * @return string $dl
     */
    public function getDl()
    {
        return $this->dl;
    }

    /**
     * Set dr
     *
     * @param string $dr
     * @return $this
     */
    public function setDr($dr)
    {
        $this->dr = $dr;
        return $this;
    }

    /**
     * Get dr
     *
     * @return string $dr
     */
    public function getDr()
    {
        return $this->dr;
    }

    /**
     * Set wct
     *
     * @param string $wct
     * @return $this
     */
    public function setWct($wct)
    {
        $this->wct = $wct;
        return $this;
    }

    /**
     * Get wct
     *
     * @return string $wct
     */
    public function getWct()
    {
        return $this->wct;
    }

    /**
     * Set wui
     *
     * @param string $wui
     * @return $this
     */
    public function setWui($wui)
    {
        $this->wui = $wui;
        return $this;
    }

    /**
     * Get wui
     *
     * @return string $wui
     */
    public function getWui()
    {
        return $this->wui;
    }

    /**
     * Set wuui
     *
     * @param string $wuui
     * @return $this
     */
    public function setWuui($wuui)
    {
        $this->wuui = $wuui;
        return $this;
    }

    /**
     * Get wuui
     *
     * @return string $wuui
     */
    public function getWuui()
    {
        return $this->wuui;
    }

    /**
     * Set ec
     *
     * @param string $ec
     * @return $this
     */
    public function setEc($ec)
    {
        $this->ec = $ec;
        return $this;
    }

    /**
     * Get ec
     *
     * @return string $ec
     */
    public function getEc()
    {
        return $this->ec;
    }

    /**
     * Set ea
     *
     * @param string $ea
     * @return $this
     */
    public function setEa($ea)
    {
        $this->ea = $ea;
        return $this;
    }

    /**
     * Get ea
     *
     * @return string $ea
     */
    public function getEa()
    {
        return $this->ea;
    }

    /**
     * Set el
     *
     * @param string $el
     * @return $this
     */
    public function setEl($el)
    {
        $this->el = $el;
        return $this;
    }

    /**
     * Get el
     *
     * @return string $el
     */
    public function getEl()
    {
        return $this->el;
    }

    /**
     * Set ev
     *
     * @param int $ev
     * @return $this
     */
    public function setEv($ev)
    {
        $this->ev = $ev;
        return $this;
    }

    /**
     * Get ev
     *
     * @return int $ev
     */
    public function getEv()
    {
        return $this->ev;
    }

    /**
     * Set ds
     *
     * @param string $ds
     * @return $this
     */
    public function setDs($ds)
    {
        $this->ds = $ds;
        return $this;
    }

    /**
     * Get ds
     *
     * @return string $ds
     */
    public function getDs()
    {
        return $this->ds;
    }

    /**
     * Set cn
     *
     * @param string $cn
     * @return $this
     */
    public function setCn($cn)
    {
        $this->cn = $cn;
        return $this;
    }

    /**
     * Get cn
     *
     * @return string $cn
     */
    public function getCn()
    {
        return $this->cn;
    }

    /**
     * Set cs
     *
     * @param string $cs
     * @return $this
     */
    public function setCs($cs)
    {
        $this->cs = $cs;
        return $this;
    }

    /**
     * Get cs
     *
     * @return string $cs
     */
    public function getCs()
    {
        return $this->cs;
    }

    /**
     * Set cm
     *
     * @param string $cm
     * @return $this
     */
    public function setCm($cm)
    {
        $this->cm = $cm;
        return $this;
    }

    /**
     * Get cm
     *
     * @return string $cm
     */
    public function getCm()
    {
        return $this->cm;
    }

    /**
     * Set ck
     *
     * @param string $ck
     * @return $this
     */
    public function setCk($ck)
    {
        $this->ck = $ck;
        return $this;
    }

    /**
     * Get ck
     *
     * @return string $ck
     */
    public function getCk()
    {
        return $this->ck;
    }

    /**
     * Set cc
     *
     * @param string $cc
     * @return $this
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * Get cc
     *
     * @return string $cc
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set sn
     *
     * @param string $sn
     * @return $this
     */
    public function setSn($sn)
    {
        $this->sn = $sn;
        return $this;
    }

    /**
     * Get sn
     *
     * @return string $sn
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * Set an
     *
     * @param string $an
     * @return $this
     */
    public function setAn($an)
    {
        $this->an = $an;
        return $this;
    }

    /**
     * Get an
     *
     * @return string $an
     */
    public function getAn()
    {
        return $this->an;
    }

    /**
     * Set av
     *
     * @param string $av
     * @return $this
     */
    public function setAv($av)
    {
        $this->av = $av;
        return $this;
    }

    /**
     * Get av
     *
     * @return string $av
     */
    public function getAv()
    {
        return $this->av;
    }

    /**
     * Set qt
     *
     * @param int $qt
     * @return $this
     */
    public function setQt($qt)
    {
        $this->qt = $qt;
        return $this;
    }

    /**
     * Get qt
     *
     * @return int $qt
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * Set addtime
     *
     * @param int $addtime
     * @return $this
     */
    public function setAddtime($addtime)
    {
        $this->addtime = $addtime;
        return $this;
    }

    /**
     * Get addtime
     *
     * @return int $addtime
     */
    public function getAddtime()
    {
        return $this->addtime;
    }

    /**
     * Set tid
     *
     * @param string $tid
     * @return $this
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
        return $this;
    }

    /**
     * Get tid
     *
     * @return string $tid
     */
    public function getTid()
    {
        return $this->tid;
    }

    /** @PrePersist */
    public function doPrePersist(LifecycleEventArgs $eventArgs)
    {
        $this->addtime = time();
    }
}
