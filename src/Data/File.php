<?php


namespace Rappi\Data;


class File extends Data
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $fileRows;
    /**
     * @var int
     */
    private $failedProcessedRows;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $dateCreation;
    /**
     * @var string
     */
    private $dateDownload;
    /**
     * @var string
     */
    private $dateBeginProcess;
    /**
     * @var string
     */
    private $dateProcess;
    /**
     * @var string
     */
    private $state;
    /**
     * @var string
     */
    private $error;


    /**
     * File constructor.
     * @param string $id
     * @param string $fileRows
     * @param int $failedProcessedRows
     * @param string $name
     * @param string $dateCreation
     * @param string $dateDownload
     * @param string $dateBeginProcess
     * @param string $dateProcess
     * @param string $state
     * @param string $error
     */
    public function __construct(
        $id = "",
        $fileRows = "",
        $failedProcessedRows = 10,
        $name = "",
        $dateCreation = "",
        $dateDownload = "",
        $dateBeginProcess = "",
        $dateProcess = "",
        $state = "",
        $error = ""

    ){
        $this->id = $id;
        $this->fileRows = $fileRows;
        $this->failedProcessedRows = $failedProcessedRows;
        $this->name = $name;
        $this->dateCreation = $dateCreation;
        $this->dateDownload = $dateDownload;
        $this->dateBeginProcess = $dateBeginProcess;
        $this->dateProcess = $dateProcess;
        $this->state = $state;
        $this->error = $error;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            "id" => $this->getId(),
            "fileRows" => $this->getFileRows(),
            "failedProcessedRows" => $this->getFailedProcessedRows(),
            "name" => $this->getName(),
            "dateCreation" => $this->getDateCreation(),
            "dateDownload" => $this->getDateDownload(),
            "dateBeginProcess" => $this->getDateBeginProcess(),
            "dateProcess" => $this->getDateProcess(),
            "state" => $this->getState(),
            "error" => $this->getError()
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileRows()
    {
        return $this->fileRows;
    }

    /**
     * @param string $fileRows
     * @return $this
     */
    public function setFileRows($fileRows)
    {
        $this->fileRows = $fileRows;
        return $this;
    }

    /**
     * @return int
     */
    public function getFailedProcessedRows()
    {
        return $this->failedProcessedRows;
    }

    /**
     * @param int $failedProcessedRows
     * @return $this
     */
    public function setFailedProcessedRows($failedProcessedRows)
    {
        $this->failedProcessedRows = $failedProcessedRows;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param string $dateCreation
     * @return $this
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateDownload()
    {
        return $this->dateDownload;
    }

    /**
     * @param string $dateDownload
     * @return $this
     */
    public function setDateDownload($dateDownload)
    {
        $this->dateDownload = $dateDownload;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateBeginProcess()
    {
        return $this->dateBeginProcess;
    }

    /**
     * @param string $dateBeginProcess
     * @return $this
     */
    public function setDateBeginProcess($dateBeginProcess)
    {
        $this->dateBeginProcess = $dateBeginProcess;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateProcess()
    {
        return $this->dateProcess;
    }

    /**
     * @param string $dateProcess
     * @return $this
     */
    public function setDateProcess($dateProcess)
    {
        $this->dateProcess = $dateProcess;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }


}