<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AsesorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AsesorRepository extends EntityRepository
{
    public function findAsesores()
    {
        $em = $this->getEntityManager();
        $dql = $em->createQueryBuilder();
        $dql->select('a.nombre', 'a.apellidoPaterno', 'a.apellidoMaterno', 'a.correoElectronico')
            ->from('AppBundle:Asesor', 'a');

        return $dql->getQuery()->getResult();
    }
}
