<?php
class Witch {
    public function killCount($year)
    {
        $killCalculation[] = 1;
        for($x=1; $x<$year;$x++) {
            $killCalculation[] = $x;
        }

        if ( $killCalculation > 3) {
            array_pop($killCalculation);
            $killCalculation[] = array_sum(array_slice($killCalculation, -2, 2));
        }

        return array_sum($killCalculation);
    }
}

class Person {
    private $identifier, $ageOfDeath, $yearOfDeath;
    public $errorMsg;

    public function setProperties($prop = [])
    {
        if ( empty($prop) ) {
            throw new Exception("Undefined Prop Values.");
        }

        foreach( $prop as $key => $value) {
            $this->$key = $value;
        }
    }

    public function attributes()
    {
        return [
            'ageOfDeath' => $this->ageOfDeath,
            'yearOfDeath' => $this->yearOfDeath,
        ];
    }

    public function personInformation()
    {
        echo "Person: ".$this->identifier."<br/>";
        echo "Age of Death: ".$this->ageOfDeath."<br/>";
        echo "Year of Death: ".$this->yearOfDeath."<br/>";
        echo "Total Person Killed: ".$this->getKillCount()."<br/>";
        echo "================ <br/>";
    }

    public function validate()
    {
        if ( $this->ageOfDeath > $this->yearOfDeath) {
            $this->errorMsg = '-1';
            return false;
        }
    }

    public function getKillCount()
    {
        return (new Witch)->killCount((int) $this->yearOfDeath - (int) $this->ageOfDeath);
    }
}

class Calculate {
    private $personAccumulated;

    public function push($killCount)
    {
        $this->personAccumulated[] = $killCount;
    }
    public function getAverage()
    {
        return array_sum($this->personAccumulated) / count($this->personAccumulated);
    }
}

if ($_POST) {
    $averageKillCount = (new Calculate);
    $ageOfDeathA = isset($_POST['personA']['aod']) ? $_POST['personA']['aod'] : null; 
    $yearOfDeathA = isset($_POST['personA']['yod']) ? $_POST['personA']['yod'] : null; 
    $ageOfDeathB = isset($_POST['personB']['aod']) ? $_POST['personB']['aod'] : null; 
    $yearOfDeathB = isset($_POST['personB']['yod']) ? $_POST['personB']['yod'] : null; 

    if ( empty($ageOfDeathA) || empty($yearOfDeathA) || empty($ageOfDeathB) || empty($yearOfDeathB) ) {
        echo "-1";
        die();
    }

    $firstPerson = (new Person);
    $firstPerson->setProperties([
        'identifier' => 'First Person',
        'ageOfDeath' => $ageOfDeathA,
        'yearOfDeath' => $yearOfDeathA,
    ]);
    if ( !$firstPerson->validate() ) {
        echo $firstPerson->errorMsg . "<br/>";
        echo "<a href='/witch-vs-coder/'>Back To The Last Page</a>";
        die();
    }
    $averageKillCount->push($firstPerson->getKillCount());

    $secondPerson = (new Person);
    $secondPerson->setProperties([
        'identifier' => 'Second Person',
        'ageOfDeath' => $ageOfDeathB,
        'yearOfDeath' => $yearOfDeathB,
    ]);
    if ( !$firstPerson->validate() ) {
        echo $secondPerson->errorMsg . "<br/>";
        echo "<a href='/witch-vs-coder/'>Back To The Last Page</a>";
        die();
    }
    $averageKillCount->push($secondPerson->getKillCount());

    $firstPerson->personInformation();
    $secondPerson->personInformation();
    echo "Average Kill Was: ". $averageKillCount->getAverage();
    echo "</br></br>";
    echo "<a href='/witch-vs-coder/'>Back To The Last Page</a>";
    die();
} else {
    echo "<a href='/witch-vs-coder/'>Back To The Last Page!</a>";
    die();
}

