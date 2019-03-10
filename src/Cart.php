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
	 * Value is quality
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

	public function add($id, $quality, $array)
	{
		
		if($this->has($id)){
			$quality = array('quality' =>  $this->items[$id]['quality'] + $quality);
			$this->items[$id] = array_merge($quality, $array);
		} else {
			$quality = array('quality' =>  $quality);
			$this->items[$id] = array_merge($quality, $array);
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