<?php


namespace Acme\MyBundle\Api;

use Swagger\Server\Api\UserApiInterface;
use Swagger\Server\Api\Swagger;
use Swagger\Server\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class UserApi extends Controller implements UserApiInterface{

    protected $container;
    /**
     * @param ContainerInterface|NULL $container
     */
    public function setContainer(
        ContainerInterface $container = NULL
    )
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Operation createUser
     *
     * Create user
     *
     * @param  Swagger\Server\Model\User $body Created user object (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function createUser(User $body, &$responseCode, array &$responseHeaders)
    {
        $user = new \Acme\MyBundle\Entity\User();
        $user->setUsername($body->getUsername());
        $user->setFirstname($body->getFirstname());
        $user->setName($body->getName());
        $user->setAddress($body->getAddress());
        $user->setZip($body->getZip());
        $user->setCity($body->getCity());
        $user->setEmail($body->getEmail());
        $user->setCoordinates($body->getCoordinates());
        $user->setPassword(password_hash($body->getPassword(), PASSWORD_DEFAULT));
        $user->setPhone($body->getPhone());
        $user->setForgotPw($body->getForgotPw());
        $user->setForgotPwTime($body->getForgotPwTime());

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return;

    }


    /**
     * Operation deleteUser
     *
     * Delete user
     *
     * @param  string $username The name that needs to be deleted (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function deleteUser($username, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyBundle:User')->findBy(
            array('username' => $username)
        );

        $user = $users[0];

        $em->remove($user);
        $em->flush();
        return;
    }

    /**
     * Operation getUserByID
     *
     * Get user by user ID
     *
     * @param  integer $userid The id that needs to be fetched. (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\User[]
     *
     */
    public function getUserByID($userid, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyBundle:User')->findBy(
            array('id' => $userid)
        );


        $body = $users[0];

        $user = new User();
        $user->setId($body->getId());
        $user->setUsername($body->getUsername());
        $user->setFirstname($body->getFirstname());
        $user->setName($body->getName());
        $user->setAddress($body->getAddress());
        $user->setZip($body->getZip());
        $user->setCity($body->getCity());
        $user->setEmail($body->getEmail());
        $user->setCoordinates($body->getCoordinates());
        $user->setPassword($body->getPassword());
        $user->setPhone($body->getPhone());
        $user->setForgotPw($body->getForgotPw());
        $user->setForgotPwTime($body->getForgotPwTime());

        return $user;

    }

    /**
     * Operation getUserByName
     *
     * Get user by user name
     *
     * @param  string $username The name that needs to be fetched. (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\User[]
     *
     */
    public function getUserByName($username, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyBundle:User')->findBy(
            array('username' => $username)
        );


        $body = $users[0];

        $user = new User();
        $user->setId($body->getId());
        $user->setUsername($body->getUsername());
        $user->setFirstname($body->getFirstname());
        $user->setName($body->getName());
        $user->setAddress($body->getAddress());
        $user->setZip($body->getZip());
        $user->setCity($body->getCity());
        $user->setEmail($body->getEmail());
        $user->setCoordinates($body->getCoordinates());
        $user->setPassword($body->getPassword());
        $user->setPhone($body->getPhone());
        $user->setForgotPw($body->getForgotPw());
        $user->setForgotPwTime($body->getForgotPwTime());

        return $user;

    }

    /**
     * Operation loginUser
     *
     * Logs user into the system
     *
     * @param  string $username The user name for login (required)
     * @param  string $password The password for login in clear text (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return Swagger\Server\Model\User[]
     *
     */
    public function loginUser($username, $password, &$responseCode, array &$responseHeaders)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyBundle:User')->findBy(
            array('username' => $username)
        );

        if($users) {
            $body = $users[0];

            if (password_verify($password, $body->getPassword())) {
                $user = new User();
                $user->setId($body->getId());
                $user->setUsername($body->getUsername());
                $user->setFirstname($body->getFirstname());
                $user->setName($body->getName());
                $user->setAddress($body->getAddress());
                $user->setZip($body->getZip());
                $user->setCity($body->getCity());
                $user->setEmail($body->getEmail());
                $user->setCoordinates($body->getCoordinates());
                $user->setPassword($body->getPassword());
                $user->setPhone($body->getPhone());
                $user->setForgotPw($body->getForgotPw());
                $user->setForgotPwTime($body->getForgotPwTime());

                return $user;
            }
        }
        return false;



    }

    /**
     * Operation logoutUser
     *
     * Logs out current logged in user session
     *
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function logoutUser(&$responseCode, array &$responseHeaders)
    {
        return;
    }

    /**
     * Operation updateUser
     *
     * Updated user
     *
     * @param  string $username name that need to be updated (required)
     * @param  Swagger\Server\Model\User $body Updated user object (required)
     * @param  integer $responseCode The HTTP response code to return
     * @param  array $responseHeaders Additional HTTP headers to return with the response ()
     *
     * @return void
     *
     */
    public function updateUser($username, User $body, &$responseCode, array &$responseHeaders)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(\Acme\MyBundle\Entity\User::class)->find($body->getId());

        if($user->getUsername() == $username){
            $user->setUsername($body->getUsername());
            $user->setFirstname($body->getFirstname());
            $user->setName($body->getName());
            $user->setAddress($body->getAddress());
            $user->setZip($body->getZip());
            $user->setCity($body->getCity());
            $user->setPassword($body->getPassword());
            $user->setPhone($body->getPhone());
            $user->setCoordinates($body->getCoordinates());
            $user->setForgotPw($body->getForgotPw());
            $user->setForgotPwTime($body->getForgotPwTime());
        }
        $entityManager->flush();

        return;
    }
}