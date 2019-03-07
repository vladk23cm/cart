<?php

namespace  Vladk23cm\Cart\Storage;

class SessionStore implements Store
{
    /**
     * Retrieve the saved state for a cart instance.
     *
     * @param string $cartId
     *
     * @return string
     */
    public function get($cartId)
    {
        return $_SESSION[$cartId];
    }

    /**
     * Save the state for a cart instance.
     *
     * @param string $cartId
     * @param string $data
     */
    public function put($cartId, $data)
    {
        $_SESSION[$cartId] = $data;
    }

    /**
     * Flush the saved state for a cart instance.
     *
     * @param string $cartId
     */
    public function flush($cartId)
    {
        unset($_SESSION[$cartId]);
    }
}
