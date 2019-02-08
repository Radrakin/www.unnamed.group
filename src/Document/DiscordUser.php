<?php

namespace App\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="users")
 * @MongoDBUnique(fields="discordId")
 */
class DiscordUser extends BaseUser
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $discordId;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $discordUsername;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $discordDiscriminator;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $discordAvatarHash;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId($discordId): self
    {
        $this->discordId = $discordId;

        return $this;
    }

    public function getDiscordUsername(): ?string
    {
        return $this->discordUsername;
    }

    public function setDiscordUsername($discordUsername): self
    {
        $this->discordUsername = $discordUsername;

        return $this;
    }

    public function getDiscordDiscriminator(): ?string
    {
        return $this->discordDiscriminator;
    }

    public function setDiscordDiscriminator($discordDiscriminator): self
    {
        $this->discordDiscriminator = $discordDiscriminator;

        return $this;
    }

    public function getDiscordAvatarHash(): ?string
    {
        return $this->discordAvatarHash;
    }

    public function setDiscordAvatarHash($discordAvatarHash): self
    {
        $this->discordAvatarHash = $discordAvatarHash;

        return $this;
    }
}
