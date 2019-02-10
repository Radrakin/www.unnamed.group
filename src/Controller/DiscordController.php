<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;

class DiscordController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/discord", name="connect_discord_start")
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        // will redirect to discord!
        return $clientRegistry
          ->getClient('discord') // key used in config/packages/knpu_oauth2_client.yaml
          ->redirect([
    	        'identify' // the scopes you want to access
          ]);
  	}

    /**
     * After going to discord, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     *
     * @Route("/connect/discord/check", name="connect_discord_check")
     */
    public function connectCheckAction()
    {
      return $this->redirectToRoute('home');
    }
}
