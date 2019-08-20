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
use RestCord\DiscordClient as RestCord;

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

            $restCord = new RestCord(['token' => getenv('DISCORD_BOT_SECRET')]);

	    $user2 = $this->dm->getRepository(DiscordUser::class)->findOneBy(['discordId' => $discordUser->getId()]);
		
	    if (!$user2) {
	      $user2 = new DiscordUser();
	    }

            $user2->setDiscordId($discordUser->getId());
            $user2->setDiscordUsername($discordUser->getUsername());
            $user2->setDiscordDiscriminator($discordUser->getDiscriminator());
            $user2->setDiscordAvatarHash($discordUser->getAvatarHash());
            $user2->setEnabled(1);
            $user2->setRoles($restCord->guild->getGuildMember(['guild.id' => (int)getenv('DISCORD_UAGPMC_GUILD_ID'), 'user.id' => (int)$discordUser->getId()])->roles);
            $this->dm->persist($user2);
            $this->dm->flush();

            return $user2;
        } catch (\Exception $e) {
            //
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
