<?php


namespace CMS\Menu\JsonModels;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use CMS\Menu\JsonModels\Relations\HasManyJson;

trait HasJsonRelationships
{
    /**
     * Get an attribute from the model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $attribute = preg_split('/(->|\[\])/', $key)[0];

        if (array_key_exists($attribute, $this->attributes)) {
            return $this->getAttributeValue($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param string $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        if (Str::contains($key, '->')) {
            [$key, $path] = explode('->', $key, 2);

            if (substr($key, -2) === '[]') {
                $key = substr($key, 0, -2);

                $path = '*.' . $path;
            }

            $path = str_replace(['->', '[]'], ['.', '.*'], $path);

            return data_get($this->getAttributeValue($key), $path);
        }

        return parent::getAttributeValue($key);
    }

    /**
     * Define a one-to-many JSON relationship.
     *
     * @param string $related
     * @param string $foreignKey
     * @param string $localKey
     * @return HasManyJson
     */
    public function hasManyJson($related, $foreignKey, $localKey = null)
    {
        /** @var \Illuminate\Database\Eloquent\Model $instance */
        $instance = $this->newRelatedInstance($related);

        $localKey = $localKey ?: $this->getKeyName();

        return $this->newHasManyJson(
            $instance->newQuery(),
            $this,
            $instance->getTable() . '.' . $foreignKey,
            $localKey
        );
    }

    /**
     * Instantiate a new HasManyJson relationship.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $foreignKey
     * @param string $localKey
     * @return HasManyJson
     */
    protected function newHasManyJson(Builder $query, Model $parent, $foreignKey, $localKey)
    {
        return new HasManyJson($query, $parent, $foreignKey, $localKey);
    }
}