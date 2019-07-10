<?php

namespace Krisell\CosmosCacheDriver;

use Illuminate\Cache\DatabaseStore;

class CosmosStore extends DatabaseStore
{
    public function put($key, $value, $seconds)
    {
        $this->table()->where('key', $this->prefix.$key)->update([
            'value' => serialize($value),
            'expiration' => $this->getTime() + (int) ($seconds),
            'ttl' => (int) ($seconds),
        ], ['upsert' => true]);
    }

    protected function incrementOrDecrement($key, $value, \Closure $callback)
    {
        $prefixed = $this->prefix.$key;
        $cache = $this->table()->where('key', $prefixed)->lockForUpdate()->first();
        if (is_null($cache)) {
            return false;
        }
        if (is_array($cache)) {
            $cache = (object) $cache;
        }
        $current = unserialize($cache->value);
        $new = $callback((int) $current, $value);
        if (! is_numeric($current)) {
            return false;
        }
        $this->table()->where('key', $prefixed)->update([
            'value' => serialize($new),
        ]);

        return $new;
    }
}
