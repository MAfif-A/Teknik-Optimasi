<?php
class Parameters
{
    const FILE_NAME = 'products.txt';
    const COLUMNS = ['item', 'price'];
    const POPULATION_SIZE = 10;
}
class Catalogue
{

    function createProductColumn($listOfRawProduct){
        foreach (array_keys($listOfRawProduct) as $listOfRawProductKey){
            $listOfRawProduct[Parameters::COLUMNS[$listOfRawProductKey]] = $listOfRawProduct[$listOfRawProductKey];
            unset($listOfRawProduct[$listOfRawProductKey]);
        }
        return $listOfRawProduct;

    }
    function product(){
        $collectionOfListProduct = [];

        $raw_data = file(Parameters::FILE_NAME);
        foreach ($raw_data as $listOfRawProduct){
  
           $collectionOfListProduct[] = $this->createProductColumn(explode(",", $listOfRawProduct));
        }
        return $collectionOfListProduct;
        //foreach ($collectionOfListProduct as $listOfRawProduct){
        //    print_r($listOfRawProduct);
        //    echo '<br>';
        //}
       // return [
       // 'product' => $collectionOfListProduct,
        //'gen_length' => count($collectionOfListProduct)

        //];
    }
}

class Individu
{
    function countNumberOfGen()
    {
        $catalogue = new Catalogue;
        return count($catalogue->product());
    }
    function createRandomIndividu()
    {
        //echo $this->countNumberOfGen();exist();
        for ($i = 0; $i <= $this->countNumberOfGen()-1; $i++){
            $ret[] = rand(0, 1);
        }
        return $ret;
    }
}

class Population//Generator
{
    /*function createIndividu($parameters){
        $catalogue = new Catalogue;
        $lengthOfGen =  $catalogue->product($parameters)['gen_length'];
        for ($i = 0; $i <= $lengthOfGen-1;$i++){
            $ret[] = rand(0, 1);
        }
        return $ret;
    }*/
    function createRandomPopulation(){
        $individu = new Individu;
        for ($i = 0; $i <= Parameters::POPULATION_SIZE-1; $i++){
           $ret[] = $individu->createRandomIndividu();
        }
        /*foreach ($ret as $key => $val){
            print_r($val);
            echo '<br>';
        }*/
        return $ret;
    }
}
class Fitness
{
   /* function selectingItem()
    {
        $catalogue = new Catalogue;
    
    }*/
    function fitnessEvaluation($population)
    {
        //print_r($population);exit;
        $catalogue = new Catalogue;
        foreach ($population as $listOfIndividuKey => $listOfIndividu){
            echo 'Individu-'. $listOfIndividuKey.'<br>';
            foreach ($listOfIndividu as $individuKey => $binaryGen){
                echo $binaryGen. '&nbsp;&nbsp;';
                print_r($catalogue->product()[$individuKey]);
                echo '<br>';
            }
            //print_r($listOfIndividu);
        }
        
    }

}
/*$parameters = [
    'file_name' => 'products.txt',
    'columns' => ['item', 'price'],
    'population_size' => 10
];*/

//$katalog = new Catalogue;
//print_r(
//$katalog -> product($parameters);

$initialPopulation = new Population;//Generator;
$Population = $initialPopulation->createRandomPopulation();
$fitness = new Fitness;
$fitness->fitnessEvaluation($Population);
//print_r($Population);
//$individu = new Individu;
// $individu->createRandomIndividu();