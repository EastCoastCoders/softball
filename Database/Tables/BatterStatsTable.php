<?php


class BatterObject
{

    private $id;
    private $players_id;
    private $position;
    private $at_bats;
    private $runs;
    private $hits;
    private $doubles;
    private $triples;
    private $home_runs;
    private $rbi;
    private $walks;
    private $avg;
    private $on_base;
    private $slugging_percent;
    private $sac_fly;

    /**
     * BatterObject constructor.
     * @param $players_id
     * @param $position
     * @param $at_bats
     * @param $runs
     * @param $hits
     * @param $doubles
     * @param $triples
     * @param $home_runs
     * @param $rbi
     * @param $walks
     * @param $sac_fly ;
     */
    public function __construct($players_id = null, $position = null, $at_bats = null, $runs = null, $hits = null, $doubles = null, $triples = null, $home_runs = null, $rbi = null, $walks = null, $sac_fly = null)
    {
        $this->players_id = $players_id;
        $this->position   = $position;
        $this->at_bats    = $at_bats;
        $this->runs       = $runs;
        $this->hits       = $hits;
        $this->doubles    = $doubles;
        $this->triples    = $triples;
        $this->home_runs  = $home_runs;
        $this->rbi        = $rbi;
        $this->walks      = $walks;
        $this->sac_fly    = $sac_fly;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getPlayersId()
    {
        return $this->players_id;
    }

    /**
     * @param mixed $players_id
     */
    public function setPlayersId($players_id)
    {
        $this->players_id = $players_id;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getAtBats()
    {
        return $this->at_bats;
    }

    /**
     * @param mixed $at_bats
     */
    public function setAtBats($at_bats)
    {
        $this->at_bats = $at_bats;
    }

    /**
     * @return mixed
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * @param mixed $runs
     */
    public function setRuns($runs)
    {
        $this->runs = $runs;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param mixed $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return mixed
     */
    public function getDoubles()
    {
        return $this->doubles;
    }

    /**
     * @param mixed $doubles
     */
    public function setDoubles($doubles)
    {
        $this->doubles = $doubles;
    }

    /**
     * @return mixed
     */
    public function getTriples()
    {
        return $this->triples;
    }

    /**
     * @param mixed $triples
     */
    public function setTriples($triples)
    {
        $this->triples = $triples;
    }

    /**
     * @return mixed
     */
    public function getHomeRuns()
    {
        return $this->home_runs;
    }

    /**
     * @param mixed $home_runs
     */
    public function setHomeRuns($home_runs)
    {
        $this->home_runs = $home_runs;
    }

    /**
     * @return mixed
     */
    public function getRbi()
    {
        return $this->rbi;
    }

    /**
     * @param mixed $rbi
     */
    public function setRbi($rbi)
    {
        $this->rbi = $rbi;
    }

    /**
     * @return mixed
     */
    public function getWalks()
    {
        return $this->walks;
    }

    /**
     * @param mixed $walks
     */
    public function setWalks($walks)
    {
        $this->walks = $walks;
    }

    /**
     * @return mixed
     */
    public function getAvg()
    {
        return $this->avg;
    }

    /**
     * @param mixed $avg
     */
    public function setAvg($avg)
    {
        $this->avg = $avg;
    }

    /**
     * @return mixed
     */
    public function getOnBase()
    {
        return $this->on_base;
    }

    /**
     * @param mixed $on_base
     */
    public function setOnBase($on_base)
    {
        $this->on_base = $on_base;
    }

    /**
     * @return mixed
     */
    public function getSluggingPercent()
    {
        return $this->slugging_percent;
    }

    /**
     * @param mixed $slugging_percent
     */
    public function setSluggingPercent($slugging_percent)
    {
        $this->slugging_percent = $slugging_percent;
    }

    /**
     * @return null
     */
    public function getSacFly()
    {
        return $this->sac_fly;
    }

    /**
     * @param null $sac_fly
     */
    public function setSacFly($sac_fly)
    {
        $this->sac_fly = $sac_fly;
    }

    public function calcPercents()
    {
//        calculate batting average
        $result          = (($this->getHits() / $this->getAtBats()) * .01);
        $result_friendly = number_format($result * 100, 3) . ',';
        $this->setAvg($result_friendly);

//        calculate on base percent
        $result          = (($this->hits + $this->walks) / ($this->at_bats + $this->walks + $this->sac_fly)) * .01;
        $result_friendly = number_format($result * 100, 3) . ',';
        $this->setOnBase($result_friendly);

//        calculate slugging_percent
        $singles         = ($this->hits) - ($this->doubles + $this->triples + $this->home_runs);
        $result          = ((($singles) + ($this->doubles * 2) + ($this->triples * 3) + ($this->home_runs * 4)) / $this->at_bats) * .01;
        $result_friendly = number_format($result * 100, 3) . ',';
        $this->setSluggingPercent($result_friendly);

    }

}

Class BatterStatsTable extends Database
{

    /** Create Statement Variables **/

    private $id;
    private $players_id;
    private $position;
    private $at_bats;
    private $runs;
    private $hits;
    private $doubles;
    private $triples;
    private $home_runs;
    private $rbi;
    private $walks;
    private $avg;
    private $on_base;
    private $slugging_percent;
    private $sac_fly;

    public function __construct()
    {
        parent::__construct();

        // prepare Create Statement
        $this->createStatement = $this->connection->prepare("INSERT INTO batter_stats(players_id, position, at_bats, runs, hits, doubles, triples, home_runs, rbi, walks, avg, on_base, slugging_percent, sac_fly) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $this->createStatement->bind_param("isiiiiiiiidddi", $this->players_id, $this->position, $this->at_bats, $this->runs, $this->hits, $this->doubles, $this->triples, $this->home_runs, $this->rbi, $this->walks, $this->avg, $this->on_base, $this->slugging_percent, $this->sac_fly);

        // prepare read statement
        $this->readStatement = $this->connection->prepare("SELECT * FROM batter_stats WHERE id = ?");
        $this->readStatement->bind_param("i", $this->id);

        // prepare update statement
        $this->updateStatement = $this->connection->prepare("UPDATE batter_stats SET players_id = ?, position = ?, at_bats = ?, runs = ?, hits = ?, doubles = ?, triples = ?, home_runs = ?, rbi = ?, walks = ?, avg = ?, on_base = ?, slugging_percent = ?, sac_fly = ?");
        $this->updateStatement->bind_param("isiiiiiiiidddi", $this->players_id, $this->position, $this->at_bats, $this->runs, $this->hits, $this->doubles, $this->triples, $this->home_runs, $this->rbi, $this->walks, $this->avg, $this->on_base, $this->slugging_percent, $this->sac_fly);

        // prepare delete statement
        $this->deleteStatement = $this->connection->prepare("DELETE FROM batter_stats WHERE id = ?");
        $this->deleteStatement->bind_param("i", $this->id);
    }

    /**
     * @param BatterObject $BatterObject
     */
    public function create($BatterObject)
    {
        $this->players_id       = (int)parent::cleanData($BatterObject->getPlayersId());
        $this->position         = (int)parent::cleanData($BatterObject->getPosition());
        $this->at_bats          = (int)parent::cleanData($BatterObject->getAtBats());
        $this->runs             = (int)parent::cleanData($BatterObject->getRuns());
        $this->hits             = (int)parent::cleanData($BatterObject->getHits());
        $this->doubles          = (int)parent::cleanData($BatterObject->getDoubles());
        $this->triples          = (int)parent::cleanData($BatterObject->getTriples());
        $this->home_runs        = (int)parent::cleanData($BatterObject->getHomeRuns());
        $this->rbi              = (int)parent::cleanData($BatterObject->getRbi());
        $this->walks            = (int)parent::cleanData($BatterObject->getWalks());
        $this->avg              = (double)$BatterObject->getAvg();
        $this->on_base          = (double)$BatterObject->getOnBase();
        $this->slugging_percent = (double)$BatterObject->getSluggingPercent();
        $this->sac_fly          = (int)parent::cleanData($BatterObject->getSacFly());

        $this->createStatement->execute();


    }

    public function read($id)
    {
        $this->id = (int)$id;
        $this->readStatement->execute();

        $result = $this->readStatement->get_result();
        $batter   = new BatterObject();

        while ($row = $result->fetch_object()) {

            $batter->setPlayersId($row->players_id);
            $batter->setPosition($row->position);
            $batter->setAtBats($row->at_bats);
            $batter->setRuns($row->runs);
            $batter->setHits($row->hits);
            $batter->setDoubles($row->doubles);
            $batter->setTriples($row->triples);
            $batter->setHomeRuns($row->home_runs);
            $batter->setRbi($row->rbi);
            $batter->setWalks($row->walks);
            $batter->setAvg($row->avg);
            $batter->setOnBase($row->on_base);
            $batter->setSluggingPercent($row->slugging_percent);
            $batter->setSacFly($row->sac_fly);
        }

        return $batter;

    }

    /**
     * @param BatterObject $BatterObject
     */
    public function update($BatterObject)
    {
        $oldData = $this->read($BatterObject->getId());

        $this->players_id = ($BatterObject->getPlayersId() !== null) ? parent::cleanData($BatterObject->getPlayersId()) : $oldData->getPlayersId();
        $this->position   = ($BatterObject->getPosition() !== null) ? parent::cleanData($BatterObject->getPosition()) : $oldData->getPosition();
        $this->at_bats    = ($BatterObject->getAtBats() !== null) ? parent::cleanData($BatterObject->getAtBats()) : $oldData->getAtBats();

        $this->runs    = ($BatterObject->getRuns() !== null) ? parent::cleanData($BatterObject->getRuns()) : $oldData->getRuns();
        $this->hits    = ($BatterObject->getHits() !== null) ? parent::cleanData($BatterObject->getHits()) : $oldData->getHits();
        $this->doubles = ($BatterObject->getDoubles() !== null) ? parent::cleanData($BatterObject->getDoubles()) : $oldData->getDoubles();
        $this->triples   = ($BatterObject->getTriples() !== null) ? parent::cleanData($BatterObject->getTriples()) : $oldData->getTriples();

        $this->home_runs = ($BatterObject->getHomeRuns() !== null) ? parent::cleanData($BatterObject->getHomeRuns()) : $oldData->getHomeRuns();
        $this->rbi       = ($BatterObject->getRbi() !== null) ? parent::cleanData($BatterObject->getRbi()) : $oldData->getRbi();
        $this->walks     = ($BatterObject->getWalks() !== null) ? parent::cleanData($BatterObject->getWalks()) : $oldData->getWalks();
        $this->sac_fly   = ($BatterObject->getSacFly() !== null) ? parent::cleanData($BatterObject->getSacFly()) : $oldData->getSacFly();

        $this->updateStatement->execute();

    }


    public function delete($id)
    {

        $this->id = (int)$id;

        $this->deleteStatement->execute();


    }


}