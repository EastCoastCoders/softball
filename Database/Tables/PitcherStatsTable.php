<?php

/**
 * Created by PhpStorm.
 * User: Greg
 * Date: 10/21/2015
 * Time: 9:38 PM
 */
class PitcherObject
{

    private $id;
    private $players_id;
    private $win;
    private $loss;
    private $era;
    private $innings_pitched;
    private $runs_allowed;
    private $earned_runs_allowed;
    private $walks_allowed;
    private $strike_outs;

    /**
     * PitcherObject constructor.
     * @param $win
     * @param $loss
     * @param $era
     * @param $innings_pitched
     * @param $runs_allowed
     * @param $earned_runs_allowed
     * @param $walks_allowed
     * @param $strike_outs
     */
    public function __construct($win = null, $loss = null, $era = null, $innings_pitched = null, $runs_allowed = null, $earned_runs_allowed = null, $walks_allowed = null,  $strike_outs = null)
    {
        $this->win                 = $win;
        $this->loss                = $loss;
        $this->era                 = $era;
        $this->innings_pitched     = $innings_pitched;
        $this->runs_allowed        = $runs_allowed;
        $this->earned_runs_allowed = $earned_runs_allowed;
        $this->walks_allowed       = $walks_allowed;
        $this->strike_outs         = $strike_outs;
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
    public function getWin()
    {
        return $this->win;
    }

    /**
     * @param mixed $win
     */
    public function setWin($win)
    {
        $this->win = $win;
    }

    /**
     * @return mixed
     */
    public function getLoss()
    {
        return $this->loss;
    }

    /**
     * @param mixed $loss
     */
    public function setLoss($loss)
    {
        $this->loss = $loss;
    }

    /**
     * @return mixed
     */
    public function getEra()
    {
        return $this->era;
    }

    /**
     * @param mixed $era
     */
    public function setEra($era)
    {
        $this->era = $era;
    }

    /**
     * @return mixed
     */
    public function getInningsPitched()
    {
        return $this->innings_pitched;
    }

    /**
     * @param mixed $innings_pitched
     */
    public function setInningsPitched($innings_pitched)
    {
        $this->innings_pitched = $innings_pitched;
    }

    /**
     * @return mixed
     */
    public function getRunsAllowed()
    {
        return $this->runs_allowed;
    }

    /**
     * @param mixed $runs_allowed
     */
    public function setRunsAllowed($runs_allowed)
    {
        $this->runs_allowed = $runs_allowed;
    }

    /**
     * @return mixed
     */
    public function getEarnedRunsAllowed()
    {
        return $this->earned_runs_allowed;
    }

    /**
     * @param mixed $earned_runs_allowed
     */
    public function setEarnedRunsAllowed($earned_runs_allowed)
    {
        $this->earned_runs_allowed = $earned_runs_allowed;
    }

    /**
     * @return mixed
     */
    public function getWalksAllowed()
    {
        return $this->walks_allowed;
    }

    /**
     * @param mixed $walks_allowed
     */
    public function setWalksAllowed($walks_allowed)
    {
        $this->walks_allowed = $walks_allowed;
    }

     /**
     * @return mixed
     */
    public function getStrikeOuts()
    {
        return $this->strike_outs;
    }

    /**
     * @param mixed $strike_outs
     */
    public function setStrikeOuts($strike_outs)
    {
        $this->strike_outs = $strike_outs;
    }

    public function calcEra()
    {

        $result = (($this->earned_runs_allowed)*9) / $this->innings_pitched * .1;
        $result_friendly = number_format($result * 10, 2) . ',';
        $this->setEra($result_friendly);


    }

}

Class PitcherStatsTable extends Database
{

    /** Create Statement Variables **/

    private $id;
    private $players_id;
    private $win;
    private $loss;
    private $era;
    private $innings_pitched;
    private $runs_allowed;
    private $earned_runs_allowed;
    private $walks_allowed;
    private $strike_outs;


    public function __construct()
    {
        parent::__construct();

        // prepare Create Statement
        $this->createStatement = $this->connection->prepare("INSERT INTO pitcher_stats (win, loss, era, innings_pitched, runs_allowed, earned_runs_allowed, walks_allowed, strike_outs)  VALUES (?,?,?,?,?,?,?,?);");
        $this->createStatement->bind_param("iidiiiii", $this->win, $this->loss, $this->era, $this->innings_pitched, $this->runs_allowed, $this->earned_runs_allowed, $this->walks_allowed, $this->strike_outs);

        // prepare read statement
        $this->readStatement = $this->connection->prepare("SELECT * FROM pitcher_stats WHERE id = ?");
        $this->readStatement->bind_param("i", $this->id);

        // prepare update statement
        $this->updateStatement = $this->connection->prepare("UPDATE pitcher_stats SET win = ?, loss = ?, era = ?, innings_pitched = ?, runs_allowed = ?, earned_runs_allowed = ?, walks_allowed = ?,strike_outs = ?");
        $this->updateStatement->bind_param("iidiiiii", $this->win, $this->loss, $this->era, $this->innings_pitched, $this->runs_allowed, $this->earned_runs_allowed, $this->walks_allowed, $this->strike_outs);

        // prepare delete statement
        $this->deleteStatement = $this->connection->prepare("DELETE FROM pitcher_stats WHERE id = ?");
        $this->deleteStatement->bind_param("i", $this->id);
    }

    /**
     * @param PitcherObject $pitcherObject
     */

    public function create($pitcherObject)
    {
        $this->players_id          = (int)parent::cleanData($pitcherObject->getPlayersId());
        $this->win                 = (int)parent::cleanData($pitcherObject->getWin());
        $this->loss                = (int)parent::cleanData($pitcherObject->getLoss());
        $this->era                 = (double)parent::cleanData($pitcherObject->getEra());
        $this->innings_pitched     = (int)parent::cleanData($pitcherObject->getInningsPitched());
        $this->runs_allowed        = (int)parent::cleanData($pitcherObject->getRunsAllowed());
        $this->earned_runs_allowed = (int)parent::cleanData($pitcherObject->getEarnedRunsAllowed());
        $this->walks_allowed       = (int)parent::cleanData($pitcherObject->getWalksAllowed());
        $this->strike_outs         = (int)parent::cleanData($pitcherObject->getStrikeOuts());

        $this->createStatement->execute();
    }

    public function read($id)
    {
        $this->id = (int)$id;
        $this->readStatement->execute();

        $result  = $this->readStatement->get_result();
        $pitcher = new PitcherObject();

        while ($row = $result->fetch_object()) {
            $pitcher->setPlayersId($row->players_id);
            $pitcher->setWin($row->win);
            $pitcher->setLoss($row->loss);
            $pitcher->setEra($row->era);
            $pitcher->setInningsPitched($row->innings_pitched);
            $pitcher->setRunsAllowed($row->runs_allowed);
            $pitcher->setEarnedRunsAllowed($row->runs_allowed);
            $pitcher->setWalksAllowed($row->walks_allowed);
            $pitcher->setStrikeOuts(($row->strike_outs));

        }

        return $pitcher;
    }

    /**
     * @param PitcherObject $pitcherObject
     */
    public function update($pitcherObject)
    {

        $oldData = $this->read($pitcherObject->getId());


        $this->players_id = ($pitcherObject->getPlayersId() !== null) ? parent::cleanData($pitcherObject->getPlayersId()) : $oldData->getPlayersId();
        $this->win        = ($pitcherObject->getWin() !== null) ? parent::cleanData($pitcherObject->getWin()) : $oldData->getWin();
        $this->loss       = ($pitcherObject->getLoss() !== null) ? parent::cleanData($pitcherObject->getLoss()) : $oldData->getLoss();

        $this->era                 = ($pitcherObject->getEra() !== null) ? parent::cleanData($pitcherObject->getEra()) : $oldData->getEra();
        $this->innings_pitched     = ($pitcherObject->getInningsPitched() !== null) ? parent::cleanData($pitcherObject->getInningsPitched()) : $oldData->getInningsPitched();
        $this->runs_allowed = ($pitcherObject->getRunsAllowed() !== null) ? parent::cleanData($pitcherObject->getRunsAllowed()) : $oldData->getRunsAllowed();
        $this->earned_runs_allowed = ($pitcherObject->getEarnedRunsAllowed() !== null) ? parent::cleanData($pitcherObject->getEarnedRunsAllowed()) : $oldData->getEarnedRunsAllowed();

        $this->walks_allowed = ($pitcherObject->getWalksAllowed() !== null) ? parent::cleanData($pitcherObject->getWalksAllowed()) : $oldData->getWalksAllowed();
        $this->strike_outs = ($pitcherObject->getStrikeOuts() !== null) ? parent::cleanData($pitcherObject->getStrikeOuts()) : $oldData->getStrikeOuts();

        $this->updateStatement->execute();
    }


    public function delete($id)
    {

        $this->id = (int)$id;

        $this->deleteStatement->execute();


    }


}