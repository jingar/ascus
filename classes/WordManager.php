<?php

/*
 * To change this license headetr, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expertise
 *
 * @author Saad Arif 
 */
class WordManager {

    private $_database_connection;

    public function __construct() {
        $this->_database_connection = Database::getInstance();
    }

    public function findAnyLinkedWord($word)
    {
    	$query = "SELECT dw.lemma AS lemma FROM sensesXsemlinksXsenses AS l 
    	LEFT JOIN words AS sw ON l.swordid = sw.wordid LEFT JOIN words AS dw 
    	ON l.dwordid = dw.wordid LEFT JOIN linktypes USING (linkid) 
    	WHERE sw.lemma = ? AND link <> 'instance hyponym'
    	ORDER BY linkid,ssensenum";
    	$this->_database_connection->query($query,array($word));
    	return $this->_database_connection->getResults();

    }

    public function findSynonyms($word)
    {
    	$query = "SELECT lemma FROM wordsXsensesXsynsets 
    	WHERE synsetid IN (SELECT synsetid FROM wordsXsensesXsynsets 
    		WHERE lemma = ?) AND lemma <> ? 
    		ORDER BY synsetid";
    	$this->_database_connection->query($query,array($word,$word));
    	return $this->_database_connection->getResults();
    }

    public function findSynonymsArray($words)
    {
    	$result = array();
    	foreach ($words as $word) {
    		$result = array_merge($result,$this->findSynonyms($word));
    	}
    	return $result;
    }

    public function findAnyLinkedWordArray($words)
    {
    	$result = array();
    	foreach ($words as $word) {
    		$result = array_merge($result,$this->findAnyLinkedWord($word));
    	}
    	return $result;
    }
}


