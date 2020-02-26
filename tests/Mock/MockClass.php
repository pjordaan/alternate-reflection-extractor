<?php


namespace Pjordaan\AlternateReflectionExtractor\Mock;

class MockClass
{
    private $publicValue;

    private $protectedValue;

    private $privateValue;

    public function setPublicValue(string $value)
    {
        $this->publicValue = $value;
    }

    public function getPublicValue(): ?string
    {
        return $this->publicValue;
    }

    protected function getProtectedValue(): ?string
    {
        return $this->protectedValue;
    }

    protected function setProtectedValue($protectedValue)
    {
        $this->protectedValue = $protectedValue;
    }

    private function getPrivateValue(): ?string
    {
        return $this->privateValue;
    }

    private function setPrivateValue(string $privateValue)
    {
        $this->privateValue = $privateValue;
    }

    public function setSetterOnly(string $value)
    {
        $this->setPrivateValue($value);
    }

    protected function getSetterOnly(): ?string
    {
        return $this->getPrivateValue();
    }

    protected function setGetterOnly(string $value)
    {
        $this->setProtectedValue($value);
    }

    public function getGetterOnly(): ?string
    {
        return $this->getProtectedValue();
    }
}
