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
	 * Key is id
	 * Value is quantity
	 */
	private $items = array();
	/*
	 * Storage class wich implements Store interface
	 */
	private $store;

	public function __construct($id, Store $store)
	{
		$this->id = $id;
		$this->store = $store;
	}
	/*
	 * Gettig a array of items
	 */
	public function all()
	{
		return $this->items;
	}
	/*
	 * Checking a cart for  
	 */
	public function has($id)
	{
		return !is_null($this->items[$id]);
	}

	public function add($id, $quantity, $array)
	{
		
		if($this->has($id)){
			$quantity = array('quantity' =>  $this->items[$id]['quantity'] + $quantity);
			$this->items[$id] = array_merge($quantity, $array);
		} else {
			$quantity = array('quantity' =>  $quantity);
			$this->items[$id] = array_merge($quantity, $array);
		}
	}

	public function remove($id)
	{
		unset($this->items[$id]);
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