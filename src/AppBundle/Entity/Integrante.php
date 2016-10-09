<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrantes
 *
 * @ORM\Table(name="integrantes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntegrantesRepository")
 */
class Integrante
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="AppBundle\Entity\Equipo")  
     *  @ORM\JoinColumn(name="equipo", referencedColumnName="id") 
     */ 
    private $equipo;

    /** @ORM\ManyToOne(targetEntity="AppBundle\Entity\Alumno")  
     *  @ORM\JoinColumn(name="alumno", referencedColumnName="id") 
     */ 
    private $alumno;

    /**
     * @var bool
     *
     * @ORM\Column(name="capitan", type="boolean")
     */
    private $capitan;


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
     * Set equipo
     *
     * @param \AppBundle\Entity\Equipo $equipo
     * @return Equipo 
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }

    /**
     * Get equipo
     *
     * @return \AppBundle\Entity\Equipo
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set alumno
     *
     * @param \AppBundle\Entity\Alumno $alumno
     * @return Alumno 
     */
    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;
    }

    /**
     * Get alumno
     *
     * @return \AppBundle\Entity\Alumno
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set capitan
     *
     * @param boolean $capitan
     * @return Integrantes
     */
    public function setCapitan($capitan)
    {
        $this->capitan = $capitan;

        return $this;
    }

    /**
     * Get capitan
     *
     * @return boolean 
     */
    public function getCapitan()
    {
        return $this->capitan;
    }
}
