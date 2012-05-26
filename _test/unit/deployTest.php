<?php
require_once '../Deploy/Deploy.php';

class deployTest extends PHPUnit_Framework_TestCase{
    function testParseRunOption() {
        $expecOption = '-aCvz --dry-run';
        
        $deploy = new Deploy();
        $deploy->setOption("-aCvz ");
        $deploy->parseDryRunOption();
        
        $this->assertEquals($expecOption, $deploy->getOption());
    }
    
    function testCanBuildCommand() {
        $option = "-aCvz ";
        $source = "pippo/pluto";
        $destination = "pippo@www.ciccio.com:/var/www/pluto/";
        
        $deploy = new Deploy();
        $deploy->setOption("-aCvz ");
        $deploy->setSource($source);
        $deploy->setDestination($destination);
        try{
            $actualCommand = $deploy->buildCommand();
           
            $this->assertContains("'pippo@www.ciccio.com:/var/www/pluto/", $actualCommand);
            $this->assertContains("rsync -aCvz  'pippo/pluto'", $actualCommand);
        }
        catch (BuildException $e) {
            echo $e->getMessage;
        }
        
    }
    
    /**
     *@expectedException BuildException 
     */
    function testCantBuildCommand() {
        $option = "-avz ";
        $source = "";
        $destination = "pippo@www.ciccio.com:/var/www/pluto/";
        
        $deploy = new Deploy();
        $deploy->setSource($source);
        $deploy->setDestination($destination);
        $actualCommand = $deploy->buildCommand();

        try{
            $actualCommand = $deploy->buildCommand();
        }
        catch (BuildException $e) {
            var_dump($e->getMessage());
            $this->assertEquals("Parameters source and destination are required", $e->getMessage());
        }
    }
}
