<?php

require_once 'vendor/phing/phing/classes/phing/Phing.php';

class Deploy extends Task{

    /**
     * The message passed in the buildfile.
     */
    private $destination = null;
    private $source = null;
    private $dryRun = true;
    private $option = "-avz ";
    private $command = "rsync ";

    public function setDestination($destination) {
        $this->destination = $destination;
    }
    
    public function setSource($source) {
        $this->source = $source;
    }
    
    public function setDryRun($dr) {
        $this->dryRun = $dr;
    }
    
    public function getOption() {
        return $this->option;
    }


    public function setOption($option) {
        $this->option = $option;
    }

    /**
     * The init method: Do init steps.
     */
    public function init() {
      // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main() {
      print($this->message);
    }
    
    /**
     * La dry-run serve per effettuare una simulazione della sincronizzazione
     * senza che effettivamente i dati vengano trasferiti 
     */
    public function parseDryRunOption() {
        if( (bool) $this->dryRun) {
            $this->option .= "--dry-run";
        }
    }
    
    public function buildCommand() {
        if(empty($this->source) || empty($this->destination)) {
            throw new BuildException("Gli attributi sorgente e destinazione sono obbligatori");
        }
        return $this->command.$this->option." "
               .escapeshellarg($this->source)." "
               .escapeshellarg($this->destination);
    }
    
}