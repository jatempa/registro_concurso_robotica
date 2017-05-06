<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Equipo
 *
 * @ORM\Table(name="equipos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_equipo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Asesor")
     *  @ORM\JoinColumn(name="asesor", referencedColumnName="id_asesor")
     */
    private $asesor;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Robot")
     *  @ORM\JoinColumn(name="robot", referencedColumnName="id_robot")
     */ 
    private $robot;

    /**
     *  @ORM\OneToMany(targetEntity="AppBundle\Entity\Alumno", mappedBy="equipo")
     */
    private $alumnos;

    public function __construct() {
        $this->alumnos = new ArrayCollection();
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
     * Set asesor
     *
     * @param \AppBundle\Entity\Asesor $asesor
     * @return Asesor 
     */
    public function setAsesor($asesor)
    {
        $this->asesor = $asesor;
    }

    /**
     * Get asesor
     *
     * @return \AppBundle\Entity\Asesor
     */
    public function getAsesor()
    {
        return $this->asesor;
    }

    /**
     * Set robot
     *
     * @param \AppBundle\Entity\Robot $robot
     * @return Robot 
     */
    public function setRobot($robot)
    {
        $this->robot = $robot;
    }

    /**
     * Get robot
     *
     * @return \AppBundle\Entity\Robot
     */
    public function getRobot()
    {
        return $this->robot;
    }

    /**
     * Add alumno
     *
     * @param \AppBundle\Entity\Alumno $alumno
     *
     * @return Equipo
     */
    public function addAlumno(\AppBundle\Entity\Alumno $alumno)
    {
        $this->alumnos[] = $alumno;

        return $this;
    }

    /**
     * Remove alumno
     *
     * @param \AppBundle\Entity\Alumno $alumno
     */
    public function removeAlumno(\AppBundle\Entity\Alumno $alumno)
    {
        $this->alumnos->removeElement($alumno);
    }

    /**
     * Get alumnos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    public function __toString()
    {
        return $this->getRobot()->getNombre();
    }
}
