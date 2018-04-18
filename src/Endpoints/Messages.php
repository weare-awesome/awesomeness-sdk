<?php

namespace WeAreAwesome\AwesomenessSDK\Endpoints;

use WeAreAwesome\AwesomenessSDK\Awesomeness;

class Messages
{

    /**
     * @var Awesomeness
     */
    protected $awesomeness;

    const USER_RELATION = 'users';

    const CONTACT_RELATION = 'contacts';

    /**
     * Messages constructor.
     *
     * @param Awesomeness $awesomeness
     */
    public function __construct(Awesomeness $awesomeness)
    {
        $this->awesomeness = $awesomeness;
    }

    /**
     * @param $subject
     * @param $body
     * @param $userId
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    public function sendEmailToUser($subject, $body, $userId)
    {
        return $this->sendEmail(
            $subject,
            $body,
            self::USER_RELATION,
            $userId
        );
    }

    /**
     * @param $subject
     * @param $body
     * @param $relation
     * @param $relationId
     *
     * @return \WeAreAwesome\AwesomenessSDK\Http\ApiResponse
     */
    private function sendEmail(
        $subject,
        $body,
        $relation,
        $relationId
    ) {

        return $this->awesomeness
            ->http()
            ->sync(
                $this->awesomeness
                    ->getClientAuthentication()
            )
            ->post(
                '/messages/send/email',
                [
                    'subject' => $subject,
                    'body' => $body,
                    'relation' => $relation,
                    'relation_id' => $relationId
                ]
            );
    }

}