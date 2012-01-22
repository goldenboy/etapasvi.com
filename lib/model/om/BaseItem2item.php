<?php

/**
 * Base class that represents a row from the 'item2item' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 22 05:53:03 2012
 *
 * @package    lib.model.om
 */
abstract class BaseItem2item extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        Item2itemPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the item1_id field.
	 * @var        int
	 */
	protected $item1_id;

	/**
	 * The value for the item1_type field.
	 * @var        int
	 */
	protected $item1_type;

	/**
	 * The value for the item2_id field.
	 * @var        int
	 */
	protected $item2_id;

	/**
	 * The value for the item2_type field.
	 * @var        int
	 */
	protected $item2_type;

	/**
	 * @var        Itemtypes
	 */
	protected $aItemtypesRelatedByItem1Type;

	/**
	 * @var        Itemtypes
	 */
	protected $aItemtypesRelatedByItem2Type;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'Item2itemPeer';

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [item1_id] column value.
	 * 
	 * @return     int
	 */
	public function getItem1Id()
	{
		return $this->item1_id;
	}

	/**
	 * Get the [item1_type] column value.
	 * 
	 * @return     int
	 */
	public function getItem1Type()
	{
		return $this->item1_type;
	}

	/**
	 * Get the [item2_id] column value.
	 * 
	 * @return     int
	 */
	public function getItem2Id()
	{
		return $this->item2_id;
	}

	/**
	 * Get the [item2_type] column value.
	 * 
	 * @return     int
	 */
	public function getItem2Type()
	{
		return $this->item2_type;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item2item The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Item2itemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [item1_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item2item The current object (for fluent API support)
	 */
	public function setItem1Id($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->item1_id !== $v) {
			$this->item1_id = $v;
			$this->modifiedColumns[] = Item2itemPeer::ITEM1_ID;
		}

		return $this;
	} // setItem1Id()

	/**
	 * Set the value of [item1_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Item2item The current object (for fluent API support)
	 */
	public function setItem1Type($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->item1_type !== $v) {
			$this->item1_type = $v;
			$this->modifiedColumns[] = Item2itemPeer::ITEM1_TYPE;
		}

		if ($this->aItemtypesRelatedByItem1Type !== null && $this->aItemtypesRelatedByItem1Type->getId() !== $v) {
			$this->aItemtypesRelatedByItem1Type = null;
		}

		return $this;
	} // setItem1Type()

	/**
	 * Set the value of [item2_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item2item The current object (for fluent API support)
	 */
	public function setItem2Id($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->item2_id !== $v) {
			$this->item2_id = $v;
			$this->modifiedColumns[] = Item2itemPeer::ITEM2_ID;
		}

		return $this;
	} // setItem2Id()

	/**
	 * Set the value of [item2_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Item2item The current object (for fluent API support)
	 */
	public function setItem2Type($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->item2_type !== $v) {
			$this->item2_type = $v;
			$this->modifiedColumns[] = Item2itemPeer::ITEM2_TYPE;
		}

		if ($this->aItemtypesRelatedByItem2Type !== null && $this->aItemtypesRelatedByItem2Type->getId() !== $v) {
			$this->aItemtypesRelatedByItem2Type = null;
		}

		return $this;
	} // setItem2Type()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->item1_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->item1_type = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->item2_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->item2_type = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = Item2itemPeer::NUM_COLUMNS - Item2itemPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Item2item object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aItemtypesRelatedByItem1Type !== null && $this->item1_type !== $this->aItemtypesRelatedByItem1Type->getId()) {
			$this->aItemtypesRelatedByItem1Type = null;
		}
		if ($this->aItemtypesRelatedByItem2Type !== null && $this->item2_type !== $this->aItemtypesRelatedByItem2Type->getId()) {
			$this->aItemtypesRelatedByItem2Type = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Item2itemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = Item2itemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aItemtypesRelatedByItem1Type = null;
			$this->aItemtypesRelatedByItem2Type = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Item2itemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseItem2item:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				Item2itemPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseItem2item:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Item2itemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseItem2item:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseItem2item:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				Item2itemPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aItemtypesRelatedByItem1Type !== null) {
				if ($this->aItemtypesRelatedByItem1Type->isModified() || $this->aItemtypesRelatedByItem1Type->isNew()) {
					$affectedRows += $this->aItemtypesRelatedByItem1Type->save($con);
				}
				$this->setItemtypesRelatedByItem1Type($this->aItemtypesRelatedByItem1Type);
			}

			if ($this->aItemtypesRelatedByItem2Type !== null) {
				if ($this->aItemtypesRelatedByItem2Type->isModified() || $this->aItemtypesRelatedByItem2Type->isNew()) {
					$affectedRows += $this->aItemtypesRelatedByItem2Type->save($con);
				}
				$this->setItemtypesRelatedByItem2Type($this->aItemtypesRelatedByItem2Type);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = Item2itemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Item2itemPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += Item2itemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aItemtypesRelatedByItem1Type !== null) {
				if (!$this->aItemtypesRelatedByItem1Type->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItemtypesRelatedByItem1Type->getValidationFailures());
				}
			}

			if ($this->aItemtypesRelatedByItem2Type !== null) {
				if (!$this->aItemtypesRelatedByItem2Type->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItemtypesRelatedByItem2Type->getValidationFailures());
				}
			}


			if (($retval = Item2itemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Item2itemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getItem1Id();
				break;
			case 2:
				return $this->getItem1Type();
				break;
			case 3:
				return $this->getItem2Id();
				break;
			case 4:
				return $this->getItem2Type();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = Item2itemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getItem1Id(),
			$keys[2] => $this->getItem1Type(),
			$keys[3] => $this->getItem2Id(),
			$keys[4] => $this->getItem2Type(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Item2itemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setItem1Id($value);
				break;
			case 2:
				$this->setItem1Type($value);
				break;
			case 3:
				$this->setItem2Id($value);
				break;
			case 4:
				$this->setItem2Type($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Item2itemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setItem1Id($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setItem1Type($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setItem2Id($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setItem2Type($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(Item2itemPeer::DATABASE_NAME);

		if ($this->isColumnModified(Item2itemPeer::ID)) $criteria->add(Item2itemPeer::ID, $this->id);
		if ($this->isColumnModified(Item2itemPeer::ITEM1_ID)) $criteria->add(Item2itemPeer::ITEM1_ID, $this->item1_id);
		if ($this->isColumnModified(Item2itemPeer::ITEM1_TYPE)) $criteria->add(Item2itemPeer::ITEM1_TYPE, $this->item1_type);
		if ($this->isColumnModified(Item2itemPeer::ITEM2_ID)) $criteria->add(Item2itemPeer::ITEM2_ID, $this->item2_id);
		if ($this->isColumnModified(Item2itemPeer::ITEM2_TYPE)) $criteria->add(Item2itemPeer::ITEM2_TYPE, $this->item2_type);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Item2itemPeer::DATABASE_NAME);

		$criteria->add(Item2itemPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Item2item (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setItem1Id($this->item1_id);

		$copyObj->setItem1Type($this->item1_type);

		$copyObj->setItem2Id($this->item2_id);

		$copyObj->setItem2Type($this->item2_type);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Item2item Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     Item2itemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new Item2itemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Itemtypes object.
	 *
	 * @param      Itemtypes $v
	 * @return     Item2item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setItemtypesRelatedByItem1Type(Itemtypes $v = null)
	{
		if ($v === null) {
			$this->setItem1Type(NULL);
		} else {
			$this->setItem1Type($v->getId());
		}

		$this->aItemtypesRelatedByItem1Type = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Itemtypes object, it will not be re-added.
		if ($v !== null) {
			$v->addItem2itemRelatedByItem1Type($this);
		}

		return $this;
	}


	/**
	 * Get the associated Itemtypes object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Itemtypes The associated Itemtypes object.
	 * @throws     PropelException
	 */
	public function getItemtypesRelatedByItem1Type(PropelPDO $con = null)
	{
		if ($this->aItemtypesRelatedByItem1Type === null && ($this->item1_type !== null)) {
			$this->aItemtypesRelatedByItem1Type = ItemtypesPeer::retrieveByPk($this->item1_type);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aItemtypesRelatedByItem1Type->addItem2itemsRelatedByItem1Type($this);
			 */
		}
		return $this->aItemtypesRelatedByItem1Type;
	}

	/**
	 * Declares an association between this object and a Itemtypes object.
	 *
	 * @param      Itemtypes $v
	 * @return     Item2item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setItemtypesRelatedByItem2Type(Itemtypes $v = null)
	{
		if ($v === null) {
			$this->setItem2Type(NULL);
		} else {
			$this->setItem2Type($v->getId());
		}

		$this->aItemtypesRelatedByItem2Type = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Itemtypes object, it will not be re-added.
		if ($v !== null) {
			$v->addItem2itemRelatedByItem2Type($this);
		}

		return $this;
	}


	/**
	 * Get the associated Itemtypes object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Itemtypes The associated Itemtypes object.
	 * @throws     PropelException
	 */
	public function getItemtypesRelatedByItem2Type(PropelPDO $con = null)
	{
		if ($this->aItemtypesRelatedByItem2Type === null && ($this->item2_type !== null)) {
			$this->aItemtypesRelatedByItem2Type = ItemtypesPeer::retrieveByPk($this->item2_type);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aItemtypesRelatedByItem2Type->addItem2itemsRelatedByItem2Type($this);
			 */
		}
		return $this->aItemtypesRelatedByItem2Type;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aItemtypesRelatedByItem1Type = null;
			$this->aItemtypesRelatedByItem2Type = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseItem2item:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseItem2item::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseItem2item
