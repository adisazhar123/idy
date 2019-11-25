<?php 

namespace Idy\Idea\Infrastructure;

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
        $statement = sprintf("INSERT INTO ideas(title, description, author_name, author_email, votes) VALUES(:title, :description, :author_name, :author_email, :votes)" );
        $params = ['title' => $idea->title(), 'description' => $idea->description(), 'author_name' => $idea->author()->name(), 'author_email' => $idea->author()->email(), 'votes' => 0];

        return $this->db->execute($statement, $params);
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