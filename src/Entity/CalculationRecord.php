<?php
declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\CalculationOperation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class CalculationRecord
{
    /**
     * Internal ID
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=3, options={"fixed" = true})
     *
     * @Assert\NotBlank
     */
    private string $calculationOperation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private string $numberA;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private string $numberB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $resultValue = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     *
     * @Assert\NotNull()
     * @Assert\LessThanOrEqual("NOW")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * Should be null if no updates were made
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     *
     * @Assert\LessThanOrEqual("NOW")
     */
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalculationOperation(): CalculationOperation
    {
        return new CalculationOperation($this->calculationOperation);
    }

    public function getNumberA(): string
    {
        return $this->numberA;
    }

    public function getNumberB(): string
    {
        return $this->numberB;
    }

    public function getResultValue(): ?string
    {
        return $this->resultValue;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setCalculationOperation(CalculationOperation $calculationOperation): void
    {
        $this->calculationOperation = $calculationOperation->getValue();
    }

    public function setNumberA(string $value): void
    {
        $this->numberA = $value;
    }

    public function setNumberB(string $value): void
    {
        $this->numberB = $value;
    }

    public function setResultValue(string $value): void
    {
        $this->resultValue = $value;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
