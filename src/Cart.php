<?php

namespace Vladk23cm\Cart;

use Vladk23cm\Cart\Storage\Store;

class Cart
{
	/*
	 * Cart id
	 */
	private $id;
	/*
	 * Items
	 * $items[id] => quality
	 */
	private $items = array();
	/*
	 * 
	 */
	private $store;

	public function __construct($id, Store $store)
	{
		$this->id = $id;
		$this->store = $store;
	}

	public function all()
	{
		return $this->items;
	}

	public function has($id)
	{
		return !is_null($this->items[$id]);
	}

	public function add($id, $quality)
	{
		
		if($this->has($id)){
			$this->items[$id] = $this->items[$id] + $quality;
		} else {
			$this->items[$id] = $quality;
		}
	}

	public function update()
	{
		$this->store->put($this->id, $this->items);
	}

	public function restore()
	{
		$this->items = $this->store->get($this->id);
	}
	public function flush()
	{
		$this->items = $this->store->flush($this->id);
	}
}