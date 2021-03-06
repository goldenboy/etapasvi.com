<?php


/**
 * This class defines the structure of the 'item2item' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Jul  3 11:08:01 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class Item2itemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.Item2itemTableMap';

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
		$this->setName('item2item');
		$this->setPhpName('Item2item');
		$this->setClassname('Item2item');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ITEM1_ID', 'Item1Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ITEM1_TYPE', 'Item1Type', 'INTEGER', 'itemtypes', 'ID', true, null, null);
		$this->addColumn('ITEM2_ID', 'Item2Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ITEM2_TYPE', 'Item2Type', 'INTEGER', 'itemtypes', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ItemtypesRelatedByItem1Type', 'Itemtypes', RelationMap::MANY_TO_ONE, array('item1_type' => 'id', ), null, null);
    $this->addRelation('ItemtypesRelatedByItem2Type', 'Itemtypes', RelationMap::MANY_TO_ONE, array('item2_type' => 'id', ), null, null);
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
		);
	} // getBehaviors()

} // Item2itemTableMap
