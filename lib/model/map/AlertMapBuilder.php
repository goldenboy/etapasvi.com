<?php


/**
 * This class adds structure of 'alert' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Mon Feb 28 06:46:52 2011
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AlertMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AlertMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(AlertPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AlertPeer::TABLE_NAME);
		$tMap->setPhpName('Alert');
		$tMap->setClassname('Alert');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'user', 'ID', true, null);

		$tMap->addPrimaryKey('ITEM_TYPE', 'ItemType', 'INTEGER', true, null);

		$tMap->addPrimaryKey('ITEM_ID', 'ItemId', 'INTEGER', true, null);

		$tMap->addPrimaryKey('ITEM_LANG', 'ItemLang', 'VARCHAR', true, 7);

		$tMap->addForeignKey('ITEM_BY_USER', 'ItemByUser', 'INTEGER', 'user', 'ID', false, null);

		$tMap->addPrimaryKey('IS_COMMENT', 'IsComment', 'BOOLEAN', true, null);

		$tMap->addPrimaryKey('STATUS', 'Status', 'INTEGER', true, null);

	} // doBuild()

} // AlertMapBuilder
