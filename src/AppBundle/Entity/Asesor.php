<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asesor
 *
 * @ORM\Table(name="asesores")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AsesorRepository")
 */
class Asesor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_asesor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=100)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_materno", type="string", length=100, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=100)
     */
    private $correoElectronico;

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
     * @return Asesor
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
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     *
     * @return Asesor
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     *
     * @return Asesor
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set correoElectronico
     *
     * @param string $correoElectronico
     *
     * @return Asesor
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    public function __toString()
    {
        return $this->getNombre() . " " . $this->getApellidoPaterno();
    }
}
