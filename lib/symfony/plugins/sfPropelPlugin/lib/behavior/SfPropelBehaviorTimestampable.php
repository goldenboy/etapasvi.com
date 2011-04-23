<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A timestampable implementation BC with symfony <= 1.2.
 *
 * @package     sfPropelPlugin
 * @subpackage  behavior
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: SfPropelBehaviorTimestampable.php 23310 2009-10-24 15:27:41Z Kris.Wallsmith $
 */
class SfPropelBehaviorTimestampable extends SfPropelBehaviorBase
{
  protected $parameters = array(
    'create_column' => null,
    'update_column' => null,
  );

  public function preInsert()
  {
    if ($this->isDisabled())
    {
      return;
    }

    if ($column = $this->getParameter('create_column'))
    {
      return <<<EOF
if (!\$this->isColumnModified({$this->getTable()->getColumn($column)->getConstantName()}))
{
  \$this->set{$this->getTable()->getColumn($column)->getPhpName()}(time());
}

EOF;
    }
  }

  public function preSave()
  {
    if ($this->isDisabled())
    {
      return;
    }

    // saynt2day
    // Добавить поле updated_at в основной объект и в i18n нельзя:
    // Fatal error: Cannot redeclare BaseNews::getUpdatedAt() in /home/saynt2day20/etapasvi.com/lib/model/om/BaseNews.php on line 1885
    // поэтому добавлен updated_at_extra
    //if ($column = $this->getParameter('update_column'))
    if ( ($column = $this->getParameter('update_column')) || ($column = $this->getParameter('update_column_extra')))
    {   	
      return <<<EOF
if (\$this->isModified() && !\$this->isColumnModified({$this->getTable()->getColumn($column)->getConstantName()}))
{
  \$this->set{$this->getTable()->getColumn($column)->getPhpName()}(time());
}
EOF;
    }
    
  }
}
