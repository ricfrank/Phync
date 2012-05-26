<?php

class Deploy extends Task{

    private $destination = null;
    private $source = null;
    private $dryRun = true;
    private $option = null;
    private $command = "rsync ";

    public function setDestination($destination) {
        $this->destination = $destination."/".$this->getDestinationWithTimestamp();
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

    public function init() {
      // nothing to do here
    }
   
    public function main() {
        $this->parseDryRunOption();
        
        $command = $this->buildCommand();
        echo "Command ".$command.PHP_EOL.PHP_EOL;
        
        exec($command, $output, $returnCommandCode);
        
        $this->showCommandResult(array("commandOutput" => $output, "returnCommandCode" => $returnCommandCode));
    }
    
    
    public function showCommandResult($result) {
        foreach ($result["commandOutput"] as $commandOutputValue) {
            echo $commandOutputValue.PHP_EOL;
        }
        echo PHP_EOL."Status code: ".$result["returnCommandCode"].PHP_EOL;
    }
    
    /**
     *  Dry-run true for simulation
     */
    public function parseDryRunOption() {
        if( (bool) $this->dryRun) {
            $this->option .= "--dry-run";
        }
    }

    public function getDestinationWithTimestamp() {
        $date = new DateTime();
        return $date->getTimestamp(); 
    }
    
    public function buildCommand() {
        if(empty($this->source) || empty($this->destination)) {
            throw new BuildException("Parameters source and destination are required");
        }
        return $this->command.$this->option." "
               .escapeshellarg($this->source)." "
               .escapeshellarg($this->destination);
    }
    
}