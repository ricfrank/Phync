<?php
require_once '../Deploy.php';

class deployTest extends PHPUnit_Framework_TestCase{
    function testParseRunOption() {
        $expecOption = '-avz --dry-run';
        
        $deploy = new Deploy();
        $deploy->parseDryRunOption();
        
        $this->assertEquals($expecOption, $deploy->getOption());
    }
    
    function testCanBuildCommand() {
        $option = "-avz ";
        $source = "pippo/pluto";
        $destination = "pippo@www.ciccio.com:/var/www/pluto";
        
        $deploy = new Deploy();
        $deploy->setSource($source);
        $deploy->setDestination($destination);
        try{
            $actualCommand = $deploy->buildCommand();
            
            $this->assertEquals("rsync ".$option." '".$source."' '".$destination."'", $actualCommand);
        }
        catch (BuildException $e) {
            echo $e->getMessage;
        }
        
    }
    
    function testCantBuildCommand() {
        $option = "-avz ";
        $source = "";
        $destination = "pippo@www.ciccio.com:/var/www/pluto";
        
        $deploy = new Deploy();
        $deploy->setSource($source);
        $deploy->setDestination($destination);
        $actualCommand = $deploy->buildCommand();

        try{
            $actualCommand = $deploy->buildCommand();
        }
        catch (BuildException $e) {
            var_dump($e->getMessage());
            
        }
    }
    
}
