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

    public function sendEmail(
        $subject,
        $body,
        $relation,
        $relationId
    ) {

        $this->awesomeness
            ->requireClientAuthentication();

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