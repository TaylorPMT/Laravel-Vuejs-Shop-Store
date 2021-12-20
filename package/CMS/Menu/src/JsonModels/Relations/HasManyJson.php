<?php


namespace CMS\Menu\JsonModels\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class HasManyJson extends HasMany
{
    use IsJsonRelation;

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return !is_null($this->getParentKey())
            ? $this->get()
            : $this->related->newCollection();
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        if (static::$constraints) {
            $parentKey = $this->getParentKey();

            if ($this->key) {
                $parentKey = $this->parentKeyToArray($parentKey);
            }

            $this->query->whereJsonContains($this->path, $parentKey);
        }
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param array $models
     * @return void
     */
    public function addEagerConstraints(array $models)
    {
        $parentKeys = $this->getKeys($models, $this->localKey);

        $this->query->where(function (Builder $query) use ($parentKeys) {
            foreach ($parentKeys as $parentKey) {
                if ($this->key) {
                    $parentKey = $this->parentKeyToArray($parentKey);
                }

                $query->orWhereJsonContains($this->path, $parentKey);
            }
        });
    }

    /**
     * Embed a parent key in a nested array.
     *
     * @param mixed $parentKey
     * @return array
     */
    protected function parentKeyToArray($parentKey)
    {
        $keys = explode('->', $this->key);

        foreach (array_reverse($keys) as $key) {
            $parentKey = [$key => $parentKey];
        }

        return [$parentKey];
    }

    /**
     * Match the eagerly loaded results to their many parents.
     *
     * @param array $models
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @param string $relation
     * @param string $type
     * @return array
     */
    protected function matchOneOrMany(array $models, Collection $results, $relation, $type)
    {
        $models = parent::matchOneOrMany(...func_get_args());

        if ($this->key) {
            foreach ($models as $model) {
                $this->hydratePivotRelation($model->$relation, $model);
            }
        }

        return $models;
    }

    /**
     * Build model dictionary keyed by the relation's foreign key.
     *
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @return array
     */
    protected function buildDictionary(Collection $results)
    {
        $foreign = $this->getForeignKeyName();

        $dictionary = [];

        foreach ($results as $result) {
            foreach ($result->{$foreign} as $value) {
                $dictionary[$value][] = $result;
            }
        }

        return $dictionary;
    }


    /**
     * Get the pivot attributes from a model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @return array
     */
    protected function pivotAttributes(Model $model, Model $parent)
    {
        $key = str_replace('->', '.', $this->key);

        $record = collect($model->{$this->getPathName()})
            ->filter(function ($value) use ($key, $parent) {
                return Arr::get($value, $key) == $parent->{$this->localKey};
            })->first();

        return Arr::except($record, $key);
    }

    /**
     * Get the plain path name.
     *
     * @return string
     */
    public function getPathName()
    {
        return last(explode('.', $this->path));
    }
}