<?php


/**
 * This class defines the structure of the 'phpb7d3x_users' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Mar 14 05:57:47 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class Phpb7d3xUsersTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.Phpb7d3xUsersTableMap';

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
		$this->setName('phpb7d3x_users');
		$this->setPhpName('Phpb7d3xUsers');
		$this->setClassname('Phpb7d3xUsers');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('USER_ID', 'UserId', 'INTEGER', true, null, null);
		$this->addColumn('USER_TYPE', 'UserType', 'TINYINT', false, null, null);
		$this->addColumn('GROUP_ID', 'GroupId', 'INTEGER', false, null, null);
		$this->addColumn('USER_PERMISSIONS', 'UserPermissions', 'LONGVARCHAR', false, null, null);
		$this->addColumn('USER_PERM_FROM', 'UserPermFrom', 'INTEGER', false, null, null);
		$this->addColumn('USER_IP', 'UserIp', 'VARCHAR', false, 40, null);
		$this->addColumn('USER_REGDATE', 'UserRegdate', 'INTEGER', false, null, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', false, 255, null);
		$this->addColumn('USERNAME_CLEAN', 'UsernameClean', 'VARCHAR', false, 255, null);
		$this->addColumn('USER_PASSWORD', 'UserPassword', 'VARCHAR', false, 40, null);
		$this->addColumn('USER_EMAIL', 'UserEmail', 'VARCHAR', false, 100, null);
		$this->addColumn('USER_EMAIL_HASH', 'UserEmailHash', 'BIGINT', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // Phpb7d3xUsersTableMap
