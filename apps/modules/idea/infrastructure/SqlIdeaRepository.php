<?php 

namespace Idy\Idea\Infrastructure;

use Idy\Idea\Application\IdeaMapper;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\IdeaRepository;
use PDO;
use Phalcon\Db\Adapter\Pdo\Mysql;

class SqlIdeaRepository implements IdeaRepository
{
    private $db;

    public function __construct(Mysql $db)
    {
        $this->db = $db;
    }

    public function byId(IdeaId $id)
    {

    }

    public function save(Idea $idea)
    {

    }

    public function allIdeas()
    {
        $statement = sprintf("SELECT * FROM ideas");

        return $this->db->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allRatings()
    {
        $statement = sprintf("SELECT * FROM ratings");

        return $this->db->query($statement)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}