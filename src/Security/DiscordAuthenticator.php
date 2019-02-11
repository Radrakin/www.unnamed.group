<?php

namespace App\Security;

use App\Document\DiscordUser;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use KnpU\OAuth2ClientBundle\Client\Provider\DiscordClient;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class DiscordAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;

    public function __construct(ClientRegistry $clientRegistry, DocumentManager $dm)
    {
        $this->clientRegistry = $clientRegistry;
        $this->dm = $dm;
    }

    public function supports(Request $request)
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_discord_check';
    }

    public function getCredentials(Request $request)
    {
        // this method is only called if supports() returns true

        // For Symfony lower than 3.4 the supports method need to be called manually here:
        // if (!$this->supports($request)) {
        //     return null;
        // }

        return $this->fetchAccessToken($this->getDiscordClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            /** @var DiscordUser $discordUser */
            $discordUser = $this->getDiscordClient()
                ->fetchUserFromToken($credentials);

            $discordId = $discordUser->getId();

            // 1) have they logged in with Discord before? Easy!
            $existingUser = $this->dm->getRepository(DiscordUser::class)
                ->findOneBy(['discordId' => $discordUser->getId()]);
            if ($existingUser) {
                return $existingUser;
            }

            // 2) do we have a matching user by email?
            $user = $this->dm->getRepository(DiscordUser::class)
                        ->findOneBy(['discordId' => $discordId]);

            // 3) Maybe you just want to "register" them by creating
            // a User object
            if (!$user) {
                $user2 = new DiscordUser();
            } else {
                $user2 = $user;
            }

            $user2->setDiscordId($discordUser->getId());
            $user2->setDiscordUsername($discordUser->getUsername());
            $user2->setDiscordDiscriminator($discordUser->getDiscriminator());
            $user2->setDiscordAvatarHash($discordUser->getAvatarHash());
            $user2->setEnabled(1);
            $this->dm->persist($user2);
            $this->dm->flush();

            return $user2;
        } catch (\Exception $e) {
            file_put_contents("gs://zeue-log-dump/meme.txt", "meme");
            file_put_contents("gs://zeue-log-dump/ohshit.log", $e);
        }


    }

    /**
     * @return DiscordClient
     */
    private function getDiscordClient()
    {
        return $this->clientRegistry
            ->getClient('discord');
	}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
		$message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse(
            '/connect/', // might be the site, where users choose their oauth provider
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }

    // ...
}
