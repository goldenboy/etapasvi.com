<?php


/**
 * This class defines the structure of the 'alert' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue May  3 10:23:27 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AlertTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AlertTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('alert');
		$this->setPhpName('Alert');
		$this->setClassname('Alert');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'user', 'ID', true, null, null);
		$this->addPrimaryKey('ITEM_TYPE', 'ItemType', 'INTEGER', true, null, null);
		$this->addPrimaryKey('ITEM_ID', 'ItemId', 'INTEGER', true, null, null);
		$this->addPrimaryKey('ITEM_LANG', 'ItemLang', 'VARCHAR', true, 7, null);
		$this->addForeignKey('ITEM_BY_USER', 'ItemByUser', 'INTEGER', 'user', 'ID', false, null, null);
		$this->addPrimaryKey('IS_COMMENT', 'IsComment', 'BOOLEAN', true, null, false);
		$this->addPrimaryKey('STATUS', 'Status', 'INTEGER', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UserRelatedByUserId', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('UserRelatedByItemByUser', 'User', RelationMap::MANY_TO_ONE, array('item_by_user' => 'id', ), null, null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // AlertTableMap
