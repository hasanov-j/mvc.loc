<?php

namespace App\Service\Auth;

use App\Components\Cookie;
use App\Components\Request;
use App\Exception\ModelException\ModelNotFoundException;
use App\Models\SessionManager;
use App\Models\User;
use App\Service\Auth\Exception\Web\AuthWebForbiddenException;
use App\Service\Auth\Exception\Web\AuthWebNotFoundException;
use Ramsey\Uuid\Uuid;

class WebAuthService implements AuthServiceInterface
{
    public function isAuth(): bool
    {
        if(array_key_exists('SESSION_UUID',$_COOKIE)){
            $sessionUuid = Cookie::get(name: 'SESSION_UUID');
            try {
                $session = SessionManager::getOneByUuid($sessionUuid);
            } catch (ModelNotFoundException $exception){
                return false;
            }
            return $session['is_active']?true:false;
        }
        return false;

    }

    public function isAuthCheck(): void
    {
        if(array_key_exists('SESSION_UUID',$_COOKIE)){
            $sessionUuid = Cookie::get(name: 'SESSION_UUID');
            try {
                $session = SessionManager::getOneByUuid($sessionUuid);
            } catch (ModelNotFoundException $exception) {
                throw new AuthWebNotFoundException($exception->getMessage());
            }
            if (!$session['is_active']) {
                throw new AuthWebForbiddenException("Current session is not active");
            }
        } else {
            throw new AuthWebForbiddenException("User are not registred");
        }

    }

    public function findAuthUser(): array
    {
        $sessionUuid = Cookie::get(name: 'SESSION_UUID');

        try {
            $session = User::getOneWithSessionUuid($sessionUuid);
        } catch (ModelNotFoundException $exception) {
            throw new AuthWebNotFoundException($exception->getMessage());
        }

        return $session;
    }

    public function login(string $email, string $password): array
    {
        $message = "Email or password is wrong.";

        try {
            $user = User::getOneByEmail($email);

        } catch (ModelNotFoundException $exception) {
            throw new AuthWebNotFoundException($message);
        }

        if ($password == $user['password']) {

            $clientIpAddress = Request::getClientIp();

            $sessionManager = SessionManager::findFirstActiveByClientIp(
                userId: $user['id'],
                clientIpAddress: $clientIpAddress
            );

            if($sessionManager == null){

                $uuid = Uuid::uuid4()->toString();

                SessionManager::create(
                    idUsers: $user['id'],
                    ip: $clientIpAddress,
                    sessionUuid: $uuid
                );

                Cookie::set(
                    name: 'SESSION_UUID',
                    value: $uuid,
                    timeInSeconds: 86400 * 30
                );

            }else{

                Cookie::set(
                    name: 'SESSION_UUID',
                    value: $sessionManager['session_uuid'],
                    timeInSeconds: 86400 * 30
                );
            }

            return $user;

        } else {
            throw new AuthWebForbiddenException($message);
        }

    }

    public function logout()
    {
        $sessionUuid = Cookie::get(name: 'SESSION_UUID');
        SessionManager::destroy($sessionUuid);
        Cookie::remove(name: 'SESSION_UUID');
    }
}