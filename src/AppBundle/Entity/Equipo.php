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

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Asesor")
     *  @ORM\JoinColumn(name="asesor", referencedColumnName="id_asesor")
     */
    private $asesor;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Robot")
     *  @ORM\JoinColumn(name="robot", referencedColumnName="id_robot")
     */ 
    private $robot;

    /**
     * Many Equipos have Many Alumnos.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Alumno")
     * @ORM\JoinTable(name="equipo_alumnos",
     *     joinColumns={@ORM\JoinColumn(name="equipo", referencedColumnName="id_equipo")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="alumno", referencedColumnName="id_alumno", unique=true)}
     * )
     */
    private $alumnos;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Equipo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set asesor
     *
     * @param \AppBundle\Entity\Asesor $asesor
     *
     * @return Equipo
     */
    public function setAsesor(\AppBundle\Entity\Asesor $asesor = null)
    {
        $this->asesor = $asesor;

        return $this;
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
     *
     * @return Equipo
     */
    public function setRobot(\AppBundle\Entity\Robot $robot = null)
    {
        $this->robot = $robot;

        return $this;
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
        return $this->getNombre();
    }
}
