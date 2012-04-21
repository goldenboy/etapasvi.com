<?php

/**
 * This class is the Propel implementation of sfPropelPager.  It interacts with the propel record set and
 * manages criteria.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Igor Brovchenko
 */
class sfPropelPagerI18n extends sfPropelPager
{

  /**
    * Constructor.
    *
    * @param string $class
    * @param int $maxPerPage
    * @param string $culture
    * @param string $joinField default value 'ID'
    * @return sfPropelPagerI18n
    */
  public function __construct($class, $maxPerPage = 10, $culture =  null, $joinField = 'ID')
  {
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }

    $this->joinField       = $joinField;
    $this->currentCulture  = $culture;

    parent::__construct($class, $maxPerPage);

    $this->setPeerMethod('doSelectWithI18n');
    //$this->setPeerCountMethod('doCountWithI18n');
  }

  /**
   * Set Criteria for Pager.
   *
   * @param Criteria $c
   */
  public function setCriteriaI18n($c)
  {
    $this->criteria = $c;
	// saynt2day
	// В Propel 1.4: [wrapped: SQLSTATE[42000]: Syntax error or access violation: 1066 Not unique table/alias...
	// http://oldforum.symfony-project.org/index.php/m/68868/
	
    /*$this->criteria->addJoin(
      constant($this->getClass() . 'Peer::' . $this->joinField),
      constant($this->getClass() . 'I18nPeer::' . $this->joinField),
      Criteria::INNER_JOIN
    );*/
    
    /*
    $this->criteria->addJoin(
      constant($this->getClass() . 'Peer::' . $this->joinField),
      constant($this->getClass() . 'I18nPeer::' . $this->joinField)
    );*/
    
    //$this->criteria->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
    
    //$c->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
    //$this->criteria->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
    
    // current culture or withour corresponding record in I18n table
    //$c_all_cultures = $this->criteria->getNewCriterion(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
    //$c_all_cultures->addOr(  $c->getNewCriterion(constant($this->getClass() . 'I18nPeer::CULTURE'), $default_culture) );
	//$this->criteria->add($c_all_cultures);

    $this->criteria->addGroupByColumn(constant($this->getClass() . 'Peer::' . $this->joinField));
  }

  /**
   * Returns the result of Pager.
   *
   */
  public function getResults()
  {
    $c = $this->getCriteria();

    return call_user_func(array($this->getClassPeer(), $this->getPeerMethod()), $c, $this->currentCulture);
  }
}
