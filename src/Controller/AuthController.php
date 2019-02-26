<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2019-02-26
 * Time: 12:47
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AuthController
{
    private $session;

    const RECORDING_FLAG = 1;
    const DOWNLOAD_FLAG = 2;
    const RESERVED1 = 4;
    const RESERVED2 = 8;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function login()
    {

    }

    public function logout()
    {
        $this->session->invalidate();
    }
}