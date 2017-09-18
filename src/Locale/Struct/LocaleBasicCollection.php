<?php declare(strict_types=1);

namespace Shopware\Locale\Struct;

use Shopware\Framework\Struct\Collection;

class LocaleBasicCollection extends Collection
{
    /**
     * @var LocaleBasicStruct[]
     */
    protected $elements = [];

    public function add(LocaleBasicStruct $locale): void
    {
        $key = $this->getKey($locale);
        $this->elements[$key] = $locale;
    }

    public function remove(string $uuid): void
    {
        parent::doRemoveByKey($uuid);
    }

    public function removeElement(LocaleBasicStruct $locale): void
    {
        parent::doRemoveByKey($this->getKey($locale));
    }

    public function exists(LocaleBasicStruct $locale): bool
    {
        return parent::has($this->getKey($locale));
    }

    public function getList(array $uuids): LocaleBasicCollection
    {
        return new self(array_intersect_key($this->elements, array_flip($uuids)));
    }

    public function get(string $uuid): ? LocaleBasicStruct
    {
        if ($this->has($uuid)) {
            return $this->elements[$uuid];
        }

        return null;
    }

    public function getUuids(): array
    {
        return $this->fmap(function (LocaleBasicStruct $locale) {
            return $locale->getUuid();
        });
    }

    protected function getKey(LocaleBasicStruct $element): string
    {
        return $element->getUuid();
    }
}
