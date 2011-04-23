<?php

class Newstypes extends BaseNewstypes
{
  public function __toString() {
    return $this->getName();
  }
}
