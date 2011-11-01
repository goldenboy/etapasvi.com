<?php


/**
 * This class defines the structure of the 'news' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Nov  1 06:32:31 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class NewsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.NewsTableMap';

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
		$this->setName('news');
		$this->setPhpName('News');
		$this->setClassname('News');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('DATE', 'Date', 'DATE', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('SHOW', 'Show', 'BOOLEAN', false, null, true);
		$this->addColumn('ORDER', 'Order', 'INTEGER', true, null, null);
		$this->addColumn('IMG', 'Img', 'VARCHAR', false, 255, null);
		$this->addColumn('FULL_PATH', 'FullPath', 'VARCHAR', false, 255, null);
		$this->addColumn('THUMB_PATH', 'ThumbPath', 'VARCHAR', false, 255, null);
		$this->addColumn('ORIGINAL', 'Original', 'LONGVARCHAR', true, null, null);
		$this->addForeignKey('TYPE', 'Type', 'INTEGER', 'newstypes', 'ID', true, null, 1);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Newstypes', 'Newstypes', RelationMap::MANY_TO_ONE, array('type' => 'id', ), null, null);
    $this->addRelation('NewsI18n', 'NewsI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null);
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
			'symfony_timestampable' => array('update_column' => 'updated_at', ),
			'symfony_i18n' => array('i18n_table' => 'news_i18n', ),
		);
	} // getBehaviors()

} // NewsTableMap
