<?php
class Country{
	var $Code;
	var $Name;
	var $Continent;
	var $Region;
	var $SurfaceArea;
	var $IndepYear;
	var $Population;
	var $LifeExpectancy;
	var $GNP;
	var $GNPOld;
	var $LocalName;
	var $GovernmentForm;
	var $HeadOfState;
	var $Capital;
	var $Code2;
	function country(){
		//constructor vacio
	}
	function setCode($Code){
		$this->Code = $Code;
	}
	function getCode(){
		return $this->Code;
	}
	function setName($Name){
		$this->Name = $Name;
	}
	function getName(){
		return $this->Name;
	}
	function setContinent($Continent){
		$this->Continent = $Continent;
	}
	function getContinent(){
		return $this->Continent;
	}
	function setRegion($Region){
		$this->Region = $Region;
	}
	function getRegion(){
		return $this->Region;
	}
	function setSurfaceArea($SurfaceArea){
		$this->SurfaceArea = $SurfaceArea;
	}
	function getSurfaceArea(){
		return $this->SurfaceArea;
	}
	function setIndepYear($IndepYear){
		$this->IndepYear = $IndepYear;
	}
	function getIndepYear(){
		return $this->IndepYear;
	}
	function setPopulation($Population){
		$this->Population = $Population;
	}
	function getPopulation(){
		return $this->Population;
	}
	function setLifeExpectancy($LifeExpectancy){
		$this->LifeExpectancy = $LifeExpectancy;
	}
	function getLifeExpectancy(){
		return $this->LifeExpectancy;
	}
	function setGNP($GNP){
		$this->GNP = $GNP;
	}
	function getGNP(){
		return $this->GNP;
	}
	function setGNPOld($GNPOld){
		$this->GNPOld = $GNPOld;
	}
	function getGNPOld(){
		return $this->GNPOld;
	}
	function setLocalName($LocalName){
		$this->LocalName = $LocalName;
	}
	function getLocalName(){
		return $this->LocalName;
	}
	function setGovernmentForm($GovernmentForm){
		$this->GovernmentForm = $GovernmentForm;
	}
	function getGovernmentForm(){
		return $this->GovernmentForm;
	}
	function setHeadOfState($HeadOfState){
		$this->HeadOfState = $HeadOfState;
	}
	function getHeadOfState(){
		return $this->HeadOfState;
	}
	function setCapital($Capital){
		$this->Capital = $Capital;
	}
	function getCapital(){
		return $this->Capital;
	}
	function setCode2($Code2){
		$this->Code2 = $Code2;
	}
	function getCode2(){
		return $this->Code2;
	}
}
?>